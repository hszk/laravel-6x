<?php

namespace App\Repositories\Task;

use App\Repositories\Task\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * all
     *
     * @return object
     */
    public function allTask(): object
    {
        return Task::all();
    }

    /**
     * find
     *
     * @param int $task_id
     * @return object
     */
    public function findTask(int $task_id): object
    {
        return Task::find($task_id);
    }

    /**
     * create
     *
     * @param array $data
     * @return object
     */
    public function createTask(array $data): object
    {
        return Task::create($data);
    }

    /**
     * update
     *
     * @param int $task_id
     * @param array $data
     * @return bool
     */
    public function updateTask(int $task_id, array $data): bool
    {
        return Task::find($task_id)->fill($data)->save();
    }
}
