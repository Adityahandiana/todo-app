<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\SubTask;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TasksController extends Controller
{
    // Menampilkan dashboard dengan semua tugas dan subtasks
    public function dashboard()
    {
        $tasks = Task::where('user_id', Auth::id())
                     ->with('subTasks')
                     ->orderByDesc('is_favorite') // Tugas favorit selalu di atas
                     ->orderBy('created_at', 'asc') // Urutan default berdasarkan waktu pembuatan
                     ->get();

        return view('dashboard', compact('tasks'));
    }

    // Halaman awal (welcome)
    public function welcome()
    {
        return view('welcome');
    }

    // Menampilkan halaman form untuk membuat tugas baru
    public function create()
    {
        return view('create');
    }

    // Menyimpan tugas baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'deadline' => 'required|date|after_or_equal:today', // Deadline minimal hari ini
        ]);

        Task::create([
            'description' => $request->input('description'),
            'deadline' => Carbon::parse($request->input('deadline')),
            'user_id' => Auth::id(),
            'completed' => false,
        ]);

        return redirect()->route('dashboard')->with('success', 'Task created successfully.');
    }

    // Menampilkan halaman edit tugas
    public function edit(Task $task)
    {
        // Pastikan pengguna hanya bisa mengedit tugas miliknya
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
        }

        if ($task->deadline) {
            $task->deadline = Carbon::parse($task->deadline);
        }

        return view('tasks.edit', compact('task'));
    }

    // Memperbarui tugas beserta subtasks
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'subtasks.*' => 'nullable|string|max:255',
            'new_subtasks.*' => 'nullable|string|max:255',
        ]);

        $task->update([
            'description' => $request->input('description'),
            'deadline' => Carbon::parse($request->input('deadline'))->format('Y-m-d'),
        ]);

        // Memperbarui status subtasks
        if ($request->has('subtasks')) {
            foreach ($request->subtasks as $subTaskId => $isChecked) {
                $subTask = SubTask::find($subTaskId);
                if ($subTask) {
                    $subTask->completed = $isChecked ? 1 : 0;
                    $subTask->save();
                }
            }
        }

        // Menambahkan subtasks baru jika ada
        if ($request->has('new_subtasks')) {
            foreach ($request->new_subtasks as $description) {
                if (!empty($description)) {
                    SubTask::create([
                        'task_id' => $task->id,
                        'description' => $description,
                        'completed' => false
                    ]);
                }
            }
        }

        return redirect()->route('dashboard')->with('success', 'Task updated successfully.');
    }

    // Menghapus tugas beserta subtasks
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
        }

        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Task deleted successfully.');
    }

    // Memperbarui status penyelesaian subtask
    public function updateSubTaskStatus(Request $request, SubTask $subtask)
    {
        $subtask->update(['completed' => $request->input('completed') ? 1 : 0]);
        return response()->json(['success' => true]);
    }

    // Menambahkan subtask baru ke tugas
    public function addSubTask(Request $request, Task $task)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        SubTask::create([
            'task_id' => $task->id,
            'description' => $request->input('description'),
            'completed' => false
        ]);

        return redirect()->route('task.edit', $task->id)->with('status', 'Subtask added!');
    }

    // Menandai tugas sebagai selesai atau belum selesai
    public function markComplete(Task $task, Request $request)
    {
        $task->update(['completed' => $request->completed]);
        return response()->json(['success' => true]);
    }

    // Menandai atau menghapus favorit pada tugas
    public function toggleFavorite($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['is_favorite' => !$task->is_favorite]);

        return response()->json(['success' => true, 'is_favorite' => $task->is_favorite]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // Ambil tugas berdasarkan user yang login
        $tasks = Task::where('user_id', Auth::id())
                    ->where('description', 'LIKE', "%{$query}%")
                    ->get();
    
        return view('dashboard', compact('tasks'));
    }
    

}
