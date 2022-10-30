<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoteurRequest extends FormRequest
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
            'marque_id'    => 'required|integer',
            'unite_id'     => 'required|integer',
            'user_id'      => 'required|integer',
            'puissance'    => 'required',
            'courant'      => 'required',
            'vitesse'      => '',
            'frequence'    => '',
            'tension'      => '',
            'cosph'        => '',
            'roulement_a'  => '',
            'roulement_b'  => '',
            'couplage'     => '',
            'n_serie'      => 'required',
        ];
    }
}
