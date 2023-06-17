<?php

namespace App\Http\Requests;

use App\Customer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'cust_party_code' => [
                'required',
            ],
            // 'purpose_date' => [
            //     'required',
            // ],
            // 'party_name' => [
            //     'required',
            // ],
            // 'address1' => [
            //     'required',
            // ],
            // 'city' => [
            //     'required',
            // ],
            // 'province' => [
            //     'required',
            // ],
            // 'country' => [
            //     'required',
            // ],
            // 'phone' => [
            //     'required',
            //     'max:12',
            //     'min:10'
            // ],
            // 'mobile' => [
            //     'required',
            //     'max:12',
            //     'min:10'
            // ],
            // 'attribute7' => [
            //     'required',
            //     'min:14',
            //     'max:15',
            // ],
            // 'postal_code' => [
            //     'required',
            //     'min:4',
            //     'max:5',
            // ],
        ];
    }

    public function messages()
    {
        return [
            // Postal code
            'postal_code.required' => 'Postal Code is required',
            'postal_code.min' => 'Postal Code must be 5 digits',
            'postal_code.max' => 'Postal Code max 5 digits',
            // NPWP
            'attribute7.required' => 'Tax Number (NPWP) is required',
            'attribute7.min' => 'Tax Number (NPWP) must be 15 digits',
            'attribute7.max' => 'Tax Number (NPWP) max 15 digits',
            // Phone
            'phone.required' => 'Phone Number is required',
            'phone.min' => 'Phone Number must be 12 digits',
            'phone.max' => 'Phone Number max 12 digits',
             // Phone
             'mobile.required' => 'Phone Number is required',
             'mobile.min' => 'Phone Number must be 12 digits',
             'mobile.max' => 'Phone Number max 12 digits',
        ];
    }
}
