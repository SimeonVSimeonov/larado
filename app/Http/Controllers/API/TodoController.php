<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodoRequest;
use App\Models\Todo;
use App\Repositories\TodoRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //
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
