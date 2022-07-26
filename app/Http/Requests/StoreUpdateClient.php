<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateClient extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $url = $this->segment(2);
         
        $rules = [
            'name' => ['required','min:3','max:150'],
            'email' => ['required','email',"unique:clients,email,{$url},url"],
            'date_birth' => ['nullable'] 
        ];

        return $rules;
    }
}
