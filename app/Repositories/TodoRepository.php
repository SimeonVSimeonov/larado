<?php


namespace App\Repositories;


use App\Http\Requests\StoreTodoRequest;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoRepository implements TodoRepositoryInterface
{

    /**
     * @return mixed
     */
    public function getAllTodosByUser()
    {
        return Todo::where('user_id', '=', Auth::id())
            ->get();
    }

    public function createTodo(StoreTodoRequest $request)
    {
        return Todo::create($request->validated());
    }
}
