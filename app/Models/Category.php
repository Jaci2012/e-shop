<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['designation'];

    // Relation avec les produits
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}


