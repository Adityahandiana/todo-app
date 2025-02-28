<?php
namespace App\Jobs;

use App\Events\TaskDeadlineReminder;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class CheckTaskDeadline implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $tasks = Task::where('completed', false)
            ->whereDate('deadline', '<=', Carbon::now()->addDays(3))
            ->get();

        foreach ($tasks as $task) {
            event(new TaskDeadlineReminder($task));
        }
    }
}
