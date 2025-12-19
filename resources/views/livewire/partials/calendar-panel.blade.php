<div class="{{ $darkMode ? 'bg-gray-800' : 'bg-white' }} rounded-xl border {{ $darkMode ? 'border-gray-700' : 'border-gray-200' }} shadow-sm sticky top-24">
    
    <!-- Calendar Header -->
    <div class="p-6 border-b {{ $darkMode ? 'border-gray-700' : 'border-gray-200' }}">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">
                    @if($calendarView === 'month')
                        {{ $currentMonth }} {{ $currentYear }}
                    @else
                        {{ \Carbon\Carbon::parse($selectedDate)->format('F d, Y') }}
                    @endif
                </h2>
                @if($calendarView === 'day')
                    <div class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }} mt-1" id="current-time-display">
                        {{ $currentTime }}
                    </div>
                @endif
            </div>
            <button wire:click="goToToday"
                    class="px-3 py-1 text-sm {{ $darkMode ? 'bg-gray-700 text-gray-300 hover:bg-gray-600' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} rounded-lg transition duration-300">
                Today
            </button>
        </div>
        
        <!-- View Toggle Buttons -->
        <div class="flex mb-4 rounded-lg p-1 {{ $darkMode ? 'bg-gray-700' : 'bg-gray-100' }}">
            <button wire:click="switchCalendarView('day')"
                    class="flex-1 py-2 text-sm font-medium rounded-md transition duration-300 {{ $calendarView === 'day' ? ($darkMode ? 'bg-gray-600 text-white' : 'bg-white text-gray-900 shadow-sm') : ($darkMode ? 'text-gray-400 hover:text-white' : 'text-gray-600 hover:text-gray-900') }}">
                Day View
            </button>
            <button wire:click="switchCalendarView('month')"
                    class="flex-1 py-2 text-sm font-medium rounded-md transition duration-300 {{ $calendarView === 'month' ? ($darkMode ? 'bg-gray-600 text-white' : 'bg-white text-gray-900 shadow-sm') : ($darkMode ? 'text-gray-400 hover:text-white' : 'text-gray-600 hover:text-gray-900') }}">
                Month View
            </button>
        </div>
        
        <!-- Navigation -->
        <div class="flex justify-between items-center">
            <button wire:click="{{ $calendarView === 'month' ? "changeMonth('prev')" : "changeDay('prev')" }}"
                    class="p-2 {{ $darkMode ? 'text-gray-400 hover:text-white hover:bg-gray-700' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }} rounded-lg transition duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <div class="text-sm {{ $darkMode ? 'text-gray-300' : 'text-gray-700' }}">
                @if($calendarView === 'month')
                    {{ $currentDate->format('F Y') }}
                @else
                    {{ \Carbon\Carbon::parse($selectedDate)->format('D, M d') }}
                @endif
            </div>
            <button wire:click="{{ $calendarView === 'month' ? "changeMonth('next')" : "changeDay('next')" }}"
                    class="p-2 {{ $darkMode ? 'text-gray-400 hover:text-white hover:bg-gray-700' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }} rounded-lg transition duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Calendar Content -->
    <div class="p-4 relative">
        @if($calendarView === 'month')
            <!-- Month View -->
            <div class="mb-2">
                <!-- Day Headers -->
                <div class="grid grid-cols-7 mb-2">
                    @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                        <div class="text-center text-xs font-medium {{ $darkMode ? 'text-gray-400' : 'text-gray-500' }} p-1">{{ $day }}</div>
                    @endforeach
                </div>
                
                <!-- Calendar Days -->
                <div class="grid grid-cols-7 gap-1">
                    <!-- Blank days -->
                    @foreach($blankDays as $blank)
                        <div class="h-12"></div>
                    @endforeach
                    
                    <!-- Calendar days -->
                    @foreach($calendarDays as $dayData)
                        <div class="relative h-12">
                            <button wire:click="selectDate('{{ $dayData['date'] }}')"
                                    class="w-full h-full flex flex-col items-center justify-center rounded-lg transition duration-300 {{ $dayData['is_today'] ? 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white' : ($dayData['is_selected'] ? ($darkMode ? 'bg-gray-700 text-white' : 'bg-gray-100 text-gray-900') : ($darkMode ? 'hover:bg-gray-700 text-gray-300' : 'hover:bg-gray-100 text-gray-900')) }}">
                                <span class="text-sm font-medium">{{ $dayData['day'] }}</span>
                                @if(count($dayData['tasks']) > 0)
                                    <div class="flex space-x-1 mt-1">
                                        @foreach($dayData['tasks'] as $task)
                                            @php
                                                $priorityColor = match($task['priority']) {
                                                    'high' => 'red',
                                                    'medium' => 'yellow',
                                                    default => 'green',
                                                };
                                            @endphp
                                            <div class="w-1 h-1 rounded-full bg-{{ $priorityColor }}-500"></div>
                                        @endforeach
                                    </div>
                                @endif
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Day View - 24 Hours -->
            <div class="relative" id="day-view-container">
                <!-- Current Time Indicator Container -->
                <div id="time-indicator-container" class="absolute left-0 right-0 z-10 pointer-events-none"
                     style="display: {{ $isToday ? 'block' : 'none' }};">
                    <div id="time-indicator" class="flex items-center transition-all duration-300 ease-linear">
                        <div id="time-label" class="flex items-center bg-red-500 text-white text-xs font-medium px-2 py-1 rounded-r shadow-sm">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span id="current-time-text">{{ $currentTime }}</span>
                        </div>
                        <div class="flex-1 h-0.5 bg-red-500"></div>
                    </div>
                </div>
                
                <!-- Time Slots -->
                <div class="space-y-1 max-h-[400px] overflow-y-auto pr-2 scrollbar-thin" id="time-slots-container">
                    @foreach($timeSlots as $slot)
                        <div class="relative" data-hour="{{ $slot['hour'] }}">
                            <div class="flex">
                                <!-- Time Label -->
                                <div class="w-16 flex-shrink-0">
                                    <span class="text-xs {{ $darkMode ? 'text-gray-400' : 'text-gray-500' }} block py-2">
                                        {{ $slot['label'] }}
                                    </span>
                                </div>
                                
                                <!-- Events/Tasks for this time slot -->
                                <div class="flex-1 min-h-[40px] border-l {{ $darkMode ? 'border-gray-700' : 'border-gray-200' }}">
                                    @foreach($slot['tasks'] as $task)
                                        <div class="mb-1 p-2 rounded {{ $darkMode ? 'bg-gray-700' : 'bg-gray-100' }}">
                                            <div class="flex items-center">
                                                @php
                                                    $priorityColor = match($task['priority']) {
                                                        'high' => 'red',
                                                        'medium' => 'yellow',
                                                        default => 'green',
                                                    };
                                                @endphp
                                                <div class="w-2 h-2 rounded-full bg-{{ $priorityColor }}-500 mr-2"></div>
                                                <span class="text-sm {{ $darkMode ? 'text-gray-300' : 'text-gray-700' }} truncate">{{ $task['title'] }}</span>
                                                <span class="text-xs {{ $darkMode ? 'text-gray-500' : 'text-gray-400' }} ml-auto">
                                                    {{ $task['start_time'] }} - {{ $task['end_time'] }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    <!-- Empty slot -->
                                    @if(count($slot['tasks']) === 0)
                                        <div class="h-8"></div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Hour divider -->
                            @if($slot['hour'] < 23)
                                <div class="absolute bottom-0 left-16 right-0 h-px {{ $darkMode ? 'bg-gray-700' : 'bg-gray-200' }}"></div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Quick Stats -->
    <div class="p-6 border-t {{ $darkMode ? 'border-gray-700' : 'border-gray-200' }}">
        <h3 class="text-lg font-semibold {{ $darkMode ? 'text-white' : 'text-gray-900' }} mb-4">
            @if($calendarView === 'month')
                This Month
            @else
                Today's Schedule
            @endif
        </h3>
        
        @if($calendarView === 'month')
            <!-- Month Stats -->
            <div class="space-y-3">
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">Tasks Scheduled</span>
                        <span class="text-sm font-medium {{ $darkMode ? 'text-gray-300' : 'text-gray-900' }}">
                            {{ array_sum(array_map(function($day) { return count($day['tasks']); }, $monthTasks)) }}
                        </span>
                    </div>
                    <div class="w-full {{ $darkMode ? 'bg-gray-700' : 'bg-gray-200' }} rounded-full h-2">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-2 rounded-full" 
                             style="width: {{ $monthProgressWidth }}%"></div>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">Busy Days</span>
                        <span class="text-sm font-medium {{ $darkMode ? 'text-gray-300' : 'text-gray-900' }}">{{ count($monthTasks) }}</span>
                    </div>
                    <div class="w-full {{ $darkMode ? 'bg-gray-700' : 'bg-gray-200' }} rounded-full h-2">
                        <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-2 rounded-full" 
                             style="width: {{ $busyDaysPercentage }}%"></div>
                    </div>
                </div>
            </div>
        @else
            <!-- Day Stats -->
            <div class="space-y-3">
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">Today's Tasks</span>
                        <span class="text-sm font-medium {{ $darkMode ? 'text-gray-300' : 'text-gray-900' }}">{{ count($todayTasks) }}</span>
                    </div>
                    <div class="w-full {{ $darkMode ? 'bg-gray-700' : 'bg-gray-200' }} rounded-full h-2">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-2 rounded-full" 
                             style="width: {{ $todayCompletionPercentage }}%"></div>
                    </div>
                </div>
                
                @if(count($upcomingTasks) > 0)
                    <div class="mt-4">
                        <h4 class="text-sm font-medium {{ $darkMode ? 'text-gray-300' : 'text-gray-700' }} mb-2">Next Up:</h4>
                        @foreach(array_slice($upcomingTasks, 0, 2) as $task)
                            <div class="flex items-center p-2 rounded {{ $darkMode ? 'bg-gray-700/50' : 'bg-gray-50' }} mb-1">
                                @php
                                    $priorityColor = match($task['priority']) {
                                        'high' => 'red',
                                        'medium' => 'yellow',
                                        default => 'green',
                                    };
                                @endphp
                                <div class="w-2 h-2 rounded-full bg-{{ $priorityColor }}-500 mr-2"></div>
                                <span class="text-sm {{ $darkMode ? 'text-gray-300' : 'text-gray-700' }} truncate">{{ $task['title'] }}</span>
                                <span class="text-xs {{ $darkMode ? 'text-gray-500' : 'text-gray-400' }} ml-auto">{{ $task['start_time'] }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </div>

    <!-- Quick Add Task Button -->
    <div class="p-6 border-t {{ $darkMode ? 'border-gray-700' : 'border-gray-200' }}">
        <button wire:click="$dispatch('show-add-task-modal')"
                class="w-full py-3 bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-medium rounded-lg hover:from-indigo-600 hover:to-purple-600 transition duration-300 shadow-sm hover:shadow-md flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add New Task
        </button>
    </div>
</div>

<!-- Pure JavaScript for Real-Time Time Indicator -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dayViewContainer = document.getElementById('day-view-container');
    if (!dayViewContainer) return;
    
    const timeIndicatorContainer = document.getElementById('time-indicator-container');
    const timeIndicator = document.getElementById('time-indicator');
    const timeLabel = document.getElementById('time-label');
    const currentTimeText = document.getElementById('current-time-text');
    const currentTimeDisplay = document.getElementById('current-time-display');
    const timeSlotsContainer = document.getElementById('time-slots-container');
    
    // Get all time slot elements
    const timeSlotElements = document.querySelectorAll('[data-hour]');
    
    // Calculate the height of each hour slot
    function getHourSlotHeight() {
        if (timeSlotElements.length === 0) return 60; // Default fallback
        
        const firstSlot = timeSlotElements[0];
        const secondSlot = timeSlotElements[1];
        
        if (firstSlot && secondSlot) {
            const firstRect = firstSlot.getBoundingClientRect();
            const secondRect = secondSlot.getBoundingClientRect();
            return secondRect.top - firstRect.top;
        }
        
        return 60; // Default fallback in pixels
    }
    
    // Update time indicator position
    function updateTimeIndicator() {
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const seconds = now.getSeconds();
        
        // Format time for display
        const ampm = hours >= 12 ? 'PM' : 'AM';
        const displayHours = hours % 12 || 12;
        const displayMinutes = minutes.toString().padStart(2, '0');
        const currentTimeString = `${displayHours}:${displayMinutes} ${ampm}`;
        
        // Update time display
        if (currentTimeText) currentTimeText.textContent = currentTimeString;
        if (currentTimeDisplay) currentTimeDisplay.textContent = currentTimeString;
        
        // Calculate position based on exact time
        const totalMinutes = (hours * 60) + minutes + (seconds / 60);
        const percentage = (totalMinutes / (24 * 60)) * 100;
        
        // Get container measurements
        const containerRect = timeSlotsContainer.getBoundingClientRect();
        const containerHeight = containerRect.height;
        const containerTop = containerRect.top;
        const scrollTop = timeSlotsContainer.scrollTop;
        
        // Calculate exact position in pixels
        const hourSlotHeight = getHourSlotHeight();
        const totalContentHeight = hourSlotHeight * 24;
        const positionInContent = (percentage / 100) * totalContentHeight;
        
        // Adjust position for scrolling
        const visiblePosition = positionInContent - scrollTop;
        
        // Only show if position is within visible area
        if (visiblePosition >= 0 && visiblePosition <= containerHeight) {
            timeIndicatorContainer.style.display = 'block';
            timeIndicator.style.transform = `translateY(${visiblePosition}px)`;
        } else {
            timeIndicatorContainer.style.display = 'none';
        }
        
        // Update every 30 seconds for smooth movement
        setTimeout(updateTimeIndicator, 30000);
    }
    
    // Update on scroll
    if (timeSlotsContainer) {
        timeSlotsContainer.addEventListener('scroll', updateTimeIndicator);
    }
    
    // Initial update
    updateTimeIndicator();
    
    // Handle window resize
    window.addEventListener('resize', updateTimeIndicator);
});

// Focus script for task input
Livewire.on('focus-task-input', () => {
    setTimeout(() => {
        const taskInput = document.querySelector('input[wire\\:model="newTask"]');
        if (taskInput) {
            taskInput.focus();
        }
    }, 100);
});
</script>