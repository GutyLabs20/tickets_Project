<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntidadCargo extends Model
{
    use HasFactory;
    protected $table = 'entidad_cargos';
    protected $fillable = ['nombre', 'descripcion', 'activo'];
}
