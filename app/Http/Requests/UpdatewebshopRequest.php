<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatewebshopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('manage-webshops');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255', 'unique:webshops,email,' . $this->webshop->id],
            'street' => ['required', 'string', 'max:50'],
            'number' => ['required', 'alpha_num', 'max:10'],
            'postal_code' => ['required', 'regex:/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i'],
            'city' => ['required', 'string'],
            'country' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'],
            'website' => ['required', 'URL', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Naam is verplicht',
            'name.string' => 'Naam mag enkel letters bevatten',
            'name.max' => 'Naam mag maximaal 50 karakters bevatten',
            'email.required' => 'Email is verplicht',
            'email.email' => 'Email moet een geldig emailadres zijn',
            'email.max' => 'Email mag maximaal 255 karakters bevatten',
            'email.unique' => 'Email is al in gebruik',
            'street.required' => 'Straat is verplicht',
            'street.string' => 'Straat mag enkel letters bevatten',
            'street.max' => 'Straat mag maximaal 50 karakters bevatten',
            'number.required' => 'Huisnummer is verplicht',
            'number.max' => 'Huisnummer mag maximaal 10 karakters bevatten',
            'postal_code.required' => 'Postcode is verplicht',
            'postal_code.regex' => 'Postcode moet een geldige postcode zijn',
            'city.required' => 'Plaats is verplicht',
            'city.string' => 'Plaats mag enkel letters bevatten',
            'country.required' => 'Land is verplicht',
            'country.string' => 'Land mag enkel letters bevatten',
            'phone.required' => 'Telefoonnummer is verplicht',
            'phone.max' => 'Telefoonnummer mag maximaal 20 karakters bevatten',
            'phone.string' => 'Telefoonnummer mag enkel letters, cijfers of andere speciale tekens bevatten',
            'website.required' => 'Website is verplicht',
            'website.URL' => 'Website moet een geldige URL zijn',
            'website.max' => 'Website mag maximaal 255 karakters bevatten',
        ];
    }
}
