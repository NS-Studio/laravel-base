<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'             => 'required|string',
            'economic_account' => 'required|integer',
            'number'           => [
                'required',
                Rule::unique( 'customer_groups', 'number' )->ignore( $this->id )->where( 'user_id', auth()->user()
                    ->id ),
            ],
        ];
    }
}
