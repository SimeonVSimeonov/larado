<?php

namespace App\Http\Requests;

use App\Rules\UserTodoName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Gate::allows('owns-this-todo', $this->todo)) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'is_completed' => 'required|boolean',
            'name' => ['required','string','max:64', new UserTodoName($this->todo)],
            'tasks' => 'present|array',
            'tasks.*.name' => 'required|string|max:64|distinct',
            'tasks.*.deadline' => 'required|date',
            'tasks.*.is_disabled' => 'required|boolean',
            'tasks.*.is_completed' => 'required|boolean',
            'tasks_delete' => 'present|array'
        ];
    }
}
