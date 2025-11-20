<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class UserDashboard extends Component
{
    public $currentMonth;
    public $currentYear;

    public function render()
    {
        $startOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $daysInMonth  = $startOfMonth->daysInMonth;
        $startDayOfWeek = $startOfMonth->dayOfWeek; // 0 = Sunday

        return view('livewire.user-dashboard', [
            'daysInMonth'    => $daysInMonth,
            'startDayOfWeek' => $startDayOfWeek,
            'monthName'      => $startOfMonth->format('F'),
        ]);
    }

    public function mount()
    {
        $now = Carbon::now();
        $this->currentMonth = $now->month;
        $this->currentYear = $now->year;
    }

    public function prevMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
    }
}
