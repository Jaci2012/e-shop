<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;
    protected $table = 'transports';

    protected $fillable = ['type','vehicule','villes_id'];

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'villes_id');
    }

    public function livrais()
    {
        return $this->hasMany(Livraison::class,'transports_id');
    }

}
