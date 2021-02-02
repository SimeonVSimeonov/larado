<?php


namespace App\Repositories;


use App\Http\Requests\StoreTodoRequest;

interface TodoRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAllTodosByUser();

    public function createTodo(StoreTodoRequest $request);
}
