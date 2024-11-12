<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;
    protected $table = 'ventes';

    protected $fillable = ['clients_id','products_id','vendeur_id'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'clients_id');
    }

    public function produit()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }

    public function vendeurs()
    {
        return $this->belongsTo(Vendeur::class, 'vendeur_id');
    }

}

