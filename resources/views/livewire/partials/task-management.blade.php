<div class="{{ $darkMode ? 'bg-gray-800' : 'bg-white' }} rounded-xl border {{ $darkMode ? 'border-gray-700' : 'border-gray-200' }} shadow-sm">
    <!-- Motivational Quran & Hadith Panel -->
    <div class="{{ $darkMode ? 'bg-gradient-to-r from-green-900/20 to-emerald-900/20 border-green-800/30' : 'bg-gradient-to-r from-green-50 to-emerald-50 border-green-100' }} border-b rounded-t-xl p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="h-10 w-10 rounded-lg {{ $darkMode ? 'bg-green-900/30 border border-green-800/50' : 'bg-green-100 border border-green-200' }} flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 {{ $darkMode ? 'text-green-400' : 'text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold {{ $darkMode ? 'text-green-300' : 'text-green-800' }}">Daily Inspiration</h3>
                    <p class="text-xs {{ $darkMode ? 'text-green-400/80' : 'text-green-600' }}">Random Quran & Hadith</p>
                </div>
            </div>
            <button onclick="refreshMotivation()" 
                    class="p-1.5 {{ $darkMode ? 'text-green-400 hover:text-green-300 hover:bg-green-900/30' : 'text-green-600 hover:text-green-700 hover:bg-green-100' }} rounded-lg transition duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </button>
        </div>
        
        <!-- Motivation Content -->
        <div id="motivation-content" class="mt-4">
            <div class="text-center py-8">
                <svg class="w-8 h-8 mx-auto {{ $darkMode ? 'text-green-500/50' : 'text-green-400' }} mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="{{ $darkMode ? 'text-green-300' : 'text-green-700' }} italic">Loading inspiration...</p>
            </div>
        </div>
    </div>

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

<!-- JavaScript for Motivational Panel -->
<script>
// Collection of Quranic verses and Hadiths
const motivations = [
    {
        type: 'quran',
        arabic: 'فَإِنَّ مَعَ الْعُسْرِ يُسْرًا',
        translation: 'For indeed, with hardship [will be] ease.',
        reference: 'Quran 94:5',
        theme: 'patience'
    },
    {
        type: 'quran',
        arabic: 'وَلَسَوْفَ يُعْطِيكَ رَبُّكَ فَتَرْضَى',
        translation: 'And your Lord is going to give you, and you will be satisfied.',
        reference: 'Quran 93:5',
        theme: 'hope'
    },
    {
        type: 'quran',
        arabic: 'إِنَّ اللَّهَ مَعَ الصَّابِرِينَ',
        translation: 'Indeed, Allah is with the patient.',
        reference: 'Quran 2:153',
        theme: 'patience'
    },
    {
        type: 'quran',
        arabic: 'وَقُلِ اعْمَلُوا فَسَيَرَى اللَّهُ عَمَلَكُمْ',
        translation: 'And say, "Do [as you will], for Allah will see your deeds."',
        reference: 'Quran 9:105',
        theme: 'diligence'
    },
    {
        type: 'hadith',
        arabic: 'احْرِصْ عَلَى مَا يَنْفَعُكَ وَاسْتَعِنْ بِاللَّهِ',
        translation: 'Be keen on what benefits you, and seek help from Allah.',
        reference: 'Sahih Muslim',
        theme: 'effort'
    },
    {
        type: 'hadith',
        arabic: 'إِنَّ اللَّهَ يُحِبُّ إِذَا عَمِلَ أَحَدُكُمْ عَمَلاً أَنْ يُتْقِنَهُ',
        translation: 'Allah loves that when one of you does a job, he does it perfectly.',
        reference: 'Al-Bayhaqi',
        theme: 'excellence'
    },
    {
        type: 'quran',
        arabic: 'وَالَّذِينَ جَاهَدُوا فِينَا لَنَهْدِيَنَّهُمْ سُبُلَنَا',
        translation: 'And those who strive for Us - We will surely guide them to Our ways.',
        reference: 'Quran 29:69',
        theme: 'striving'
    },
    {
        type: 'hadith',
        arabic: 'الْمُؤْمِنُ الْقَوِيُّ خَيْرٌ وَأَحَبُّ إِلَى اللَّهِ مِنَ الْمُؤْمِنِ الضَّعِيفِ',
        translation: 'The strong believer is better and more beloved to Allah than the weak believer.',
        reference: 'Sahih Muslim',
        theme: 'strength'
    },
    {
        type: 'quran',
        arabic: 'إِنَّمَا يُوَفَّى الصَّابِرُونَ أَجْرَهُمْ بِغَيْرِ حِسَابٍ',
        translation: 'Indeed, the patient will be given their reward without account.',
        reference: 'Quran 39:10',
        theme: 'reward'
    },
    {
        type: 'hadith',
        arabic: 'تَدَاوَوْا عِبَادَ اللَّهِ فَإِنَّ اللَّهَ لَمْ يَضَعْ دَاءً إِلَّا وَضَعَ لَهُ شِفَاءً',
        translation: 'Seek treatment, O servants of Allah, for Allah did not create a disease without creating a cure for it.',
        reference: 'Sunan Ibn Majah',
        theme: 'healing'
    },
    {
        type: 'quran',
        arabic: 'وَقُل رَّبِّ زِدْنِي عِلْمًا',
        translation: 'And say, "My Lord, increase me in knowledge."',
        reference: 'Quran 20:114',
        theme: 'knowledge'
    },
    {
        type: 'hadith',
        arabic: 'الْكَلِمَةُ الطَّيِّبَةُ صَدَقَةٌ',
        translation: 'A good word is charity.',
        reference: 'Sahih Bukhari',
        theme: 'kindness'
    }
];

// Function to get a random motivation
function getRandomMotivation() {
    const randomIndex = Math.floor(Math.random() * motivations.length);
    return motivations[randomIndex];
}

// Function to display motivation
function displayMotivation(motivation) {
    const contentDiv = document.getElementById('motivation-content');
    
    let icon = '';
    let colorClass = '';
    
    if (motivation.type === 'quran') {
        icon = `<svg class="w-6 h-6 ${colorClass} mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>`;
        colorClass = 'text-green-500';
    } else {
        icon = `<svg class="w-6 h-6 ${colorClass} mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>`;
        colorClass = 'text-blue-500';
    }
    
    contentDiv.innerHTML = `
        <div class="text-center">
            ${icon}
            <div class="text-2xl font-arabic mb-4 ${colorClass} leading-relaxed" dir="rtl">
                ${motivation.arabic}
            </div>
            <div class="text-sm ${colorClass.replace('text-', 'text-').replace('500', '400')} mb-2">
                ${motivation.reference}
            </div>
            <p class="text-sm ${colorClass} italic mb-3">
                "${motivation.translation}"
            </p>
            <div class="inline-block px-3 py-1 text-xs ${colorClass.replace('text-', 'bg-').replace('500', '100')} ${colorClass} rounded-full">
                ${motivation.type === 'quran' ? 'Quran' : 'Hadith'} • ${motivation.theme.charAt(0).toUpperCase() + motivation.theme.slice(1)}
            </div>
        </div>
    `;
}

// Function to refresh motivation
function refreshMotivation() {
    const motivation = getRandomMotivation();
    displayMotivation(motivation);
    
    // Add refresh animation
    const contentDiv = document.getElementById('motivation-content');
    contentDiv.classList.add('opacity-50');
    setTimeout(() => {
        contentDiv.classList.remove('opacity-50');
    }, 300);
}

// Function to auto-refresh every 5 minutes
function startAutoRefresh() {
    setInterval(refreshMotivation, 5 * 60 * 1000); // 5 minutes
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Load initial motivation
    refreshMotivation();
    
    // Start auto-refresh
    startAutoRefresh();
    
    // Add Arabic font support
    const style = document.createElement('style');
    style.textContent = `
        @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap');
        .font-arabic {
            font-family: 'Amiri', serif;
        }
    `;
    document.head.appendChild(style);
});
</script>