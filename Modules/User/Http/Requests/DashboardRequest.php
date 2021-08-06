<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DashboardRequest extends FormRequest
{

    public function authorize()
    {
        return TRUE;
    }

    public function rules()
    {
        return [
            'week' => 'nullable|numeric',
        ];
    }
}
