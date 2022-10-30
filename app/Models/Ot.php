<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ot extends Model
{
    use HasFactory;

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'n_ot',
        'moteur_id',
        'user_id',
        'recepteur_id',
        'local_id',
        'testeur_id',
        'responsable_id',
        'noms_participants_test',
        'preneur',
        'emetteur',
        'description',
        'n_bobines',
        'n_groupes',
        'n_bobines_group',
        'n_spires_bobine',
        'n_phases',
        'n_encouches',
        'n_poles',
        'pas',
        'n_fils_encouche',
        'n_fil_1',
        'n_fil_2',
        'n_fil_3',
        'n_fil_4',
        'n_fil_5',
        'n_fil_6',
        'n_fil_7',
        'n_fil_8',
        'n_fil_9',
        'n_fil_10',
        'phase_test_a',
        'phase_test_b',
        'phase_test_c',
        'travaux_effectues',
        'date_reception',
        'date_essai',
        'date_enlevement',
        'rapport',
        'statut',
        'modification',
        'connexion',
        'responsable_id'
    ];

    public function moteur()
    {
        return $this->belongsTo(Moteur::class);
    }

    public function local()
    {
        return $this->belongsTo(Local::class);
    }


    public function recepteur()
    {
        return $this->belongsTo(Agent::class, 'recepteur_id');
    }

    public function testeur()
    {
        return $this->belongsTo(Agent::class, 'testeur_id');
    }
    
    public function responsable()
    {
        return $this->belongsTo(Agent::class, 'responsable_id');
    }
}
