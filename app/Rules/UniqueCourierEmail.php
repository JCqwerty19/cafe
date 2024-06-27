<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UniqueCourierEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Gaining cirrent courier id
        $courier_id = Auth::guard('courier')->user()->id;

        // Checking existanse the same email in the DB
        return !DB::table('couriers')
            ->where('email', $value)
            ->where('id', '<>', $courier_id)
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This email alredy have been registered as a courier';
    }
}
