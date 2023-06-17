<?php

namespace App\Http\Requests;

use App\Project;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreVendorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'vendor_id'       => [
                'required',
            ],
            // 'client_id'  => [
            //     'required',
            //     'integer',
            // ],
            // 'start_date' => [
            //     'date_format:' . config('panel.date_format'),
            //     'nullable',
            // ],
        ];
    }
}
