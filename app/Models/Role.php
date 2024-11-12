<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['role'];

    public function clients()
    {
        return $this->hasMany(Client::class, 'roles_id');
    }
    public function vendeurs()
    {
        return $this->hasMany(Vendeur::class, 'roles_id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
