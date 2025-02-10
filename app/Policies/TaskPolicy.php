<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;

class TaskPolicy
{
    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id; // Hanya pengguna yang membuat task yang bisa mengupdate
    }

    public function delete(User $user, Task $task)
    {
        return $user->id === $task->user_id; // Hanya pengguna yang membuat task yang bisa menghapus
    }
}
