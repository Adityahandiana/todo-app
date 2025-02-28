<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('login'); 
});


// Rute untuk dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [TasksController::class, 'dashboard'])->name('dashboard');
});

// Middleware untuk rute yang membutuhkan autentikasi
Route::middleware('auth')->group(function () {
    // Rute profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk admin
    Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware('admin');
});

// Rute untuk tugas
Route::get('/create', [TasksController::class, 'create'])->name('create');
Route::post('/tasks', [TasksController::class, 'store'])->name('store');
Route::get('/tasks/{task}/edit', [TasksController::class, 'edit'])->name('task.edit');
Route::put('/tasks/{task}', [TasksController::class, 'update'])->name('task.update');
Route::delete('/tasks/{task}', [TasksController::class, 'destroy'])->name('task.delete');
Route::post('/tasks/{task}/complete', [TasksController::class, 'markComplete'])->name('task.complete');
Route::post('/tasks/{id}/favorite', [TasksController::class, 'toggleFavorite']);

// Rute untuk subtask
Route::get('/tasks/{task}/subtasks', [TasksController::class, 'subTasks'])->name('task.subtasks');
Route::post('/tasks/{task}/subtasks', [TasksController::class, 'storeSubtask'])->name('task.storeSubtask');
Route::delete('/subtasks/{subtask}', [TasksController::class, 'destroySubtask'])->name('subtask.delete');
Route::post('/subtasks/{subtask}/update-status', [TasksController::class, 'updateSubTaskStatus']);
Route::get('/tasks/search', [TasksController::class, 'search'])->name('tasks.search');


// Rute untuk autentikasi
require __DIR__.'/auth.php';
