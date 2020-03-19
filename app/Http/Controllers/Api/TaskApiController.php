<?php

namespace App\Http\Controllers\Api;

use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskApiController extends ApiController
{

    protected $Task;

    public function __construct(TaskService $Task)
    {
        $this->Task = $Task;
    }

    public function list()
    {
        $tasks = $this->Task->allTask();
        return response()->json([$tasks]);
    }

    public function find(int $task_id)
    {
        $task = $this->Task->findTask($task_id);
        return response()->json([$task]);
    }
}
