<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:2000', 'min:1'],
            'page_number' => ['required', 'integer', 'min:1'],
            'position_x' => ['nullable', 'numeric', 'min:0', 'max:1'],
            'position_y' => ['nullable', 'numeric', 'min:0', 'max:1'],
            'highlight_text' => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'content.required' => 'Note content is required.',
            'content.max' => 'Note cannot exceed 2000 characters.',
            'content.min' => 'Note cannot be empty.',
            'page_number.required' => 'Page number is required.',
            'page_number.integer' => 'Page number must be a valid number.',
            'page_number.min' => 'Page number must be at least 1.',
            'position_x.numeric' => 'Position X must be a valid number.',
            'position_x.min' => 'Position X must be between 0 and 1.',
            'position_x.max' => 'Position X must be between 0 and 1.',
            'position_y.numeric' => 'Position Y must be a valid number.',
            'position_y.min' => 'Position Y must be between 0 and 1.',
            'position_y.max' => 'Position Y must be between 0 and 1.',
            'highlight_text.max' => 'Highlighted text cannot exceed 500 characters.',
        ];
    }
}
