<div class="max-w-5xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <button wire:click="prevMonth" class="px-4 py-2 bg-gray-200 rounded">‹ Prev</button>
        <h1 class="text-2xl font-bold">{{ $monthName }} {{ $currentYear }}</h1>
        <button wire:click="nextMonth" class="px-4 py-2 bg-gray-200 rounded">Next ›</button>
    </div>

    <div class="grid grid-cols-7 gap-2 text-center font-semibold mb-2">
        <div>Sun</div>
        <div>Mon</div>
        <div>Tue</div>
        <div>Wed</div>
        <div>Thu</div>
        <div>Fri</div>
        <div>Sat</div>
    </div>

    <div class="grid grid-cols-7 gap-2 text-center border-t pt-2">
        {{-- Empty cells before first day --}}
        @for ($i = 0; $i < $startDayOfWeek; $i++)
            <div></div>
        @endfor

        {{-- Days in month --}}
        @for ($day = 1; $day <= $daysInMonth; $day++)
            <div class="p-4 border rounded hover:bg-blue-100 cursor-pointer">
                <span class="{{ now()->day == $day && now()->month == $currentMonth && now()->year == $currentYear ? 'font-bold text-blue-600' : '' }}">
                    {{ $day }}
                </span>
            </div>
        @endfor
    </div>

</div>
