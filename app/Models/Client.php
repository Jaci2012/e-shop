<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';

    protected $fillable = ['name', 'adresse', 'numero', 'email', 'roles_id'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'roles_id');
    }

    public function vente()
    {
        return $this->hasMany(Vente::class, 'clients_id');
    }

    public function achat()
    {
        return $this->hasMany(Achat::class,'clients_id');
    }

    public function order()
    {
        return $this->hasMany(Commande::class,'clients_id');
    }

    public function livrais()
    {
        return $this->hasMany(Livraison::class,'clients_id');
    }

    public function payer()
    {
        return $this->hasMany(Paiement::class,'clients_id');
    }
}

