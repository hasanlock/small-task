<?php
namespace App\Services;

use App\Services\BaseService;
use App\Events\TaskAdjustDepthEvent;
use Validator;

class TaskService extends BaseService
{
    /**
     * __construct Create the service object
     *
     * @param string $mdlCls the Task model to be used,
     *                           default is Task model
     */
    public function __construct(
        $jobMdlCls = "",
        $jobStateMdlCls = ""
    ) {
        try {
            if (empty($jobMdlCls)) {
                $jobMdlCls = config('defaults.class.models.task');
            }

            $model = parent::buildModel($jobMdlCls);
            parent::setModel($model, 'task');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * createTask Init Task model and create Task
     *
     * @param array $data
     * @return App\Models\Task
     */
    public function createTask($data)
    {
        try {
            $model = $this->getTaskModel();
            $fillable = $this->getFillables($model);
            $entityData = $this->arrayOnly($data, $fillable);

            $this->canAddMoreChild($entityData['parent_id'] ?? null);

            $task = $this->create($entityData);
            if (is_null($task)) {
                throw new \Exception("Task creation failed", 400);
            }

            \Event::dispatch(new TaskAdjustDepthEvent($task));

            return $task;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * create With task data (array) creates a Task entry in db
     *
     * @param  array  $data task data see Task model
     * @return User             App\Models\User
     */
    public function create($data)
    {
        try {
            $model = $this->getTaskModel();
            $taskModelObj = $model->create($data);

            return $taskModelObj;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * updateTask Only update the task model
     *
     * @param int $id
     * @param array $data
     * @return App\Models\Task
     */
    public function updateTask($id, $data)
    {
        try {
            $model = $this->getTaskModel();
            $fillable = $this->getFillables($model);
            $entityData = $this->arrayOnly($data, $fillable);

            $this->canAddMoreChild($entityData['parent_id'] ?? null);

            $success = $this->update($id, $entityData);
            if (!$success) {
                throw new \Exception("Task update failed", 400);
            }

            $task = $this->get($id);
            \Event::dispatch(new TaskAdjustDepthEvent($task));

            return $task;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * update Only update task table and return success or fail
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data)
    {
        try {
            $model = $this->getTaskModel();
            $response = $model->where('id', $id)->update($data);

            return $response;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * getTask Gets single Task by given id
     *
     * @param int $id
     * @return \App\Models\Task
     */
    public function getTask(int $id)
    {
        try {
            $task = $this->get($id);
            if (is_null($task)) {
                throw new \Exception("Task not found", 404);
            }

            return $task;
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * get Gets single Task by given id
     *
     * @param int $id
     * @return \App\Models\Task
     */
    public function get(int $id)
    {
        try {
            $model = $this->getTaskModel();
            $task = $model->find($id);

            return $task;
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /*#### supporting functions ####*/

    /**
     * getTaskModel Creates and returns a blank job query object
     *
     * @return App\Models\Task
     */
    protected function getTaskModel()
    {
        $modelCls = $this->getModelOf('task');
        $model = new $modelCls;

        return $model;
    }

    /**
     * adjustDepth function to update depth for a task
     *
     * @param integer $id
     * @param integer|null $parentId
     * @return void
     */
    public function adjustDepth(int $id, ?int $parentId)
    {
        try {
            if ($parentId) {
                $parentTask = $this->getTask($parentId);
                $childTask = $this->getTask($id);

                $childTask->depth = (int) $parentTask->depth + 1;
                $childTask->save();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * canAddMoreChild function to check if a child can be added to it
     *
     * @param integer|null $parentId
     * @return boolean
     */
    public function canAddMoreChild(?int $parentId): bool
    {
        if ($parentId) {
            $task = $this->getTask($parentId);
            $maxDepth = (int) config('defaults.configs.max_depth');

            if ($task->depth >= $maxDepth) {
                throw new \Exception("Children limit exceed for given parent", 400);
            }

            return true;
        }

        return false;
    }

    public function adjustTaskCompletion(int $id)
    {
        $task = $this->getTask($id);
    }
}
