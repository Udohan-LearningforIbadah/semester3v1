<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LandingPage extends Component
{
    public $user;
    public $isLoggedIn = false;
    public $darkMode = true; // Default to dark mode

    protected $listeners = ['toggleDarkMode'];

    public function mount()
    {
        $this->user = Auth::user();
        $this->isLoggedIn = Auth::check();
        
        // Check if user has a preference stored
        if (session()->has('dark_mode')) {
            $this->darkMode = session('dark_mode');
        }
    }

    public function toggleDarkMode()
    {
        $this->darkMode = !$this->darkMode;
        session(['dark_mode' => $this->darkMode]);
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.landing-page')
            ->layout('layouts.app', ['darkMode' => $this->darkMode]);
            // using livewire 3.x
            //    public function render()
            //{
            //    return view('livewire.landing-page', ['darkMode' => $this->darkMode]);
            //}
    }
}