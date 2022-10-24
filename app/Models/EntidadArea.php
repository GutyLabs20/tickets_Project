<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntidadArea extends Model
{
    use HasFactory;
    protected $table = 'entidad_areas';
    protected $fillable = ['nombre', 'descripcion', 'entidad_id', 'activo'];

    public function area_entidad()
    {
        return $this->belongsTo(Entidad::class, 'entidad_id');
    }
}
