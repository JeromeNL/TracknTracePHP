<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Het :attribute veld moet aangevinkt zijn.',
    'accepted_if' => 'Het :attribute veld moet aangevinkt zijn als :other :value is.',
    'active_url' => 'Het :attribute veld moet een geldige URL zijn.',
    'after' => 'Het :attribute veld moet een datum na :date zijn.',
    'after_or_equal' => 'Het :attribute veld moet een datum op of na :date zijn.',
    'alpha' => 'Het :attribute veld mag enkel letters bevatten.',
    'alpha_dash' => 'Het :attribute veld mag alleen letters, cijfers, streepjes, en laag liggende streepjes bevatten.',
    'alpha_num' => 'Het :attribute veld mag alleen letters and numbers bevatten.',
    'array' => 'Het :attribute veld moet een array zijn.',
    'ascii' => 'Het :attribute veld mag alleen alfanumerieke tekens van één byte en symbolen bevatten.',
    'before' => 'Het :attribute veld must be a date before :date.',
    'before_or_equal' => 'Het :attribute veld moet een datum op of voor :date zijn.',
    'between' => [
        'array' => 'Het :attribute veld must have between :min and :max items.',
        'file' => 'Het :attribute veld must be between :min and :max kilobytes.',
        'numeric' => 'Het :attribute veld must be between :min and :max.',
        'string' => 'Het :attribute veld must be between :min and :max characters.',
    ],
    'boolean' => 'Het :attribute veld moet juist of onjuist zijn.',
    'confirmed' => 'Het :attribute field confirmation does not match.',
    'current_password' => 'Het wachtwoord is onjuist.',
    'date' => 'Het :attribute veld moet een geldige datum zijn.',
    'date_equals' => 'Het :attribute veld moet een datum gelijk aan :date zijn.',
    'date_format' => 'Het :attribute veld moet voldoen aan het format :format.',
    'decimal' => 'Het :attribute veld must have :decimal decimal places.',
    'declined' => 'Het :attribute veld must be declined.',
    'declined_if' => 'Het :attribute veld must be declined when :other is :value.',
    'different' => 'Het :attribute veld and :other must be different.',
    'digits' => 'Het :attribute veld must be :digits digits.',
    'digits_between' => 'Het :attribute veld must be between :min and :max digits.',
    'dimensions' => 'Het :attribute veld has invalid image dimensions.',
    'distinct' => 'Het :attribute veld has a duplicate value.',
    'doesnt_end_with' => 'Het :attribute veld must not end with one of the following: :values.',
    'doesnt_start_with' => 'Het :attribute veld must not start with one of the following: :values.',
    'email' => 'Het :attribute veld must be a valid email address.',
    'ends_with' => 'Het :attribute veld must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'Het :attribute veld must be a file.',
    'filled' => 'Het :attribute veld must have a value.',
    'gt' => [
        'array' => 'Het :attribute veld must have more than :value items.',
        'file' => 'Het :attribute veld must be greater than :value kilobytes.',
        'numeric' => 'Het :attribute veld must be greater than :value.',
        'string' => 'Het :attribute veld must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'Het :attribute veld must have :value items or more.',
        'file' => 'Het :attribute veld must be greater than or equal to :value kilobytes.',
        'numeric' => 'Het :attribute veld must be greater than or equal to :value.',
        'string' => 'Het :attribute veld must be greater than or equal to :value characters.',
    ],
    'image' => 'Het :attribute veld must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'Het :attribute veld must exist in :other.',
    'integer' => 'Het :attribute veld must be an integer.',
    'ip' => 'Het :attribute veld must be a valid IP address.',
    'ipv4' => 'Het :attribute veld must be a valid IPv4 address.',
    'ipv6' => 'Het :attribute veld must be a valid IPv6 address.',
    'json' => 'Het :attribute veld must be a valid JSON string.',
    'lowercase' => 'Het :attribute veld must be lowercase.',
    'lt' => [
        'array' => 'Het :attribute veld must have less than :value items.',
        'file' => 'Het :attribute veld must be less than :value kilobytes.',
        'numeric' => 'Het :attribute veld must be less than :value.',
        'string' => 'Het :attribute veld must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'Het :attribute veld must not have more than :value items.',
        'file' => 'Het :attribute veld must be less than or equal to :value kilobytes.',
        'numeric' => 'Het :attribute veld must be less than or equal to :value.',
        'string' => 'Het :attribute veld must be less than or equal to :value characters.',
    ],
    'mac_address' => 'Het :attribute veld must be a valid MAC address.',
    'max' => [
        'array' => 'Het :attribute veld must not have more than :max items.',
        'file' => 'Het :attribute veld must not be greater than :max kilobytes.',
        'numeric' => 'Het :attribute veld must not be greater than :max.',
        'string' => 'Het :attribute veld must not be greater than :max characters.',
    ],
    'max_digits' => 'Het :attribute veld must not have more than :max digits.',
    'mimes' => 'Het :attribute veld must be a file of type: :values.',
    'mimetypes' => 'Het :attribute veld must be a file of type: :values.',
    'min' => [
        'array' => 'Het :attribute veld must have at least :min items.',
        'file' => 'Het :attribute veld must be at least :min kilobytes.',
        'numeric' => 'Het :attribute veld must be at least :min.',
        'string' => 'Het :attribute veld must be at least :min characters.',
    ],
    'min_digits' => 'Het :attribute veld must have at least :min digits.',
    'missing' => 'Het :attribute veld must be missing.',
    'missing_if' => 'Het :attribute veld must be missing when :other is :value.',
    'missing_unless' => 'Het :attribute veld must be missing unless :other is :value.',
    'missing_with' => 'Het :attribute veld must be missing when :values is present.',
    'missing_with_all' => 'Het :attribute veld must be missing when :values are present.',
    'multiple_of' => 'Het :attribute veld must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'Het :attribute veld format is invalid.',
    'numeric' => 'Het :attribute veld must be a number.',
    'password' => [
        'letters' => 'Het :attribute veld must contain at least one letter.',
        'mixed' => 'Het :attribute veld must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'Het :attribute veld must contain at least one number.',
        'symbols' => 'Het :attribute veld must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'Het :attribute veld must be present.',
    'prohibited' => 'Het :attribute veld is prohibited.',
    'prohibited_if' => 'Het :attribute veld is prohibited when :other is :value.',
    'prohibited_unless' => 'Het :attribute veld is prohibited unless :other is in :values.',
    'prohibits' => 'Het :attribute veld prohibits :other from being present.',
    'regex' => 'Het :attribute veld format is invalid.',
    'required' => 'Het :attribute veld is required.',
    'required_array_keys' => 'Het :attribute veld must contain entries for: :values.',
    'required_if' => 'Het :attribute veld is required when :other is :value.',
    'required_if_accepted' => 'Het :attribute veld is required when :other is accepted.',
    'required_unless' => 'Het :attribute veld is required unless :other is in :values.',
    'required_with' => 'Het :attribute veld is required when :values is present.',
    'required_with_all' => 'Het :attribute veld is required when :values are present.',
    'required_without' => 'Het :attribute veld is required when :values is not present.',
    'required_without_all' => 'Het :attribute veld is required when none of :values are present.',
    'same' => 'Het :attribute veld must match :other.',
    'size' => [
        'array' => 'Het :attribute veld must contain :size items.',
        'file' => 'Het :attribute veld must be :size kilobytes.',
        'numeric' => 'Het :attribute veld must be :size.',
        'string' => 'Het :attribute veld must be :size characters.',
    ],
    'starts_with' => 'Het :attribute veld must start with one of the following: :values.',
    'string' => 'Het :attribute veld must be a string.',
    'timezone' => 'Het :attribute veld must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'uppercase' => 'Het :attribute veld must be uppercase.',
    'url' => 'Het :attribute veld must be a valid URL.',
    'ulid' => 'Het :attribute veld must be a valid ULID.',
    'uuid' => 'Het :attribute veld must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
