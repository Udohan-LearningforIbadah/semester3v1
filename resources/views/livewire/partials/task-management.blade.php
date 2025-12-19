<div class="{{ $darkMode ? 'bg-gray-800' : 'bg-white' }} rounded-xl border {{ $darkMode ? 'border-gray-700' : 'border-gray-200' }} shadow-sm">
    <!-- To-Do Header -->
    <div class="p-6 border-b {{ $darkMode ? 'border-gray-700' : 'border-gray-200' }}">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold {{ $darkMode ? 'text-white' : 'text-gray-900' }}">To-Do List</h2>
                <p class="text-sm {{ $darkMode ? 'text-gray-400' : 'text-gray-600' }} mt-1">Manage your tasks and priorities</p>
            </div>
            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $darkMode ? 'bg-gray-700 text-gray-300' : 'bg-gray-100 text-gray-700' }}">
                {{ count(array_filter($tasks, function($task) { return !$task['completed']; })) }} pending
            </span>
        </div>
    </div>

    <!-- Add Task Form -->
    <div class="p-6 border-b {{ $darkMode ? 'border-gray-700' : 'border-gray-200' }}">
        <div class="flex space-x-3">
            <div class="flex-1">
                <input type="text" 
                       wire:model="newTask"
                       wire:keydown.enter="addTask"
                       placeholder="Add a new task..."
                       class="w-full px-4 py-2 rounded-lg border {{ $darkMode ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400' : 'bg-white border-gray-300 text-gray-900 placeholder-gray-500' }} focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-300">
            </div>
            <button wire:click="addTask"
                    class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-medium rounded-lg hover:from-indigo-600 hover:to-purple-600 transition duration-300 shadow-sm hover:shadow-md">
                Add
            </button>
        </div>
    </div>

    <!-- Task List -->
    <div class="p-6">
        <div class="space-y-3">
            @foreach($tasks as $task)
                <div class="flex items-start p-3 rounded-lg {{ $darkMode ? 'hover:bg-gray-700' : 'hover:bg-gray-50' }} transition duration-300">
                    <!-- Checkbox -->
                    <button wire:click="toggleTaskCompletion({{ $task['id'] }})"
                            class="flex-shrink-0 h-5 w-5 mt-0.5 mr-3 rounded border flex items-center justify-center {{ $task['completed'] ? 'bg-gradient-to-r from-green-500 to-emerald-500 border-transparent' : ($darkMode ? 'border-gray-600' : 'border-gray-300') }} transition duration-300">
                        @if($task['completed'])
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        @endif
                    </button>
                    
                    <!-- Task Content -->
                    <div class="flex-1">
                        @if($editingTaskId === $task['id'])
                            <div class="flex space-x-2">
                                <input type="text"
                                       wire:model="editedTaskTitle"
                                       wire:keydown.enter="saveTask({{ $task['id'] }})"
                                       class="flex-1 px-3 py-1 rounded border {{ $darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300 text-gray-900' }} focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                <button wire:click="saveTask({{ $task['id'] }})"
                                        class="px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600 transition duration-300">
                                    Save
                                </button>
                                <button wire:click="cancelEditing"
                                        class="px-3 py-1 text-sm bg-gray-500 text-white rounded hover:bg-gray-600 transition duration-300">
                                    Cancel
                                </button>
                            </div>
                        @else
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="{{ $task['completed'] ? ($darkMode ? 'text-gray-500 line-through' : 'text-gray-400 line-through') : ($darkMode ? 'text-white' : 'text-gray-900') }} font-medium">
                                        {{ $task['title'] }}
                                    </p>
                                    <div class="flex items-center space-x-3 mt-1">
                                        <span class="text-xs px-2 py-0.5 rounded-full {{ $darkMode ? 'bg-gray-700 text-gray-300' : 'bg-gray-100 text-gray-600' }}">
                                            @php
                                                $project = collect($projects)->firstWhere('id', $task['project_id']);
                                                echo $project ? $project['name'] : 'General';
                                            @endphp
                                        </span>
                                        @if($task['due_date'])
                                            <span class="text-xs {{ $darkMode ? 'text-gray-400' : 'text-gray-500' }}">
                                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ $task['due_date'] === 'today' ? 'Today' : ($task['due_date'] === 'tomorrow' ? 'Tomorrow' : $task['due_date']) }}
                                            </span>
                                        @endif
                                        @if($task['priority'] === 'high')
                                            <span class="text-xs px-2 py-0.5 rounded-full bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                                High Priority
                                            </span>
                                        @elseif($task['priority'] === 'medium')
                                            <span class="text-xs px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
                                                Medium
                                            </span>
                                        @elseif($task['priority'] === 'low')
                                            <span class="text-xs px-2 py-0.5 rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                                Low
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button wire:click="startEditing({{ $task['id'] }})"
                                            class="p-1 {{ $darkMode ? 'text-gray-400 hover:text-indigo-400' : 'text-gray-500 hover:text-indigo-600' }} transition duration-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button wire:click="deleteTask({{ $task['id'] }})"
                                            class="p-1 {{ $darkMode ? 'text-gray-400 hover:text-red-400' : 'text-gray-500 hover:text-red-600' }} transition duration-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            
            @if(count($tasks) === 0)
                <div class="text-center py-8">
                    <svg class="w-12 h-12 mx-auto {{ $darkMode ? 'text-gray-600' : 'text-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="mt-3 {{ $darkMode ? 'text-gray-400' : 'text-gray-500' }}">No tasks yet. Add your first task above!</p>
                </div>
            @endif
        </div>
    </div>
</div>