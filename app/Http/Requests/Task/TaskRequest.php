<?php

namespace App\Http\Requests\Task;

use App\Enums\TaskFrequency;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
            'title'       => 'required|string|max:25',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string|max:50',
            'due_date'    => [
                'required',
                Rule::date()->afterOrEqual(today()),
                Rule::date()->format('Y-m-d\TH:i:s'),
            ],
            'status'    => ['required', Rule::enum(TaskStatus::class)],
            'frequency' => ['required', Rule::enum(TaskFrequency::class)],
        ];
    }
}
