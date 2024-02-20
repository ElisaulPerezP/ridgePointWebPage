<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:50',
            'description' => 'required|string|max:5000',
            'message' => 'nullable|string|max:5000',
            'creation_date' => 'date',
            'creation_place' => 'string|max:255',
            'image_rights' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'response_date'=> 'nullable|date',
            'response_message' => 'nullable|string|max:5000',
        ];
    }
    
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'phone.required' => 'The phone is required.',
            'phone.string' => 'The phone must be a phone number.',
            'phone.max' => 'The phone field may not be greater than 20 characters.',
            'mail.email' => 'The mail field must be a valid email address.',
            'mail.max' => 'The mail field may not be greater than 50 characters.',
            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 5000 characters.',
            'message.string' => 'The message must be a string.',
            'message.max' => 'The message may not be greater than 5000 characters.',
            'creation_date.date' => 'The creation date must be a valid date.',
            'creation_place.string' => 'The creation place must be a string.',
            'creation_place.max' => 'The creation place may not be greater than 255 characters.',
            'image_rights.required' => 'The image rights are required.',
            'image_rights.string' => 'The image rights must be a string.',
            'image_rights.max' => 'The image rights may not be greater than 5000 characters.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The uploaded file must be of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB in size.',
            'response_date.date' => 'The response date must be a valid date.',
            'response_message.string' => 'The response message must be a string.',
            'response_message.max' => 'The response message may not be greater than 5000 characters.',
        ];
    }
}