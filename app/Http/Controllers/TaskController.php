<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;

class TaskController extends Controller
{

    protected $Task;

    public function __construct(TaskService $Task)
    {
        $this->Task = $Task;
    }

    public function index()
    {
        $tasks = $this->Task->allTask();
        return view('tasks/index', [
            'tasks' => $tasks,
        ]);
    }

    public function showCreateForm()
    {
        return view('tasks/create');
    }

    public function create(CreateTask $request)
    {
        // resultは一応受け取る
        $result = $this->Task->createTask($request);
        return redirect()->to('tasks');
    }

    public function showEditForm(int $task_id)
    {
        $task = $this->Task->findTask($task_id);
        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    public function edit(int $task_id, EditTask $request)
    {
        // resultは一応受け取る
        $result = $this->Task->updateTask($task_id, $request);
        return redirect()->to('tasks');
    }
}
