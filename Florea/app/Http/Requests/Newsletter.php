<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Newsletter extends FormRequest
{
    protected $errorBag = 'newsletter';

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
            'newsletter_email' => 'required|email|unique:newsletters',
        ];
    }

    public function messages()
    {
        return [
            'newsletter_email.required' => 'Vous devez renseigner votre addresse mail',
            'newsletter_email.email' => 'Votre adresse email n\'est pas renseignée',
            'newsletter_email.unique' => 'Cette adresse mail est déja utilisée',
        ];
    }

    public function attributes()
    {
        return [
            //
        ];
    }
}
