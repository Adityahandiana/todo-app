<div id="task-card-{{ $task->id }}" class="relative bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-lg transition-all"
    data-favorite="{{ $task->is_favorite ? '1' : '0' }}">

    <!-- Header Task -->
    <div class="flex items-center justify-between mb-2">
        <div class="flex items-center">
            <input type="checkbox" id="task-{{ $task->id }}" class="mr-3" 
                {{ $task->completed ? 'checked disabled' : '' }} 
                onchange="toggleTaskCompletion({{ $task->id }})">
            <h2 id="task-text-{{ $task->id }}" class="text-xl font-semibold 
                {{ $task->completed ? 'line-through text-gray-500' : '' }}">
                {{ $task->description }}
            </h2>
        </div>

        <!-- Ikon Bookmark & Menu -->
        <div class="flex space-x-3">
            <span id="bookmark-icon-{{ $task->id }}" 
                class="text-xl {{ $task->is_favorite ? 'text-blue-500' : 'text-gray-400' }} 
                    {{ $task->completed ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer hover:text-blue-500' }} transition"
                onclick="{{ !$task->completed ? "toggleFavorite({$task->id})" : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M6 2c-1.1 0-2 .9-2 2v18l8-5 8 5V4c0-1.1-.9-2-2-2H6z"/>
                </svg>
            </span>
            <span class="cursor-pointer text-xl hover:text-blue-500 transition"
                onclick="toggleElement('subtasks-{{ $task->id }}')">☰</span>
        </div>
    </div>

    <!-- Subtasks -->
    <div id="subtasks-{{ $task->id }}" class="hidden mt-4 pl-4">
        @if($task->subTasks->isNotEmpty())
            <h3 class="text-lg font-semibold">Sub-tasks:</h3>
            <ul>
                @foreach($task->subTasks as $subTask)
                    <li>
                        <input type="checkbox" id="subtask-{{ $subTask->id }}" class="mr-2" 
                            {{ $subTask->completed ? 'checked' : '' }} 
                            onchange="toggleSubtaskCompletion({{ $subTask->id }}, {{ $task->id }})">
                        <label id="subtask-label-{{ $subTask->id }}" 
                            class="{{ $subTask->completed ? 'line-through' : '' }}">
                            {{ $subTask->description }}
                        </label>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500 italic">Tidak ada subtask</p>
        @endif
    </div>

    <!-- Deadline -->
    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 {{ $task->completed ? 'hidden' : '' }}">
        Deadline: {{ \Carbon\Carbon::parse($task->deadline)->translatedFormat('d F Y') }}
    </p>

    <!-- Action Buttons -->
    <div class="mt-4 flex justify-between">
        <a href="{{ route('task.edit', $task->id) }}" class="text-blue-500 hover:text-blue-700 {{ $task->completed ? 'hidden' : '' }}">Edit</a>
        <form action="{{ route('task.delete', $task->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
        </form>
    </div>


    <div id="deadline-warning" class="hidden fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white py-2 px-4 rounded-lg shadow-lg">
        ⚠️ Beberapa tugas mendekati deadline! Segera selesaikan.
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
            let icon = document.getElementById(`bookmark-icon-${taskId}`);


            // Ubah warna ikon favorit
            icon.classList.toggle('text-blue-500', data.is_favorite);
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
function checkAllSubtasksCompleted(taskId) {
    let subtasks = document.querySelectorAll(`#subtasks-${taskId} input[type="checkbox"]`);
    
    for (let subtask of subtasks) {
        if (!subtask.checked) {
            return false; // Jika ada satu saja yang belum dicentang, return false
        }
    }
    return true; // Semua subtask sudah dicentang
}

function toggleTaskCompletion(taskId) {
    let taskCheckbox = document.getElementById(`task-${taskId}`);

    if (taskCheckbox.checked) {
        // Cek apakah semua subtasks sudah dicentang
        if (!checkAllSubtasksCompleted(taskId)) {
            showNotification('Selesaikan semua subtasks terlebih dahulu!');
            taskCheckbox.checked = false; // Batalkan checklist jika masih ada subtasks yang belum selesai
            return;
        }
    }

    fetch(`/tasks/${taskId}/complete`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            completed: taskCheckbox.checked
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
    let checkbox = document.getElementById(`subtask-${subtaskId}`);

    // Cegah uncheck jika subtask sudah selesai
    if (!checkbox.checked) {
        checkbox.checked = true; // Paksa tetap tercentang
        return;
    }

    fetch(`/subtasks/${subtaskId}/update-status`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            completed: true // Selalu kirim true
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`subtask-label-${subtaskId}`).classList.add('line-through');
        }
    });
}



</script>
