<?php


namespace App\Repositories;


interface TodoRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAllTodosByUser();
}
