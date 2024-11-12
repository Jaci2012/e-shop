<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model {
    use HasFactory;

    protected $fillable = [
        'dateLivraison',
        'statusLivraison',
        'products_id',
        'clients_id',
        'villes_id',
        'transports_id',
        'vendeur_id'
    ];

    public function produit() {
        return $this->belongsTo( Product::class, 'products_id' );
    }

    public function client() {
        return $this->belongsTo( Client::class, 'clients_id' );
    }

    public function ville() {
        return $this->belongsTo( Ville::class, 'villes_id' );
    }

    public function transport() {
        return $this->belongsTo( Transport::class, 'transports_id' );
    }

    public function vendeurs()
    {
        return $this->belongsTo(Vendeur::class, 'vendeur_id');
    }

}
