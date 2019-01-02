<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
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
            'number'           => [

                'required',
                Rule::unique( 'product_groups', 'number' )->ignore( $this->id, 'id' )->where( 'user_id', auth()->user()
                    ->id ),
            ],
            'economic_account' => 'required|integer',
            'has_inventory'    => 'nullable|sometimes|boolean',
        ];
    }
}
