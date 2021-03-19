<?php

namespace App\Http\Requests\LostDogs;

use Illuminate\Foundation\Http\FormRequest;

class LostDogsRequest extends FormRequest
{
   /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "description" => "required",
            "last_seen_at" => "required",
        ];
    }
}
