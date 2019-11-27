<?php

namespace App\Listeners;

use App\Events\TaskEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\TaskService;
use Log;

class TaskCompletionListener
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
        //     try {
    //         $taskService = new TaskService;
    //         $task = $event->getData();

    //         if (!empty($task->parent_id)) {
    //             $taskService->adjustChildCount($task->parent_id);
    //         }
    //         Log::info(
    //             sprintf(
    //                 "UpdateChildCountListener:success => id=%s, parent_id=%s",
    //                 $task->id,
    //                 $task->parent_id
    //             )
    //         );
    //     } catch (\Throwable $th) {
    //         Log::critical(
    //             sprintf(
    //                 "UpdateChildCountListener:fail => id=%s, parent_id=%s",
    //                 $task->id,
    //                 $task->parent_id
    //             )
    //         );
    //     }
    }
}
