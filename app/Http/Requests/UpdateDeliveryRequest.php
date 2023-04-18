<?php

namespace App\Http\Requests;

use App\Models\enums\DeliveryStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDeliveryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        //return $this->user()->can('update-status-delivery');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'track_and_trace_code' => 'required',
            'delivery_status' => 'required',
        ];
    }
}
