<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable = [
        'datePaiement',
        'statusPaiement',
        'products_id',
        'clients_id',
        'achats_id'

    ];

    public function produit() {
        return $this->belongsTo( Product::class, 'products_id' );
    }

    public function client() {
        return $this->belongsTo( Client::class, 'clients_id' );
    }

    public function achat() {
        return $this->belongsTo( Achat::class, 'achats_id' );
    }


}
