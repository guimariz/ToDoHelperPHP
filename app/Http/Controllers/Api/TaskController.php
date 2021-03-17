<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    /**
     * @var Task
     */
    private $task;

    public function __construct(Task $task)
    {

        $this->task = $task;
    }

    public function index()
    {
        $data = ['data' => $this->task->all()];
        return response()->json($data);
    }

    public function show(Task $id)
    {
        $data = ['data' => $id];
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $taskData = $request->all();
        $this->task->create($taskData);
    }
}
