<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'dateCommande',
        'statusCommande',
        'products_id',
        'vendeur_id',
        'clients_id'
    ];

    public function produit()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }

    public function vendeur()
    {
        return $this->belongsTo(Vendeur::class, 'vendeur_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'clients_id');
    }

}
