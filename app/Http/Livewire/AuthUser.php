<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AuthUser extends Component
{
    public $username;
    public $password;

    protected $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    public function render()
    {
        return view('livewire.auth-user');
    }

    public function submit()
    {
        $this->validate();
        $auth = Auth::attempt(['username' => $this->username, 'password' => $this->password]);
        if (!$auth) {
            return session()->flash('message', 'Login failed!');
        }
        return redirect()->to('dashboard');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('/');
    }
}
