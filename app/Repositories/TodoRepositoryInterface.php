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

    /**
     * @param int $id
     * @return mixed
     */
    public function getTodoById(int $id);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteTodoById(int $id): bool;
}
