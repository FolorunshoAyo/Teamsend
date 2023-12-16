<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{
    public function render()
    {
        return view('livewire.forgot-password');
    }

    public $email;
    public $loading = false;

    public function sendResetLink()
    {
        $this->loading = true;

        $this->validate(['email' => 'required|email']);

        $status = TRUE;
        
        $user = User::where('email', $this->email)->first();
        
        // $status = Password::sendResetLink(
        //     ['email' => $this->email]
        // );

        if (!$user) {
            $this->addError('email', __('We couldn\'t find a user with that email address.'));
            return;
        }

        // if ($status === Password::RESET_LINK_SENT) {
        if($status){
            // session()->flash('res-success', 'Password reset link sent to registered email');
            return redirect()->to('/mail-sent');
        } else {
            $this->addError('email', __($status));
            $this->loading = false;
        }
    }
}
