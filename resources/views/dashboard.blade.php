<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-1/2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mt-4">Create Task</h1>
                    <div onclick="window.location.href='{{ route('create') }}'"
                        class="relative flex items-center justify-center bg-gray-200 dark:bg-gray-600 border-2 border-dashed border-gray-400 dark:border-gray-500 rounded-lg shadow-lg cursor-pointer 
                        hover:bg-gray-300 dark:hover:bg-gray-700 transition duration-200 ease-in-out h-20">
                        <span class="text-4xl text-gray-600 dark:text-gray-300">+</span>
                    </div>
                    
                    

                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mt-4">Active Tasks</h2>
                    <div id="active-tasks" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($tasks->where('completed', false) as $task)
                        <div class="task-card p-4 rounded-lg shadow-md border"
                            data-deadline="{{ $task->deadline }}">
                            @include('components.task-card', ['task' => $task])
                        </div>
                    @endforeach
                    
                        
                    </div>

                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mt-8">Completed Tasks</h2>
                    <div id="completed-tasks" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($tasks->where('completed', true) as $task)
                            @include('components.task-card', ['task' => $task])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

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

</x-app-layout>
