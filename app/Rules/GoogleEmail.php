<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class GoogleEmail implements Rule
{
    public function passes($attribute, $email)
    {
        // List of allowed Google domains
        $allowedDomains = [
            'gmail.com',
            'googlemail.com',
            // Add your Google Workspace domains if needed
            // 'yourdomain.com',
        ];

        // Extract domain from email
        $domain = Str::afterLast($email, '@');

        // Check if domain is in allowed list
        return in_array(strtolower($domain), $allowedDomains);
    }

    public function message()
    {
        return 'Please use a valid Google email (Gmail or Google Workspace).';
    }
}
