<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
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
            'name.required' => 'Введите название.',
            'name.string' => 'Название должно быть строкой.',
            'name.max' => 'Название не должно превышать 255 символов.',
            'image.image' => 'Файл должен быть изображением.',
            'image.max' => 'Размер изображения не должен превышать 2 МБ.',
            'category_id.required' => 'Выберите категорию.',
            'category_id.exists' => 'Выбранная категория не существует.',
            'short_description.string' => 'Краткое описание должно быть строкой.',
            'short_description.max' => 'Краткое описание не должно превышать 255 символов.',
            'description.string' => 'Описание должно быть строкой.',
        ];
    }
}
