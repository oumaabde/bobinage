<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function ots_receptionner()
    {
        return $this->hasMany(Ot::class, 'recepteur_id');
    }

    public function ots_tester()
    {
        return $this->hasMany(Ot::class, 'testeur_id');
    }
}
