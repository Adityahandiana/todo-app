<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Create Task</h1>
                    <!-- Kartu untuk Menambahkan Tugas Baru -->
<div onclick="window.location.href='{{ route('create') }}'"
class="relative flex items-center justify-center bg-gray-200 dark:bg-gray-600 border-2 border-dashed border-gray-400 dark:border-gray-500 rounded-lg shadow-lg cursor-pointer 
hover:bg-gray-300 dark:hover:bg-gray-700 transition duration-200 ease-in-out h-20">
<span class="text-4xl text-gray-600 dark:text-gray-300">+</span>
</div>


                    <!-- Daftar Tugas yang Belum Selesai -->
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mt-4">Active Tasks</h2>
                    <div id="active-tasks" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($tasks->where('completed', false) as $task)
                            @include('components.task-card', ['task' => $task])
                        @endforeach
                    </div>

                    <!-- Daftar Tugas yang Selesai -->
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

    <!-- Script JavaScript untuk update status subtask via AJAX -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Seleksi semua checkbox subtask, pastikan checkbox ini sudah ada di dalam komponen task-card
            const subtaskCheckboxes = document.querySelectorAll('.subtask-checkbox');

            subtaskCheckboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    const subtaskId = this.getAttribute('data-subtask-id');
                    const isChecked = this.checked;
                    // Asumsikan label subtask memiliki id dengan format "subtask-label-{id}"
                    const label = document.getElementById('subtask-label-' + subtaskId);

                    // Kirim request update status via AJAX
                    fetch(`/subtasks/${subtaskId}/update-status`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ completed: isChecked })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Jika update berhasil, set text-decoration sesuai status
                            if (isChecked) {
                                label.style.textDecoration = "line-through";
                            } else {
                                label.style.textDecoration = "none";
                            }
                        } else {
                            // Jika gagal, kembalikan checkbox ke keadaan semula
                            this.checked = !isChecked;
                            console.error('Gagal memperbarui status subtask.');
                        }
                    })
                    .catch(error => {
                        this.checked = !isChecked;
                        console.error('Error:', error);
                    });
                });
            });
        });
    </script>
</x-app-layout>
