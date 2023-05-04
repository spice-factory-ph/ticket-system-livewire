<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:225'],
            'description' => ['required', 'string'],
            'project_id' => ['required', 'string'],
            'type_id' => ['required', 'string'],
            'priority_id' => ['required', 'string'],
            'status_id' => ['required', 'string'],
            'assigned_to' => ['required', 'string'],
        ];
    }
}
