<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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

            'name'              => 'required|string',
            'number'            => [
                'required',
                'integer',
                Rule::unique( 'customers' )->ignore( $this->id, 'id' )->where( 'user_id', auth()->user()
                    ->id ),
            ],
            'vat_number'        => 'nullable|sometimes|integer',
            'address'           => 'nullable|sometimes|string',
            'zip_code'          => 'nullable|sometimes|numeric',
            'city'              => 'nullable|sometimes|string',
            'phone'             => 'nullable|sometimes|numeric',
            'email'             => 'nullable|sometimes|string',
            'ean_number'        => 'nullable|sometimes|integer',
            'contact_person'    => 'nullable|sometimes|string',
            'customer_group_id' => 'required|integer|exists:customer_groups,id',
        ];
    }
}
