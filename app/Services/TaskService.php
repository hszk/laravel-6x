<?php

namespace App\Services;

use App\Repositories\Task\TaskRepositoryInterface;

class TaskService
{
    protected $TaskRepository;

    public function __construct(TaskRepositoryInterface $TaskRepository)
    {
        $this->TaskRepository = $TaskRepository;
    }

    /**
     * allTask
     *
     * @return object
     */
    public function allTask(): object
    {
        // ビジネスロジックなど

        return $this->TaskRepository->allTask();
    }

    /**
     * find
     *
     * @param int $task_id
     * @return object
     */
    public function findTask(int $task_id): object
    {
        // ビジネスロジックなど

        return $this->TaskRepository->findTask($task_id);
    }

    /**
     * createTask
     *
     * @param object $request
     * @return object
     */
    public function createTask(object $request): object
    {
        // ビジネスロジックなど
        $data['title'] = $request->title;
        $data['due_date'] = $request->due_date;

        return $this->TaskRepository->createTask($data);
    }

    /**
     * update
     *
     * @param int $task_id
     * @param object $request
     * @return bool
     */
    public function updateTask(int $task_id, object $request): bool
    {
        // ビジネスロジックなど
        $data['title'] = $request->title;
        $data['status'] = $request->status;
        $data['due_date'] = $request->due_date;

        return $this->TaskRepository->updateTask($task_id, $data);
    }
}
