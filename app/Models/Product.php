<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'desc',
        'category_id',
        'type_id',
        'image',
        'name',
        'prixUnit',
        'devise_id',
        'vendeur_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }


    public function vente()
    {
        return $this->hasMany(Vente::class,'products_id');
    }

    public function achat()
    {
        return $this->hasMany(Achat::class,'products_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class,'product_id');
    }
    public function order()
    {
        return $this->hasMany(Commande::class,'products_id');
    }

    public function livrais()
    {
        return $this->hasMany(Livraison::class,'products_id');
    }
    public function payer()
    {
        return $this->hasMany(Paiement::class,'products_id');
    }

    public function devise()
    {
        return $this->belongsTo(Device::class,'devise_id');
    }

    public function vendeurs()
    {
        return $this->belongsTo(Vendeur::class, 'vendeur_id');
    }

}
