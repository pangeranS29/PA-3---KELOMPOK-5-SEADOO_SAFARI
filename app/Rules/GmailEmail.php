<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GmailEmail implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Validasi format email Gmail
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $domain = substr(strrchr($value, "@"), 1);
        $gmailDomains = ['gmail.com', 'googlemail.com'];

        return in_array($domain, $gmailDomains);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Harus menggunakan email Gmail yang valid (contoh: @gmail.com)';
    }
}
