<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    use HasFactory;

    protected $table = 'tipousuarios';
    protected $fillable = [
        'nombre', 'descripcion', 'slug', 'activo'
    ];

    public function rol()
    {
        return $this->hasMany(User::class, 'id');
    }
}

