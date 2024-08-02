<?php

namespace App\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;

class TasksRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'project' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name' => 'The task name is required',
            'project' => 'The task name is required',
        ];
    }

    public function getTaskData($taskPriorityNumber): array
    {
        $taskData = [
            'name' => $this->get('name'),
            'project_id' => $this->get('project'),
            'priority' => $taskPriorityNumber + 1,
        ];

        if ($this->isMethod('PATCH')) {
            $taskData['priority'] = $taskPriorityNumber;
        }

        return $taskData;
    }
}
