<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    use HasFactory;
    protected $table = 'achats';

    protected $fillable = [
        'products_id',
        'clients_id',
        'quantity'
    ];

    public function produit()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'clients_id');
    }

    public function payer()
    {
        return $this->hasMany(Paiement::class,'achats_id');
    }
}
