<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendeur extends Model
{
    use HasFactory;

    protected $table = 'vendeurs';

    protected $fillable = ['name','adresse','numero','email','roles_id'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'roles_id');
    }

        public function products()
    {
        return $this->hasMany(Product::class, 'vendeur_id');
    }

    public function order()
    {
        return $this->hasMany(Commande::class,'vendeur_id');
    }

    public function vente()
    {
        return $this->hasMany(Vente::class,'vendeur_id');
    }

    public function livrais()
    {
        return $this->hasMany(Livraison::class,'vendeur_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class,'vendeur_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
