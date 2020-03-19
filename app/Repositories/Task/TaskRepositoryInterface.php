<?php
namespace App\Repositories\Task;

interface TaskRepositoryInterface
{
    public function allTask(): object;
    public function findTask(int $task_id): object;
    public function createTask(array $data): object;
    public function updateTask(int $task_id, array $data): bool;
}
