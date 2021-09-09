<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class newsletterUnsub extends FormRequest
{

    protected $errorBag = 'newsletter_unsub';

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
        return [
            'newsletter_email' => 'required|email'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Veuillez renseigner votre email',
            "email.email" => 'Votre adresse email n\'est pas valide',
        ];
    }

    public function attributes()
    {
        return[
            //
        ];
    }
}
