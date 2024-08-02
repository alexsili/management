<?php

namespace App\Http\Requests\Projects;

use Illuminate\Foundation\Http\FormRequest;

class ProjectsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'name' => 'The project name is required'
        ];
    }

    public function getProjectData(): array
    {
        return [
            'name' => $this->get('name'),
        ];
    }
}
