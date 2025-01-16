<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ValidateMenu extends FormRequest
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
    public function rules(Request $request): array
    {
        return [
            'title' => 'required|unique:menus,title|max:255',
            'slug' => 'required|string|max:255',
            'order_no' => 'required|integer',
            'parent_id' => 'nullable|sometimes|exists:menus,id',
            'icon'     => 'required'
        ];
    }
}
