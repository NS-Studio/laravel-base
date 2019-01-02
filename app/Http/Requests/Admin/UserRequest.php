<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name'     => 'required|string',
            'email'    => [

                'required',
                'email',
                Rule::unique( 'users' )->ignore( $this->id ),
            ],
            'password' => 'nullable|sometimes|string|min:6',
            'role'     => 'required|string|in:user,admin',
        ];
    }
}
