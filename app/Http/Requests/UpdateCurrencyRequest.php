<?php

namespace App\Http\Requests;

use App\CurrencyGlobal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateCurrencyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('currency_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'currency_name' => [
                'required',
            ],
            'currency_code' => [
                'required',
            ],
        ];
    }
}
