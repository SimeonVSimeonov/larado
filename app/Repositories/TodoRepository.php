<?php


namespace App\Repositories;


use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Task;
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
        $todo = Todo::create($request->validated());
        $tasks = $this->createTasks($request->tasks);
        $todo->tasks()->saveMany($tasks);

        return $todo->load('tasks');
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
        $todo->update($request->validated());
        $todo->tasks()->whereIn('id', $request->tasks_delete)->delete();
        foreach ($request->tasks as $task){
            $todo->tasks()->updateOrCreate(['name' => $task['name']], $task);
        }
        return $todo->load('tasks');
    }

    /**
     * @param array $request_tasks
     * @return array
     */
    private function createTasks(array $request_tasks): array
    {
        $tasks = [];
        foreach ($request_tasks as $request_task){
            $task = new Task();
            $task->name = $request_task['name'];
            $task->deadline = $request_task['deadline'];
            $task->is_disabled = $request_task['is_disabled'];
            $task->is_completed = $request_task['is_completed'];

            array_push($tasks, $task);
        }

        return $tasks;
    }
}
