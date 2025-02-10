<div id="task-card-{{ $task->id }}" class="relative bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-lg transition-all"
    data-favorite="{{ $task->is_favorite ? '1' : '0' }}">
    <span class="absolute right-2 top-3 cursor-pointer text-l hover:text-blue-500 active:text-blue-700 transition"
        onclick="toggleElement('subtasks-{{ $task->id }}')">☰</span>

    <span id="star-icon-{{ $task->id }}" 
        class="absolute right-8 top-2 cursor-pointer text-xl {{ $task->is_favorite ? 'text-yellow-500' : 'text-gray-400' }} hover:text-blue-500 transition"
        onclick="toggleFavorite({{ $task->id }})">★</span>

    <div class="flex items-center">
        <input type="checkbox" id="task-{{ $task->id }}" class="mr-2" {{ $task->completed ? 'checked disabled' : '' }} onchange="toggleTaskCompletion({{ $task->id }})">
        <h2 id="task-text-{{ $task->id }}" class="text-xl font-semibold {{ $task->completed ? 'line-through text-gray-500' : '' }}">
            {{ $task->description }}
        </h2>
    </div>

    <div id="subtasks-{{ $task->id }}" class="hidden mt-4 pl-4">
        @if($task->subTasks->isNotEmpty())
            <h3 class="text-lg font-semibold">Sub-tasks:</h3>
            <ul>
                @foreach($task->subTasks as $subTask)
                    <li>
                        <input type="checkbox" id="subtask-{{ $subTask->id }}" class="mr-2" {{ $subTask->completed ? 'checked' : '' }} onchange="toggleSubtaskCompletion({{ $subTask->id }}, {{ $task->id }})">
                        <label id="subtask-label-{{ $subTask->id }}" class="{{ $subTask->completed ? 'line-through' : '' }}">
                            {{ $subTask->description }}
                        </label>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500 italic">Tidak ada subtask</p>
        @endif
    </div>
    <p id="task-created-{{ $task->id }}" 
   class="text-sm text-gray-600 dark:text-gray-300 mt-1" 
   data-timestamp="{{ $task->created_at }}">
</p>

    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 {{ $task->completed ? 'hidden' : '' }}">
        Deadline: {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d F Y ') }}
    </p>
    

    <div class="mt-4 flex justify-between">
        <a href="{{ route('task.edit', $task->id) }}" class="text-blue-500 hover:text-blue-700 {{ $task->completed ? 'hidden' : '' }}">Edit</a>
        <form action="{{ route('task.delete', $task->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-700 ">Delete</button>
        </form>
    </div>
</div>

<script>
function toggleElement(id) {
    document.getElementById(id).classList.toggle('hidden');
}
function toggleFavorite(taskId) {
    fetch(`/tasks/${taskId}/favorite`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            let icon = document.getElementById(`star-icon-${taskId}`);

            // Ubah warna ikon favorit
            icon.classList.toggle('text-yellow-500', data.is_favorite);
            icon.classList.toggle('text-gray-400', !data.is_favorite);

            // Tampilkan notifikasi
            showNotification(data.is_favorite ? 'Berhasil ditambahkan ke favorit!' : 'Dihapus dari favorit.');

            // Refresh halaman setelah 0.5 detik (agar user sempat melihat perubahan ikon)
            setTimeout(() => {
                location.reload();
            }, 500);
        }
    });
}

// Fungsi untuk menampilkan notifikasi sementara
function showNotification(message) {
    let notification = document.createElement("div");
    notification.innerText = message;
    notification.className = "fixed top-4 right-4 bg-blue-500 text-white py-2 px-4 rounded-lg shadow-lg transition-all opacity-0";
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.classList.remove("opacity-0");
    }, 100);

    setTimeout(() => {
        notification.classList.add("opacity-0");
        setTimeout(() => notification.remove(), 500);
    }, 2000);
}

function toggleTaskCompletion(taskId) {
    fetch(`/tasks/${taskId}/complete`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            completed: document.getElementById(`task-${taskId}`).checked
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`task-text-${taskId}`).classList.toggle('line-through', data.completed);
            document.getElementById(`task-text-${taskId}`).classList.toggle('text-gray-500', data.completed);
        }

    });
    setTimeout(() => {
                location.reload();
            }, 100);
}

function toggleSubtaskCompletion(subtaskId, taskId) {
    fetch(`/subtasks/${subtaskId}/update-status`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            completed: document.getElementById(`subtask-${subtaskId}`).checked
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`subtask-label-${subtaskId}`).classList.toggle('line-through', data.completed);
        }
    });
}


</script>
