<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'name'          => 'required',
            'email'         => $this->isMethod('post') ? 'required|email|unique:users,email,except,id' : 'required|email|unique:users,email,except,'.$this->id,
            'password'      => $this->isMethod('post') ? 'required' : 'nullable',
        ];
    }
}
