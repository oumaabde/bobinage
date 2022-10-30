<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unite extends Model
{
    use HasFactory;

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'imputation'
    ];

    public function moteurs()
    {
        return $this->hasMany(Moteur::class);
    }

}
