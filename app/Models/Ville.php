<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $table = 'villes';

    protected $fillable = ['name','cp'];

    public function livrais()
    {
        return $this->hasMany(Livraison::class,'villes_id');
    }

}
