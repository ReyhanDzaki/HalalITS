<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|string|email',
        'password' => 'required|string',
    ];

    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect()->intended('home');
        }

        $this->addError('email', trans('auth.failed'));
    }

     public function logout()
    {
        Auth::logout();

        // Optionally, redirect to a specific route or URL after logout
        return redirect('/')->with('success', 'Logged out successfully.');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.app');
    }
}
