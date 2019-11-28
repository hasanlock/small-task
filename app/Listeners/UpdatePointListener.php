<?php

namespace App\Listeners;

use App\Events\TaskAdjustPointEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\TaskService;
use Log;

class UpdatePointListener
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
     * @param  TaskAdjustPointEvent  $event
     * @return void
     */
    public function handle(TaskAdjustPointEvent $event)
    {
        Log::info(__METHOD__);
        /*
        try {
            $taskService = new TaskService;
            $task = $event->getData();



            Log::info(
                sprintf(
                    "TaskCompletionListener:success => id=%s, parent_id=%s",
                    $task->id,
                    $task->parent_id
                )
            );
        } catch (\Throwable $th) {
            Log::critical(
                sprintf(
                    "TaskCompletionListener:fail => id=%s, parent_id=%s",
                    $task->id,
                    $task->parent_id
                )
            );
        }
        */
    }
}
