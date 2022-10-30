<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class Moteur extends Model
{
    use HasFactory;

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'marque_id',
        'unite_id',
        'user_id',
        'puissance',
        'courant',
        'vitesse',
        'frequence',
        'tension',
        'cosph',
        'roulement_a',
        'roulement_b',
        'couplage',
        'n_serie',
    ];

    public function unite(){
        return $this->belongsTo(Unite::class);
    }

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }

    public function ots()
    {
        return $this->hasMany(Ot::class);
    }

}
