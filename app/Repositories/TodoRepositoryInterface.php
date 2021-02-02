<?php


namespace App\Repositories;


use App\Http\Requests\StoreTodoRequest;

interface TodoRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAllTodosByUser();

    /**
     * @param StoreTodoRequest $request
     * @return mixed
     */
    public function createTodo(StoreTodoRequest $request);
}
