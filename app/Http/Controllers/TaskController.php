<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResponse;
use App\Services\TaskService;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TaskService $taskService)
    {
        $tasksByUser = $taskService->getParentTasksByUser();

        return view('tasks', [
            'userTaskList' => $tasksByUser,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TaskRequest  $request
     * @return \App\Http\Resources\TaskResponse
     */
    public function store(TaskRequest $request, TaskService $taskService)
    {
        try {
            $data = $request->validated();
            $task = $taskService->createTask($data);

            return response()->json(
                new TaskResponse($task),
                201
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \App\Http\Resources\TaskResponse
     */
    public function update(TaskRequest $request, int $taskId, TaskService $taskService)
    {
        try {
            $data = $request->validated();

            $taskService->getTask($taskId);
            $task = $taskService->updateTask($taskId, $data);

            return response()->json(
                new TaskResponse($task),
                200
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
