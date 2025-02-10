<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Edit Task</h1>

                    <form method="POST" action="{{ route('task.update', $task->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Task Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Task Description</label>
                            <input type="text" id="description" name="description" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300" value="{{ old('description', $task->description) }}" required>
                        </div>

                        <!-- Subtasks -->
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Subtasks</h3>
                            <ul id="subtask-list">
                                @foreach($task->subTasks as $subTask)
                                    <li class="flex items-center mb-2">
                                        <input type="text" name="subtasks[{{ $subTask->id }}]" value="{{ $subTask->description }}" class="px-2 py-1 border rounded mr-2 dark:bg-gray-700 dark:text-gray-300">
                                        <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">delete</button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Add Subtask -->
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Add Subtask</h3>
                            <div class="flex items-center">
                                <input type="text" id="new-subtask" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300">
                                <button type="button" onclick="addSubtask()" class="ml-2 bg-blue-500 hover:bg-blue-600 text-white font-bold px-4 py-2 rounded">+</button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                                Update Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addSubtask() {
            let subtaskText = document.getElementById('new-subtask').value;
            if (subtaskText.trim() === '') return;

            let list = document.getElementById('subtask-list');
            let newItem = document.createElement('li');
            newItem.className = 'flex items-center mb-2';
            newItem.innerHTML = `
                <input type="text" name="new_subtasks[]" value="${subtaskText}" class="px-2 py-1 border rounded mr-2 dark:bg-gray-700 dark:text-gray-300">
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">delete</button>
            `;
            list.appendChild(newItem);
            document.getElementById('new-subtask').value = '';
        }
    </script>
</x-app-layout>
