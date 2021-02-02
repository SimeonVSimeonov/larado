<?php


namespace App\Repositories;


use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * @param int $id
     * @return Builder|Model|mixed|object|null
     */
    public function getTodoById(int $id)
    {
        return Todo::where('id', '=', $id)
            ->first();
    }

    /**
     * @param int $id
     * @return Builder|Model|mixed|object|null
     */
    public function getTodoByIdWithTasks(int $id)
    {
        return Todo::with('tasks')
            ->where('id', '=', $id)
            ->first();
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function deleteTodoById(int $id): bool
    {
        $todo = $this->getTodoById($id);
        if (is_null($todo)){
            return false;
        }
        $todo->delete();

        return true;
    }

    public function updateTodo(UpdateTodoRequest $request, Todo $todo)
    {
        return $todo->update($request->validated());
    }
}
