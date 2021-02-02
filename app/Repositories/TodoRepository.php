<?php


namespace App\Repositories;


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

}
