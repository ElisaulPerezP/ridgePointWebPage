<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePendingMatterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'message' => 'sometimes|required|string',
            'creation_date' => 'sometimes|required|date',
            'creation_place' => 'sometimes|required|string',
            'client_id' => 'sometimes|required|exists:users,id',
            'responsible_id' => 'sometimes|required|exists:users,id',
        ];
    }
}
