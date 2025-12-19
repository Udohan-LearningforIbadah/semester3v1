<div class="min-h-screen transition-colors duration-300 {{ $darkMode ? 'bg-gray-900' : 'bg-gray-50' }}">
    <!-- Top Navigation Bar -->
    <header class="sticky top-0 z-50 transition-colors duration-300 {{ $darkMode ? 'bg-gray-800 border-b border-gray-700' : 'bg-white border-b border-gray-200' }} shadow-sm">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Left: Brand and navigation -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-8 w-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <h1 class="text-lg font-semibold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">ValueFlow Dashboard</h1>
                    </div>
                </div>
                
                <!-- Right: User actions -->
                <div class="flex items-center space-x-4">
                    <!-- Theme Toggle -->
                    <button wire:click="toggleDarkMode" 
                            class="p-2 rounded-lg {{ $darkMode ? 'bg-gray-700 hover:bg-gray-600 text-gray-300' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }} transition duration-300 focus:outline-none">
                        @if($darkMode)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        @endif
                    </button>
                    
                    <!-- User dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 group focus:outline-none">
                            <div class="h-8 w-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center shadow-sm">
                                <span class="text-white font-semibold text-sm">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>
                            <svg class="w-4 h-4 {{ $darkMode ? 'text-gray-400 group-hover:text-gray-300' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 {{ $darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200' }} rounded-lg shadow-lg border py-1 z-10">
                            <div class="px-4 py-2 border-b {{ $darkMode ? 'border-gray-700' : 'border-gray-100' }}">
                                <p class="text-sm font-medium {{ $darkMode ? 'text-white' : 'text-gray-900' }}">{{ $user->name }}</p>
                                <p class="text-xs {{ $darkMode ? 'text-gray-400' : 'text-gray-500' }}">{{ $user->email }}</p>
                            </div>
                            <!-- Use form method for logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm {{ $darkMode ? 'text-gray-300 hover:bg-gray-700 hover:text-red-400' : 'text-gray-700 hover:bg-gray-50 hover:text-red-600' }}">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Dashboard Content -->
    <div class="flex">
        <!-- Left Sidebar -->
        @include('livewire.partials.dashboard-sidebar')
        
        <!-- Main Content Area -->
        <main class="flex-1 p-4 md:p-6 lg:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Middle: To-Do List -->
                <div class="lg:col-span-2">
                    @include('livewire.partials.task-management')
                    
                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <div class="{{ $darkMode ? 'bg-gray-800' : 'bg-white' }} p-4 rounded-xl border {{ $darkMode ? 'border-gray-700' : 'border-gray-200' }}">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">Time Focused</p>
                                    <p class="text-xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">4h 23m</p>
                                </div>
                            </div>
                        </div>
                        <div class="{{ $darkMode ? 'bg-gray-800' : 'bg-white' }} p-4 rounded-xl border {{ $darkMode ? 'border-gray-700' : 'border-gray-200' }}">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">Tasks Completed</p>
                                    <p class="text-xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">{{ count(array_filter($tasks, function($task) { return $task['completed']; })) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="{{ $darkMode ? 'bg-gray-800' : 'bg-white' }} p-4 rounded-xl border {{ $darkMode ? 'border-gray-700' : 'border-gray-200' }}">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">Productivity</p>
                                    <p class="text-xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">89%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Calendar Panel -->
                <div class="lg:col-span-1">
                    @include('livewire.partials.calendar-panel')
                </div>
            </div>
        </main>
    </div>
</div>