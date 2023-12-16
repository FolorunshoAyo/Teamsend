<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginForm extends Component
{

    public $email;
    public $password;
    public $remember;
    public $loading = false;

    public function render()
    {
        return view('livewire.login-form');
    }

    public function messages()
    {
        return [
            'email.required' => 'The email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password is required.',
        ];
    }

    public function login()
    {
        $this->loading = true;

        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials, $this->remember)) {
            // Authentication was successful
            $user = Auth::user();

            if($user->is_super_admin){
                $url = route('super-admin.dashboard');
                
                // Super Admin
                return redirect()->route($url);
            }elseif(!$user->organisations->first()){
                // New Organisation Admin
                return redirect()->route("auth.account-setup");
            }elseif($user->organisations->first()->pivot->is_admin){
                $admin_organisation_name = strtolower(join("-", explode(" ", $user->organisations->first()->name)));

                // Organisation Admin
                return redirect()->route('org-admin.dashboard', ['organisation' => $admin_organisation_name]);;
            }else{
                // Staff/Agent
                $staff_organisation_name = strtolower(join("-", explode(" ", $user->organisations->first()->name)));

                return redirect()->route('org-agent.dashboard', ['organisation' => $staff_organisation_name]);
            }
        }

        // Authentication failed
        $this->addError('email', 'Invalid credentials');
        $this->loading = false;
    }
}
