<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>'required|max:6',
            'prenom'=>'required',
            'email' => 'required|string|email|max:255|unique:users',
            'numero' => 'required|max:20|unique:users',

        ];
    }

    public function messages()
    {
        return [
            'numero.required'=>'Veillez renseigner le numero',
            'name.required'=>'Veillez renseigner le nom',
            'prenom.required'=>'Veillez renseigner le prenom',

            'numero.unique'=>'Ce numero est déja utilsé par un autre compte',
            'numero.max'=>'Le numero n\'est pas valide',
            'email.required'=>'L\'adresse email est obligatoire',
            'email.unique'=>'Cette adresse email est déja utilisée par un autre compte',
            'email.email'=>'L\'adresse email n\'est pas valide',



        ];
    }
}
