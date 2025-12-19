<aside class="w-64 {{ $darkMode ? 'bg-gray-800' : 'bg-white' }} border-r {{ $darkMode ? 'border-gray-700' : 'border-gray-200' }} min-h-[calc(100vh-4rem)] hidden lg:block">
    <div class="p-6">
        <!-- Navigation Links -->
        <nav class="space-y-2">
            <a href="#" class="flex items-center px-3 py-2 rounded-lg {{ $activeSection === 'dashboard' ? ($darkMode ? 'bg-gray-700 text-white' : 'bg-gray-100 text-gray-900') : ($darkMode ? 'text-gray-300 hover:bg-gray-700' : 'text-gray-700 hover:bg-gray-50') }} transition duration-300">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg {{ $activeSection === 'tasks' ? ($darkMode ? 'bg-gray-700 text-white' : 'bg-gray-100 text-gray-900') : ($darkMode ? 'text-gray-300 hover:bg-gray-700' : 'text-gray-700 hover:bg-gray-50') }} transition duration-300">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Tasks
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg {{ $activeSection === 'calendar' ? ($darkMode ? 'bg-gray-700 text-white' : 'bg-gray-100 text-gray-900') : ($darkMode ? 'text-gray-300 hover:bg-gray-700' : 'text-gray-700 hover:bg-gray-50') }} transition duration-300">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Calendar
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg {{ $activeSection === 'projects' ? ($darkMode ? 'bg-gray-700 text-white' : 'bg-gray-100 text-gray-900') : ($darkMode ? 'text-gray-300 hover:bg-gray-700' : 'text-gray-700 hover:bg-gray-50') }} transition duration-300">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Projects
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg {{ $activeSection === 'analytics' ? ($darkMode ? 'bg-gray-700 text-white' : 'bg-gray-100 text-gray-900') : ($darkMode ? 'text-gray-300 hover:bg-gray-700' : 'text-gray-700 hover:bg-gray-50') }} transition duration-300">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Analytics
            </a>
        </nav>

        <!-- Projects Section -->
        <div class="mt-8">
            <h3 class="text-sm font-semibold {{ $darkMode ? 'text-gray-400' : 'text-gray-500' }} uppercase tracking-wider mb-3">Projects</h3>
            <div class="space-y-2">
                @foreach($projects as $project)
                    <div class="flex items-center justify-between px-3 py-2 rounded-lg {{ $darkMode ? 'hover:bg-gray-700' : 'hover:bg-gray-50' }} transition duration-300">
                        <div class="flex items-center">
                            <div class="h-3 w-3 rounded-full bg-{{ $project['color'] }}-500 mr-3"></div>
                            <span class="text-sm {{ $darkMode ? 'text-gray-300' : 'text-gray-700' }}">{{ $project['name'] }}</span>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full {{ $darkMode ? 'bg-gray-700 text-gray-300' : 'bg-gray-100 text-gray-600' }}">{{ $project['task_count'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="mt-8 pt-6 border-t {{ $darkMode ? 'border-gray-700' : 'border-gray-200' }}">
            <h3 class="text-sm font-semibold {{ $darkMode ? 'text-gray-400' : 'text-gray-500' }} uppercase tracking-wider mb-3">Quick Stats</h3>
            <div class="space-y-3">
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">Productivity</span>
                        <span class="text-sm font-medium {{ $darkMode ? 'text-gray-300' : 'text-gray-900' }}">78%</span>
                    </div>
                    <div class="w-full {{ $darkMode ? 'bg-gray-700' : 'bg-gray-200' }} rounded-full h-2">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-2 rounded-full" style="width: 78%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }}">Goals Progress</span>
                        <span class="text-sm font-medium {{ $darkMode ? 'text-gray-300' : 'text-gray-900' }}">45%</span>
                    </div>
                    <div class="w-full {{ $darkMode ? 'bg-gray-700' : 'bg-gray-200' }} rounded-full h-2">
                        <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>