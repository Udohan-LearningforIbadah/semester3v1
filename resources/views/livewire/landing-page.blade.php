<div class="min-h-screen transition-colors duration-300 {{ $darkMode ? 'bg-gradient-to-b from-gray-900 to-gray-800' : 'bg-gradient-to-b from-gray-50 to-white' }}">
    <!-- Modern Navigation Header -->
    <header class="sticky top-0 z-50 transition-colors duration-300 {{ $darkMode ? 'bg-gray-900/95 backdrop-blur-sm border-b border-gray-700' : 'bg-white/95 backdrop-blur-sm border-b border-gray-200' }} shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo and Brand -->
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <div class="h-9 w-9 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center shadow-md">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">Value</h1>
                        <p class="text-xs {{ $darkMode ? 'text-gray-400' : 'text-gray-500' }}">Self-Value Management Platform</p>
                    </div>
                </div>
                
                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="{{ $darkMode ? 'text-gray-300 hover:text-indigo-400' : 'text-gray-700 hover:text-indigo-600' }} font-medium transition duration-300">Features</a>
                    <a href="#" class="{{ $darkMode ? 'text-gray-300 hover:text-indigo-400' : 'text-gray-700 hover:text-indigo-600' }} font-medium transition duration-300">Integrations</a>
                    <a href="#" class="{{ $darkMode ? 'text-gray-300 hover:text-indigo-400' : 'text-gray-700 hover:text-indigo-600' }} font-medium transition duration-300">Pricing</a>
                    <a href="#" class="{{ $darkMode ? 'text-gray-300 hover:text-indigo-400' : 'text-gray-700 hover:text-indigo-600' }} font-medium transition duration-300">Resources</a>
                </div>
                
                <!-- Theme Toggle and User/Auth Section -->
                <div class="flex items-center space-x-4">
                    <!-- Theme Toggle Button -->
                    <button wire:click="toggleDarkMode" 
                            class="p-2 rounded-lg {{ $darkMode ? 'bg-gray-800 hover:bg-gray-700 text-gray-300' : 'bg-gray-100 hover:bg-gray-200 text-gray-700' }} transition duration-300 focus:outline-none">
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
                    
                    @if($isLoggedIn)
                        <!-- Logged in user -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 group focus:outline-none">
                                <div class="flex items-center space-x-3">
                                    <div class="h-9 w-9 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center shadow-sm">
                                        <span class="text-white font-semibold text-sm">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="hidden md:block text-left">
                                        <p class="text-sm font-medium {{ $darkMode ? 'text-white' : 'text-gray-900' }}">{{ $user->name }}</p>
                                        <p class="text-xs {{ $darkMode ? 'text-gray-400' : 'text-gray-500' }}">Workspace Member</p>
                                    </div>
                                </div>
                                <svg class="w-4 h-4 {{ $darkMode ? 'text-gray-400 group-hover:text-gray-300' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-56 {{ $darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200' }} rounded-lg shadow-lg border py-1 z-10">
                                <a href="{{ filament()->getUrl() }}" class="flex items-center px-4 py-2 text-sm {{ $darkMode ? 'text-gray-300 hover:bg-gray-700 hover:text-indigo-400' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }}">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    Workspace Dashboard
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm {{ $darkMode ? 'text-gray-300 hover:bg-gray-700 hover:text-indigo-400' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }}">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profile Settings
                                </a>
                                <div class="border-t {{ $darkMode ? 'border-gray-700' : 'border-gray-100' }} my-1"></div>
                                <button wire:click="logout" class="flex items-center w-full text-left px-4 py-2 text-sm {{ $darkMode ? 'text-gray-300 hover:bg-gray-700 hover:text-red-400' : 'text-gray-700 hover:bg-gray-50 hover:text-red-600' }}">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Sign Out
                                </button>
                            </div>
                        </div>
                    @else
                        <!-- Guest user - Login button -->
                        <div class="flex items-center space-x-4">
                            <a href="{{ filament()->getUrl() }}" class="{{ $darkMode ? 'text-gray-300 hover:text-indigo-400' : 'text-gray-700 hover:text-indigo-600' }} font-medium transition duration-300">
                                Sign In
                            </a>
                            <a href="{{ filament()->getUrl() }}" class="px-5 py-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white font-medium rounded-lg hover:from-indigo-600 hover:to-purple-600 transition duration-300 shadow-md hover:shadow-lg">
                                Register
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        @if($isLoggedIn)
            <!-- Welcome back to workspace -->
            <div class="mb-12">
                <!-- Welcome Header -->
                <div class="mb-8">
                    <div class="inline-block px-4 py-1 bg-gradient-to-r {{ $darkMode ? 'from-indigo-900/30 to-purple-900/30 border-indigo-800' : 'from-indigo-50 to-purple-50 border-indigo-100' }} rounded-full border mb-3">
                        <span class="text-sm font-medium {{ $darkMode ? 'text-indigo-300' : 'text-indigo-700' }}">Welcome back to your workspace</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }} mb-3">
                        Welcome back, <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">{{ $user->name }}</span>
                    </h1>
                    <p class="text-lg {{ $darkMode ? 'text-gray-300' : 'text-gray-600' }}">
                        Your self-value management workspace is ready. Continue where you left off.
                    </p>
                </div>
                
                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="{{ $darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200' }} rounded-xl border p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-12 w-12 rounded-lg bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <span class="text-2xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">12</span>
                        </div>
                        <h3 class="text-lg font-semibold {{ $darkMode ? 'text-white' : 'text-gray-900' }} mb-2">Active Projects</h3>
                        <p class="{{ $darkMode ? 'text-gray-400' : 'text-gray-600' }} text-sm">Managing your value streams</p>
                    </div>
                    
                    <div class="{{ $darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200' }} rounded-xl border p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-12 w-12 rounded-lg bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-2xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">47</span>
                        </div>
                        <h3 class="text-lg font-semibold {{ $darkMode ? 'text-white' : 'text-gray-900' }} mb-2">Tasks This Week</h3>
                        <p class="{{ $darkMode ? 'text-gray-400' : 'text-gray-600' }} text-sm">Building your value portfolio</p>
                    </div>
                    
                    <div class="{{ $darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200' }} rounded-xl border p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-12 w-12 rounded-lg bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <span class="text-2xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">89%</span>
                        </div>
                        <h3 class="text-lg font-semibold {{ $darkMode ? 'text-white' : 'text-gray-900' }} mb-2">Productivity Score</h3>
                        <p class="{{ $darkMode ? 'text-gray-400' : 'text-gray-600' }} text-sm">Your value creation efficiency</p>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mb-10">
                    <h2 class="text-xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }} mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ filament()->getUrl() }}" class="{{ $darkMode ? 'bg-gray-800 border-gray-700 hover:bg-gray-700' : 'bg-white border-gray-200 hover:shadow-md' }} border rounded-lg p-4 transition duration-300 group">
                            <div class="h-10 w-10 rounded-lg bg-gradient-to-r {{ $darkMode ? 'from-indigo-900/30 to-purple-900/30 group-hover:from-indigo-900/50 group-hover:to-purple-900/50' : 'from-indigo-100 to-purple-100 group-hover:from-indigo-200 group-hover:to-purple-200' }} flex items-center justify-center mb-3">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <p class="font-medium {{ $darkMode ? 'text-white' : 'text-gray-900' }}">Dashboard</p>
                        </a>
                        <a href="#" class="{{ $darkMode ? 'bg-gray-800 border-gray-700 hover:bg-gray-700' : 'bg-white border-gray-200 hover:shadow-md' }} border rounded-lg p-4 transition duration-300 group">
                            <div class="h-10 w-10 rounded-lg bg-gradient-to-r {{ $darkMode ? 'from-blue-900/30 to-cyan-900/30 group-hover:from-blue-900/50 group-hover:to-cyan-900/50' : 'from-blue-100 to-cyan-100 group-hover:from-blue-200 group-hover:to-cyan-200' }} flex items-center justify-center mb-3">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <p class="font-medium {{ $darkMode ? 'text-white' : 'text-gray-900' }}">New Project</p>
                        </a>
                        <a href="#" class="{{ $darkMode ? 'bg-gray-800 border-gray-700 hover:bg-gray-700' : 'bg-white border-gray-200 hover:shadow-md' }} border rounded-lg p-4 transition duration-300 group">
                            <div class="h-10 w-10 rounded-lg bg-gradient-to-r {{ $darkMode ? 'from-green-900/30 to-emerald-900/30 group-hover:from-green-900/50 group-hover:to-emerald-900/50' : 'from-green-100 to-emerald-100 group-hover:from-green-200 group-hover:to-emerald-200' }} flex items-center justify-center mb-3">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="font-medium {{ $darkMode ? 'text-white' : 'text-gray-900' }}">Calendar</p>
                        </a>
                        <a href="#" class="{{ $darkMode ? 'bg-gray-800 border-gray-700 hover:bg-gray-700' : 'bg-white border-gray-200 hover:shadow-md' }} border rounded-lg p-4 transition duration-300 group">
                            <div class="h-10 w-10 rounded-lg bg-gradient-to-r {{ $darkMode ? 'from-purple-900/30 to-pink-900/30 group-hover:from-purple-900/50 group-hover:to-pink-900/50' : 'from-purple-100 to-pink-100 group-hover:from-purple-200 group-hover:to-pink-200' }} flex items-center justify-center mb-3">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="font-medium {{ $darkMode ? 'text-white' : 'text-gray-900' }}">Analytics</p>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Hero Section for Guests -->
            <div class="text-center mb-16">
                <!-- Main Hero -->
                <div class="max-w-4xl mx-auto mb-12">
                    <div class="inline-block px-4 py-1 bg-gradient-to-r {{ $darkMode ? 'from-indigo-900/30 to-purple-900/30 border-indigo-800' : 'from-indigo-50 to-purple-50 border-indigo-100' }} rounded-full border mb-6">
                        <span class="text-sm font-medium {{ $darkMode ? 'text-indigo-300' : 'text-indigo-700' }}">All-in-one self-value management</span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }} mb-6 leading-tight">
                        Organize Your
                        <span class="bg-gradient-to-r from-blue-500 to-cyan-500 bg-clip-text text-transparent">Value Creation</span>
                        in One Place
                    </h1>
                    <p class="text-xl {{ $darkMode ? 'text-gray-300' : 'text-gray-600' }} mb-8 max-w-3xl mx-auto">
                        Value can help in management of LinkedIn, YouTube Studio, and productivity tools into one powerful workspace for managing your personal and professional value streams.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row justify-center gap-4 mb-12">
                        <a href="{{ filament()->getUrl() }}" 
                           class="px-8 py-4 bg-gradient-to-r from-blue-500 to-cyan-500 text-white font-semibold rounded-lg hover:from-indigo-600 hover:to-purple-600 transition duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-0.5 text-lg inline-flex items-center justify-center">
                            Get Started
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#" class="px-8 py-4 border-2 {{ $darkMode ? 'border-gray-600 text-gray-300 hover:border-indigo-500 hover:text-indigo-400' : 'border-gray-300 text-gray-700 hover:border-indigo-600 hover:text-indigo-600' }} font-semibold rounded-lg transition duration-300 inline-flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Project Demo
                        </a>
                    </div>
                </div>

                <!-- App Showcase -->
                <div class="{{ $darkMode ? 'bg-gray-800 border-gray-700' : 'bg-gradient-to-br from-gray-50 to-white border-gray-200' }} rounded-2xl border p-8 mb-12">
                    <h3 class="text-2xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }} mb-6">Everything You Need in One Workspace</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                        <div class="text-center p-4">
                            <div class="h-16 w-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <p class="font-semibold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">Project Management</p>
                            <p class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">for managing multiple apps</p>
                        </div>
                        <div class="text-center p-4">
                            <div class="h-16 w-16 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <p class="font-semibold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">Network Management</p>
                            <p class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">Like LinkedIn</p>
                        </div>
                        <div class="text-center p-4">
                            <div class="h-16 w-16 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="font-semibold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">Content Studio</p>
                            <p class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">Like YouTube Studio</p>
                        </div>
                        <div class="text-center p-4">
                            <div class="h-16 w-16 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <p class="font-semibold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">Notes & Docs</p>
                            <p class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">Like OneNote</p>
                        </div>
                        <div class="text-center p-4">
                            <div class="h-16 w-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="font-semibold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">Smart Calendar</p>
                            <p class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">Integrated Scheduling</p>
                        </div>
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="grid md:grid-cols-2 gap-8 mb-16">
                    <div class="{{ $darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200' }} rounded-xl border p-8 shadow-sm hover:shadow-md transition duration-300">
                        <div class="h-12 w-12 rounded-lg bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }} mb-3">Unified Productivity</h3>
                        <p class="{{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">
                            Stop switching between apps. Manage projects, content, networking, and notes in one streamlined interface designed for maximum efficiency.
                        </p>
                    </div>
                    
                    <div class="{{ $darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200' }} rounded-xl border p-8 shadow-sm hover:shadow-md transition duration-300">
                        <div class="h-12 w-12 rounded-lg bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }} mb-3">Secure & Private</h3>
                        <p class="{{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">
                            Enterprise-grade security for your personal and professional data. Your value portfolio is protected with advanced encryption and privacy controls.
                        </p>
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl p-10 text-white mb-12">
                    <h2 class="text-3xl font-bold mb-4">Ready to Elevate Your Value Management?</h2>
                    <p class="text-xl mb-6 opacity-90">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <a href="{{ filament()->getUrl() }}" 
                       class="inline-flex items-center bg-white text-indigo-600 px-8 py-4 rounded-lg hover:bg-gray-100 transition duration-300 text-lg font-semibold shadow-lg">
                        Start increasing Your Productivity.
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <p class="text-sm opacity-80 mt-4">No credit card required • Cancel anytime</p>
                </div>
            </div>
        @endif

        <!-- Recent Activity / Workspace Preview -->
        <div class="{{ $darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200' }} rounded-xl border shadow-sm p-8 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">Workspace Overview</h3>
                @if($isLoggedIn)
                    <a href="{{ filament()->getUrl() }}" class="text-indigo-500 hover:text-indigo-400 font-medium inline-flex items-center">
                        View All
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endif
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="{{ $darkMode ? 'border-gray-700' : 'border-gray-200' }} border rounded-lg p-5">
                    <div class="flex items-center mb-4">
                        <div class="h-10 w-10 rounded-lg bg-gradient-to-r from-blue-100 to-cyan-100 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium {{ $darkMode ? 'text-white' : 'text-gray-900' }}">Projects</p>
                            <p class="text-2xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">12</p>
                        </div>
                    </div>
                    <p class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">Active value streams</p>
                </div>
                
                <div class="{{ $darkMode ? 'border-gray-700' : 'border-gray-200' }} border rounded-lg p-5">
                    <div class="flex items-center mb-4">
                        <div class="h-10 w-10 rounded-lg bg-gradient-to-r from-green-100 to-emerald-100 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium {{ $darkMode ? 'text-white' : 'text-gray-900' }}">Tasks Completed</p>
                            <p class="text-2xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">156</p>
                        </div>
                    </div>
                    <p class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">This month</p>
                </div>
                
                <div class="{{ $darkMode ? 'border-gray-700' : 'border-gray-200' }} border rounded-lg p-5">
                    <div class="flex items-center mb-4">
                        <div class="h-10 w-10 rounded-lg bg-gradient-to-r from-purple-100 to-pink-100 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium {{ $darkMode ? 'text-white' : 'text-gray-900' }}">Connections</p>
                            <p class="text-2xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">89</p>
                        </div>
                    </div>
                    <p class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">Active network</p>
                </div>
                
                <div class="{{ $darkMode ? 'border-gray-700' : 'border-gray-200' }} border rounded-lg p-5">
                    <div class="flex items-center mb-4">
                        <div class="h-10 w-10 rounded-lg bg-gradient-to-r from-orange-100 to-red-100 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium {{ $darkMode ? 'text-white' : 'text-gray-900' }}">Time Saved</p>
                            <p class="text-2xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">42h</p>
                        </div>
                    </div>
                    <p class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">Weekly average</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="{{ $darkMode ? 'bg-gray-900' : 'bg-gray-900' }} text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="h-10 w-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Value</h3>
                            <p class="text-gray-400 text-sm">Self-Value Management</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm">
                        The all-in-one workspace for managing your personal and professional value creation.
                    </p>
                </div>
                
                <div>
                    <h4 class="font-semibold text-lg mb-4">Product</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Features</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Integrations</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Pricing</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Changelog</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold text-lg mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Documentation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Community</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Blog</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold text-lg mb-4">Company</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">About</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Privacy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    © {{ date('Y') }} Value. No rights reserved. 
                    <span class="block md:inline mt-2 md:mt-0">Built with Laravel, Livewire, and Filament.</span>
                </p>
            </div>
        </div>
    </footer>
</div>