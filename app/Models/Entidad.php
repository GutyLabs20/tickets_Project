<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;
    protected $table = 'entidad';
    protected $fillable = [
        'tipo_doc', 'nro_doc', 'nombre', 'slug', 'descripcion',
        'logotipo_path', 'lototipo_nombre', 'telefono', 'email', 'activo'
    ];
}
