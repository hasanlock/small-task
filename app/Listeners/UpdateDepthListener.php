<?php

namespace App\Listeners;

use App\Events\TaskAdjustDepthEvent;
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
     * @param  TaskAdjustDepthEvent  $event
     * @return void
     */
    public function handle(TaskAdjustDepthEvent $event)
    {
        try {
            $taskService = new TaskService;
            $task = $event->getData();

            $taskService->adjustDepth($task->id, $task->parent_id);

            Log::info(
                sprintf(
                    "UpdateDepthListener:success => id=%s, parent_id=%s",
                    $task->id,
                    $task->parent_id
                )
            );
        } catch (\Throwable $th) {
            Log::info(
                sprintf(
                    "UpdateDepthListener:fail => id=%s, parent_id=%s",
                    $task->id,
                    $task->parent_id
                )
            );
        }
    }
}
