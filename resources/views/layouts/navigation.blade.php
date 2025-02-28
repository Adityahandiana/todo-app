<nav x-data="{ open: false, dropdownOpen: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex">
                <!-- Logo -->
                <img src="{{ asset('image/todol.png') }}" alt="Logo" class="block h-9 w-auto">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}"></a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('create')" :active="request()->routeIs('create')">
                        {{ __('Create') }}
                    </x-nav-link>
                </div>
            </div>
            <div id="deadline-warning" class="hidden fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500/80 text-white py-2 px-4 rounded-lg shadow-lg z-50 pointer-events-none">
                <div class="pointer-events-auto">
                    ⚠️ Beberapa tugas mendekati deadline! Segera selesaikan.
                </div>
            </div>
            
            

            <!-- Search Bar (Tampil di HP & Desktop) -->
            <div class="flex sm:items-center ml-auto">
                <form action="{{ route('tasks.search') }}" method="GET" class="relative w-full sm:w-auto">
                    <input type="text" name="query" placeholder="Cari tugas..."
                        class="border rounded-lg py-1 px-3 text-sm w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                        value="{{ request('query') }}">
                    <button type="submit" class="absolute right-2 top-1 text-gray-500 dark:text-gray-300">
                        ⌕
                    </button>
                </form>
            </div>
            
            

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button @click="dropdownOpen = !dropdownOpen" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div x-show="dropdownOpen" class="absolute bg-white dark:bg-gray-800 mt-2 w-48 rounded-lg shadow-lg py-2 z-50">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile Menu) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('create')" :active="request()->routeIs('create')">
                {{ __('Create') }}
            </x-responsive-nav-link>

            
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
                const today = new Date();
                
                document.querySelectorAll('.task-card').forEach(function (taskCard) {
                    const deadlineDate = new Date(taskCard.getAttribute('data-deadline'));
                    const timeDiff = (deadlineDate - today) / (1000 * 60 * 60 * 24);
        
                    if (timeDiff <= 2) { // Deadline ≤ 2 hari
                        taskCard.style.backgroundColor = 'rgba(255, 0, 0, 0.2)';
                    }
                });
            });
            function checkDeadlineWarnings() {
        let tasks = document.querySelectorAll('[data-deadline]');
        let hasUrgentTask = false;
    
        tasks.forEach(task => {
            let deadline = new Date(task.getAttribute('data-deadline'));
            let now = new Date();
            let difference = (deadline - now) / (1000 * 60 * 60 * 24); // Konversi ke hari
    
            if (difference <= 3 && !task.classList.contains('completed')) {
                hasUrgentTask = true;
            }
        });
    
        let warningBox = document.getElementById('deadline-warning');
        if (hasUrgentTask) {
            warningBox.classList.remove('hidden');
        } else {
            warningBox.classList.add('hidden');
        }
    }
    
    // Panggil fungsi saat halaman dimuat
    document.addEventListener("DOMContentLoaded", checkDeadlineWarnings);
    </script>