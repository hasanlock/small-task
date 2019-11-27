<?php

namespace App\Listeners;

use App\Events\TaskEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\TaskService;
use Log;

class UpdateDepthListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TaskEvent  $event
     * @return void
     */
    public function handle(TaskEvent $event)
    {
        $taskService = new TaskService;
        $task = $event->getData();

        $taskService->adjustDepth($task->id, $task->parent_id);

        Log::info(
            sprintf(
                "UpdateChildCountListener:success => id=%s, parent_id=%s",
                $task->id,
                $task->parent_id
            )
        );
    }
}
