<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPassword extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;
    public $loading = false;

    public function mount($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function messages()
    {
        return [
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least :min characters.',
            'password.confirmed' => 'The passwords do not match. Please confirm your password.',
            'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character.',
            'password_confirmation.required' => 'Please confirm your password.',
        ];
    }

    public function resetPassword()
    {
        $this->loading = true;

        $this->validate([
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'password_confirmation' => 'required',
        ]);

        $status = Password::reset(
            ['email' => $this->email, 'token' => $this->token, 'password' => $this->password],
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            // perform redirect after successful password reset
            session()->flash('success', 'Password Reset successfully!');

            return redirect()->route('auth.login');
        } else {
            $this->addError('password', __($status));
            $this->loading = false;
        }
    }

    public function render()
    {
        return view('livewire.reset-password');
    }
}
