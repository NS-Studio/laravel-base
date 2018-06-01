<?php

namespace App\Http\Requests\Contracts;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ( $contract = $this->route( 'contract' ) ) {

            return $this->user()->can( 'update', $contract );

        } else {

            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name'         => 'required|string',
            'customer_id'  => 'required|integer|exists:customers,id',
            'start_date'   => 'nullable|sometimes|date',
            'end_date'     => 'nullable|sometimes|date',
            'note'         => 'nullable|sometimes|string',
            'zip_code'     => 'required|integer|between:0,999999999',
            'frequence_id' => 'nullable|sometimes|exists:frequences,id',
            'status'       => 'nullable|sometimes|boolean',
            'active'       => 'nullable|sometimes|boolean',
            'external_id'  => 'nullable|sometimes|integer|between:0,999999999',
        ];
    }
}
