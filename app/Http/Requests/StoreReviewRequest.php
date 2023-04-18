<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('review-delivery');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'rating' => 'required',
            'comment' => 'required|string',
            'user_id' => 'required',
            'delivery_id' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'required_all' => 'Geef een beoordeling en ook een uitleg.',
            'rating.required' => 'Geef een aantal sterren als beoordeling',
            'comment.required' => 'We horen graag wat er (minder) goed is gegaan!'
        ];
    }
}
