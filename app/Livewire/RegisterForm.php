<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterForm extends Component
{
    public $email;
    public $password;
    public $password_confirmation;
    public $loading = false;

    public function render()
    {
        return view('livewire.register-form');
    }

    public function messages()
    {
        return [
            'email.required' => 'The email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already taken.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least :min characters.',
            'password.confirmed' => 'The passwords do not match. Please confirm your password.',
            'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character.',
            'password_confirmation.required' => 'Please confirm your password.',
        ];
    }

    public function register()
    {
        $this->loading = true;

        $this->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'password_confirmation' => 'required',
        ]);

        $user = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Send email verification link
        // $this->sendVerificationEmail($user);

        session()->flash('success', 'Registration successful!');

        return redirect()->route('auth.login');

        // return redirect()->to('/verification-sent');
    }

    // private function sendVerificationEmail(User $user)
    // {
    //     $verificationUrl = route('verification.verify', [
    //         'id' => $user->id,
    //         'hash' => sha1($user->email),
    //     ]);

    //     Mail::to($user->email)->send(new \App\Mail\VerificationMail($user, $verificationUrl));
    // }
}
