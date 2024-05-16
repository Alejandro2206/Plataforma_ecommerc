<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'product_id' => 'required',
            'quantity' => 'required|numeric',
            'reference_number' => 'required|unique:ventas,reference_number|max:255',
            'total_amount' => 'required|numeric',
            'client_id' => 'required',
            'status' => 'required'
        ];

        
    }
}
