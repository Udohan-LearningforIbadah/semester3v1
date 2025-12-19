<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserDashboard extends Component
{
    public $user;
    public $darkMode = true;
    
    // Calendar view modes
    public $calendarView = 'day'; // 'day' or 'month'

    // Calendar related properties
    public $currentDate;
    public $currentMonth;
    public $currentYear;
    public $daysInMonth;
    public $firstDayOfMonth;
    public $blankDays = [];
    public $calendarDays = [];
    
    // Day view properties
    public $selectedDate;
    public $timeSlots = [];

    // Real-time clock properties
    public $currentTime;
    public $currentHour;
    public $currentMinute;
    public $timelinePosition = 0;

    // Tasks and To-dos
    public $tasks = [];
    public $newTask = '';
    public $editingTaskId = null;
    public $editedTaskTitle = '';
    
    // Sidebar navigation
    public $activeSection = 'dashboard';
    
    // Sample projects for sidebar
    public $projects = [
        ['id' => 1, 'name' => 'Value Portfolio', 'color' => 'indigo', 'task_count' => 12],
        ['id' => 2, 'name' => 'Content Creation', 'color' => 'blue', 'task_count' => 8],
        ['id' => 3, 'name' => 'Network Growth', 'color' => 'green', 'task_count' => 15],
        ['id' => 4, 'name' => 'Skill Development', 'color' => 'purple', 'task_count' => 6],
        ['id' => 5, 'name' => 'Personal Projects', 'color' => 'pink', 'task_count' => 9],
    ];
    
    // Sample tasks data
    protected $sampleTasks = [
        ['id' => 1, 'title' => 'Review weekly analytics report', 'project_id' => 1, 'completed' => false, 'due_date' => 'today', 'priority' => 'high', 'start_time' => '09:00', 'end_time' => '10:30'],
        ['id' => 2, 'title' => 'Create content calendar for Q1', 'project_id' => 2, 'completed' => true, 'due_date' => 'yesterday', 'priority' => 'medium', 'start_time' => '11:00', 'end_time' => '12:30'],
        ['id' => 3, 'title' => 'Connect with 5 industry professionals', 'project_id' => 3, 'completed' => false, 'due_date' => 'tomorrow', 'priority' => 'high', 'start_time' => '14:00', 'end_time' => '15:30'],
        ['id' => 4, 'title' => 'Complete Laravel advanced course', 'project_id' => 4, 'completed' => false, 'due_date' => '2024-01-15', 'priority' => 'medium', 'start_time' => '16:00', 'end_time' => '17:30'],
        ['id' => 5, 'title' => 'Design new portfolio website', 'project_id' => 5, 'completed' => false, 'due_date' => '2024-01-20', 'priority' => 'low', 'start_time' => '10:00', 'end_time' => '12:00'],
    ];
    
    protected $listeners = [
        'toggleDarkMode', 
        'taskAdded' => 'refreshTasks',
        // 'updateCurrentTime' => 'updateCurrentTime'
    ];

    public function mount()
    {
        $this->user = Auth::user();
        
        // Check session for dark mode preference
        if (session()->has('dark_mode')) {
            $this->darkMode = session('dark_mode');
        }
        
         // Initialize with today's date
        $this->currentDate = Carbon::now();
        $this->selectedDate = Carbon::now()->format('Y-m-d');
        
        // Initialize current time for real-time clock
        $now = Carbon::now();
        $this->currentTime = $now->format('h:i A');
        $this->currentHour = $now->format('G');
        $this->currentMinute = $now->format('i');
        $this->timelinePosition = (($this->currentHour * 60) + $this->currentMinute) / (24 * 60) * 100;

        // Initialize calendar views
        $this->initializeMonthView();
        $this->initializeDayView();

        // Initialize tasks
        $this->tasks = $this->sampleTasks;
        
        // Calculate project task counts
        $this->calculateProjectTaskCounts();
    }

    public function initializeMonthView()
    {
        $date = $this->currentDate;
        $this->currentMonth = $date->format('F');
        $this->currentYear = $date->format('Y');
        
        $daysInMonth = $date->daysInMonth;
        $this->daysInMonth = $daysInMonth;
        
        $firstDayOfMonth = Carbon::create($date->year, $date->month, 1)->dayOfWeek;
        $this->firstDayOfMonth = $firstDayOfMonth;
        
        // Calculate blank days at the start of the calendar
        $this->blankDays = [];
        for ($i = 0; $i < $firstDayOfMonth; $i++) {
            $this->blankDays[] = $i;
        }
        
        // Generate calendar days with events
        $this->calendarDays = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dayDate = Carbon::create($date->year, $date->month, $day);
            $hasEvent = $this->hasEventOnDate($dayDate);
            $isToday = $dayDate->isToday();
            $isSelected = $dayDate->format('Y-m-d') === $this->selectedDate;
            
            $this->calendarDays[] = [
                'day' => $day,
                'date' => $dayDate->format('Y-m-d'),
                'date_obj' => $dayDate,
                'has_event' => $hasEvent,
                'is_today' => $isToday,
                'is_selected' => $isSelected,
                'events' => $this->getEventsForDate($dayDate),
                'tasks' => $this->getTasksForDate($dayDate),
            ];
        }
    }

    public function initializeDayView()
    {
        // Generate 24-hour time slots
        $this->timeSlots = [];
        for ($hour = 0; $hour < 24; $hour++) {
            $time = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
            $nextTime = str_pad(($hour + 1) % 24, 2, '0', STR_PAD_LEFT) . ':00';
            
            $this->timeSlots[] = [
                'hour' => $hour,
                'time' => $time,
                'next_time' => $nextTime,
                'label' => $this->formatTimeLabel($time),
                'tasks' => $this->getTasksForTimeSlot($time, $this->selectedDate),
            ];
        }
    }

    // Helper method to calculate month progress
    public function getMonthProgressWidth()
    {
        $monthTasks = array_filter($this->calendarDays, function($day) {
            return count($day['tasks']) > 0;
        });
        $totalTasks = array_sum(array_map(function($day) {
            return count($day['tasks']);
        }, $monthTasks));
        
        return min(($totalTasks / 30) * 100, 100);
    }
    
    // Helper method to calculate busy days percentage
    public function getBusyDaysPercentage()
    {
        $monthTasks = array_filter($this->calendarDays, function($day) {
            return count($day['tasks']) > 0;
        });
        return (count($monthTasks) / 30) * 100;
    }
    
    // Helper method to calculate today's completion percentage
    public function getTodayCompletionPercentage()
    {
        $todayTasks = array_filter($this->tasks, function($task) {
            return $this->parseDueDate($task['due_date']) === $this->selectedDate;
        });
        
        $completedToday = array_filter($todayTasks, function($task) {
            return $task['completed'];
        });
        
        return count($todayTasks) > 0 ? (count($completedToday) / count($todayTasks)) * 100 : 0;
    }

    private function formatTimeLabel($time)
    {
        $hour = (int) explode(':', $time)[0];
        if ($hour === 0) {
            return '12 AM';
        } elseif ($hour < 12) {
            return $hour . ' AM';
        } elseif ($hour === 12) {
            return '12 PM';
        } else {
            return ($hour - 12) . ' PM';
        }
    }

    private function getTasksForTimeSlot($time, $date)
    {
        return array_filter($this->tasks, function($task) use ($time, $date) {
            $taskDate = $this->parseDueDate($task['due_date']);
            return isset($task['start_time']) && 
                   $task['start_time'] === $time && 
                   $taskDate === $date &&
                   !$task['completed'];
        });
    }

    private function hasEventOnDate($date)
    {
        $dateString = $date->format('Y-m-d');
        
        // Check if any task is due on this date
        foreach ($this->tasks as $task) {
            if (isset($task['due_date']) && $this->parseDueDate($task['due_date']) == $dateString) {
                return true;
            }
        }
        
        // Sample events for demonstration
        $sampleEvents = [
            Carbon::now()->format('Y-m-d') => ['Daily Standup'],
            Carbon::now()->addDays(1)->format('Y-m-d') => ['Team Meeting'],
            Carbon::now()->addDays(3)->format('Y-m-d') => ['Project Review'],
            Carbon::now()->addDays(7)->format('Y-m-d') => ['Weekly Planning'],
        ];
        
        return isset($sampleEvents[$dateString]);
    }
    
    private function getEventsForDate($date)
    {
        $dateString = $date->format('Y-m-d');
        $events = [];
        
        // Add tasks due on this date
        foreach ($this->tasks as $task) {
            if (isset($task['due_date']) && $this->parseDueDate($task['due_date']) == $dateString) {
                $events[] = $task['title'];
            }
        }
        
        // Sample events for demonstration
        $sampleEvents = [
            Carbon::now()->format('Y-m-d') => ['Daily Standup'],
            Carbon::now()->addDays(1)->format('Y-m-d') => ['Team Meeting'],
            Carbon::now()->addDays(3)->format('Y-m-d') => ['Project Review'],
            Carbon::now()->addDays(7)->format('Y-m-d') => ['Weekly Planning'],
        ];
        
        if (isset($sampleEvents[$dateString])) {
            $events = array_merge($events, $sampleEvents[$dateString]);
        }
        
        return $events;
    }
    
    private function getTasksForDate($date)
    {
        $dateString = $date->format('Y-m-d');
        return array_filter($this->tasks, function($task) use ($dateString) {
            return isset($task['due_date']) && 
                   $this->parseDueDate($task['due_date']) == $dateString &&
                   !$task['completed'];
        });
    }

    private function parseDueDate($dueDate)
    {
        if ($dueDate === 'today') {
            return Carbon::today()->format('Y-m-d');
        } elseif ($dueDate === 'tomorrow') {
            return Carbon::tomorrow()->format('Y-m-d');
        } elseif ($dueDate === 'yesterday') {
            return Carbon::yesterday()->format('Y-m-d');
        }
        
        return $dueDate;
    }
    
    public function toggleDarkMode()
    {
        $this->darkMode = !$this->darkMode;
        session(['dark_mode' => $this->darkMode]);
    }
    
    public function switchCalendarView($view)
    {
        $this->calendarView = $view;
    }

    public function selectDate($date)
    {
        $this->selectedDate = $date;
        $this->currentDate = Carbon::parse($date);
        
        if ($this->calendarView === 'month') {
            $this->initializeMonthView();
        } else {
            $this->initializeDayView();
        }
    }

    public function goToToday()
    {
        $today = Carbon::today();
        $this->selectedDate = $today->format('Y-m-d');
        $this->currentDate = $today;
        $this->updateCurrentTime();
        
        if ($this->calendarView === 'month') {
            $this->initializeMonthView();
        } else {
            $this->initializeDayView();
        }
    }

    public function changeMonth($direction)
    {
        if ($direction === 'next') {
            $this->currentDate = $this->currentDate->addMonth();
        } else {
            $this->currentDate = $this->currentDate->subMonth();
        }
        
        $this->initializeMonthView();
    }
    
    public function changeDay($direction)
    {
        if ($direction === 'next') {
            $this->currentDate = $this->currentDate->addDay();
        } else {
            $this->currentDate = $this->currentDate->subDay();
        }
        
        $this->selectedDate = $this->currentDate->format('Y-m-d');
        $this->initializeDayView();
    }

        public function addTask()
    {
        if (!empty($this->newTask)) {
            $newId = count($this->tasks) + 1;
            $this->tasks[] = [
                'id' => $newId,
                'title' => $this->newTask,
                'project_id' => 1,
                'completed' => false,
                'due_date' => 'today',
                'priority' => 'medium',
                'start_time' => '09:00',
                'end_time' => '10:00',
            ];
            $this->newTask = '';
            $this->calculateProjectTaskCounts();
            $this->initializeCalendar();
            $this->initializeDayView();
        }
    }
    
    public function deleteTask($taskId)
    {
        $this->tasks = array_filter($this->tasks, function($task) use ($taskId) {
            return $task['id'] != $taskId;
        });
        $this->calculateProjectTaskCounts();
        $this->initializeCalendar(); // Refresh calendar
    }
    
    public function toggleTaskCompletion($taskId)
    {
        foreach ($this->tasks as &$task) {
            if ($task['id'] == $taskId) {
                $task['completed'] = !$task['completed'];
                break;
            }
        }
        $this->calculateProjectTaskCounts();
    }
    
    public function startEditing($taskId)
    {
        $this->editingTaskId = $taskId;
        foreach ($this->tasks as $task) {
            if ($task['id'] == $taskId) {
                $this->editedTaskTitle = $task['title'];
                break;
            }
        }
    }
    
    public function saveTask($taskId)
    {
        foreach ($this->tasks as &$task) {
            if ($task['id'] == $taskId) {
                $task['title'] = $this->editedTaskTitle;
                break;
            }
        }
        $this->editingTaskId = null;
        $this->editedTaskTitle = '';
        $this->initializeCalendar(); // Refresh calendar
    }
    
    public function cancelEditing()
    {
        $this->editingTaskId = null;
        $this->editedTaskTitle = '';
    }
    
    public function calculateProjectTaskCounts()
    {
        foreach ($this->projects as &$project) {
            $count = 0;
            foreach ($this->tasks as $task) {
                if ($task['project_id'] == $project['id'] && !$task['completed']) {
                    $count++;
                }
            }
            $project['task_count'] = $count;
        }
    }
    
    public function addTaskToTimeSlot($date, $time)
    {
        $this->newTask = "New task at " . $time . " on " . Carbon::parse($date)->format('M d');
        $this->dispatch('focus-task-input');
    }
    
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        
        return $this->redirect('/', navigate: true);
    }
    
    public function setActiveSection($section)
    {
        $this->activeSection = $section;
    }
    
    public function render()
    {
        // Calculate stats for the view
        $todayTasks = array_filter($this->tasks, function($task) {
            return $this->parseDueDate($task['due_date']) === $this->selectedDate;
        });

        $upcomingTasks = array_filter($todayTasks, function($task) {
            return !$task['completed'] && isset($task['start_time']) && 
                   $task['start_time'] > Carbon::now()->format('H:i');
        });
        
        $monthTasks = array_filter($this->calendarDays, function($day) {
            return count($day['tasks']) > 0;
        });

        $isToday = Carbon::parse($this->selectedDate)->isToday();

        return view('livewire.user-dashboard', [
            'timelinePosition' => $this->timelinePosition,
            'monthProgressWidth' => $this->getMonthProgressWidth(),
            'busyDaysPercentage' => $this->getBusyDaysPercentage(),
            'todayCompletionPercentage' => $this->getTodayCompletionPercentage(),
            'todayTasks' => $todayTasks,
            'upcomingTasks' => $upcomingTasks,
            'monthTasks' => $monthTasks,
            'isToday' => $isToday,
            'currentTime' => $this->currentTime,
        ])->layout('layouts.app', ['darkMode' => $this->darkMode]);
    }
}