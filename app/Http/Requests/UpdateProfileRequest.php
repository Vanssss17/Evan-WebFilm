<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name'   => ['required', 'string', 'max:255'],
            'umur'   => ['required', 'integer', 'between:1,120'],
            'bio'    => ['required', 'string', 'max:1000'],
            'alamat' => ['required', 'string', 'max:500'],
        ];
    }
}
