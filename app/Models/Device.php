<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $table = 'devices';

    protected $fillable = ['name'];

    public function produit()
    {
        return $this->hasMany(Product::class,'devise_id');
    }

}
