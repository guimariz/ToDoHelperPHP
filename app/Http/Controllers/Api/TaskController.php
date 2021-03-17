<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Api\ApiError;
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

    public function show($id)
    {
        $task = $this->task->find($id);
        if (!$task) return response()->json(ApiError::errorMessage('Task não encontrada!', 4040), 404);
        $data = ['data' => $task];
        return response()->json($data);
    }

    // public function showDone()
    // {
    //     $task = DB::table('tasks')
    //     $data = ['data' => $task];
    //     return response()->json($data);
    // }

    // $task = Task::create([
    //     'task_name' => $request->taskName,
    //     'status' => $request->status,
    //     'open' => $request->open,
    //     'task_start' => $request->taskStart,
    //     'task_final' => $request->taskFinal,
    //     'task_timer' => $request->taskTimer,
    //     'rest_timer' => $request->restTimer,
    //     'is_ready' => $request->isReady
    // ]);


    // $taskData = $request->all();
    //         $this->task->create($taskData);
    //         $return = ['data' => ['msg' => 'Task criada com sucesso!']];
    //         return response()->json($return, 201);

    public function store(Request $request)
    {
        try {
            $taskData = $request->all();
            $this->$taskData = Task::create([
                'task_name' => $request->taskName,
                'status' => $request->status,
                'open' => $request->open,
                'task_start' => $request->taskStart,
                'task_final' => $request->taskFinal,
                'task_timer' => $request->taskTimer,
                'rest_timer' => $request->restTimer,
                'is_ready' => $request->isReady
            ]);
            $return = ['data' => ['msg' => 'Task criada com sucesso!']];
            return response()->json($return, 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010), 500);
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação', 1010), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $taskData = $request->all();
            $task = $this->task->find($id);
            $task->update($taskData);

            $return = ['data' => ['msg' => 'Task atualizada com sucesso!']];
            return response()->json($return, 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1011), 500);
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao atualizar a task', 1011), 500);
        }
    }

    public function delete(Task $id)
    {
        try {
            $id->delete();
            return response()->json(['data' => ['msg' => 'Task: ', $id->name . ' removido com sucesso!']], 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1012), 500);
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao deletar a task', 1012), 500);
        }
    }
}
