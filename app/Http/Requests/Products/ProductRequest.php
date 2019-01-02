<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
                Rule::unique( 'products', 'number' )->ignore( $this->id, 'id' )->where( 'user_id', auth()->user()
                    ->id ),
            ],
            'product_group_id' => 'required|exists:product_groups,id',
            'sales_price'      => 'required|numeric',
            'cost_price'       => 'required|numeric',
            'note'             => 'nullable|sometimes|string',
        ];
    }
}
