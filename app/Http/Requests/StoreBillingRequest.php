<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillingRequest extends FormRequest
{
    public function authorize()
    {
        return true; // make sure the request is authorized
    }

    public function rules()
    {
        return [
            'patient_id'     => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'due_date'       => 'required|date',
            'status' => 'required|in:' . implode(',', \App\Models\Billing::$statuses),
            'items'          => 'nullable|array',
            'items.*.description' => 'required|string',
            'items.*.quantity'    => 'required|numeric|min:1',
            'items.*.unit_price'  => 'required|numeric|min:0',
        ];
    }
}
