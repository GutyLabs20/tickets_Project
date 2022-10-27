<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntidadColaborador extends Model
{
    use HasFactory;
    protected $table = 'entidad_colaboradores';
    protected $fillable = ['nombres', 'apellidos', 'email', 'telefono', 'slug', 'area_id', 'entidad_id', 'puesto', 'activo'];

    public function colaborador_area()
    {
        return $this->belongsTo(EntidadArea::class, 'area_id');
    }
}
