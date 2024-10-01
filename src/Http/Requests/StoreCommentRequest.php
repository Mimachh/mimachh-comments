<?php

namespace Mimachh\Comments\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->id === $this->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
            'parent_comment_id' => 'nullable|integer',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string',
        ];
    }
}