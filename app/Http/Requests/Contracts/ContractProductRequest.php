<?php

namespace App\Http\Requests\Contracts;

use Illuminate\Foundation\Http\FormRequest;

class ContractProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $contract = $this->route( 'contract' );

        return $contract && $this->user()->can( 'update', $contract );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'products.0.id'       => 'required_with:products.0.quantity,products.0.price',
            'products.0.quantity' => 'required_with:products.0.id,products.0.price',
            'products.0.price'    => 'required_with:products.0.id,products.0.quantity',
            'products.1.id'       => 'required_with:products.1.quantity,products.1.price',
            'products.1.quantity' => 'required_with:products.1.id,products.1.price',
            'products.1.price'    => 'required_with:products.1.id,products.1.quantity',
            'products.2.id'       => 'required_with:products.2.quantity,products.2.price',
            'products.2.quantity' => 'required_with:products.2.id,products.2.price',
            'products.2.price'    => 'required_with:products.2.id,products.2.quantity',
            'products.3.id'       => 'required_with:products.3.quantity,products.3.price',
            'products.3.quantity' => 'required_with:products.3.id,products.3.price',
            'products.3.price'    => 'required_with:products.3.id,products.3.quantity',
            'products.4.id'       => 'required_with:products.4.quantity,products.4.price',
            'products.4.quantity' => 'required_with:products.4.id,products.4.price',
            'products.4.price'    => 'required_with:products.4.id,products.4.quantity',
        ];
    }

    public function messages()
    {
        return [

            'products.*.id.required_with'       => 'You must select product if price or quantity is defined.',
            'products.*.quantity.required_with' => 'You must set quantity if product is selected and price is entered.',
            'products.*.price.required_with'    => 'You must set price if product is selected and quantity is entered.',
        ];
    }
}
