<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use App\Repositories\TodoRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class TodoController extends Controller
{
    /**
     * @var TodoRepository
     */
    private TodoRepository $todoRepository;

    /**
     * TodoController constructor.
     * @param TodoRepository $todoRepository
     */
    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $todos = $this->todoRepository->getAllTodosByUser();

        return response()->json($todos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTodoRequest $request
     * @return JsonResponse
     */
    public function store(StoreTodoRequest $request): JsonResponse
    {
        $todo = $this->todoRepository->createTodo($request);

        return response()->json($todo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Todo $todo
     * @return JsonResponse
     */
    public function show(Todo $todo): JsonResponse
    {
        $todo = $this->todoRepository->getTodoByIdWithTasks($todo->id);
        if ($todo === null) {
            return response()->json(
                'There is no such todo!',404);
        }

        return response()->json($todo, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTodoRequest $request
     * @param Todo $todo
     * @return JsonResponse
     */
    public function update(UpdateTodoRequest $request, Todo $todo): JsonResponse
    {
        $this->todoRepository->updateTodo($request, $todo);

        return response()->json($todo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todo $todo
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Todo $todo)
    {
        if (!Gate::allows('owns-this-todo', $todo)){
            return response()->json('You do not own this todo!', 403);
        }

        $is_deleted = $this->todoRepository->deleteTodoById($todo->id);
        if($is_deleted){
            return response()->json(null, 204);
        }

        return response()->json('There is no such todo!', 404);
    }
}
