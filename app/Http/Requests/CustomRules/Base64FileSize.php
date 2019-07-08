<?php


namespace App\Http\Requests\CustomRules;


use Illuminate\Contracts\Validation\Rule;

class Base64FileSize implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $size = 0;
        foreach ($value as $item) {
            $size += (int) strlen(base64_decode($item));
        }
        return $size < 1572864*3 ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return 'Files send too big';
    }
}
