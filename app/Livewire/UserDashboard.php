<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class UserDashboard extends Component
{
    public $currentMonth;
    public $currentYear;

    protected string $layout = 'components.layouts.app';

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
