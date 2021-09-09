<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Contact extends FormRequest
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
        return [
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required|min:10'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Votre adresse email est obligatoire',
            'email.email' => 'Le format de votre adresse email est incorrect',
            'subject.required' => 'Le sujet de votre message est obligatoire',
            'subject.alpha_num' => 'Le sujet ne peux pas contenir de caractères spéciaux',
            'message.required' => 'Le message est obligatoire',
            'message.min' => 'Le message doit faire un minimum de 10 caractères'
        ];
    }

    public function attributes()
    {
        return [
            //
        ];
    }
}
