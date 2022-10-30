<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RapportRequest extends FormRequest
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
            'n_ot' => '',
            'moteur_id' => '',
            'user_id' => '',
            'recepteur_id' => '',
            'local_id' => '',
            'testeur_id' => '',
            'noms_participants_test' => '',
            'preneur' => '',
            'emetteur' => '',
            'description' => '',
            'n_bobines' => '',
            'n_groupes' => '',
            'n_bobines_group' => '',
            'n_spires_bobine' => '',
            'n_phases' => '',
            'n_encouches' => '',
            'n_poles' => '',
            'pas' => '',
            'n_fils_encouche' => '',
            'n_fil_1' => '',
            'n_fil_2' => '',
            'n_fil_3' => '',
            'n_fil_4' => '',
            'n_fil_5' => '',
            'n_fil_6' => '',
            'n_fil_7' => '',
            'n_fil_8' => '',
            'n_fil_9' => '',
            'n_fil_10' => '',
            'phase_test_a' => '',
            'phase_test_b' => '',
            'phase_test_c' => '',
            'travaux_effectues' => '',
            'date_reception' => '',
            'date_essai' => '',
            'date_enlevement' => '',
            'rapport' => '',
            'statut' => '',
            'modification' => ''
        ];
    }
}
