<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'quantity', 'date_entry','vendeur_id']; // Assurez-vous que 'product_id' est correct

    public function produit()
    {
        return $this->belongsTo(Product::class, 'product_id'); // Modifiez ici
    }

    public function vendeurs()
    {
        return $this->belongsTo(Vendeur::class, 'vendeur_id');
    }
}
