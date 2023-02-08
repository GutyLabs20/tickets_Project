<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;
    protected $table = 'entidad';
    protected $fillable = [
        'tipo_doc', 'nro_doc', 'nombre', 'descripcion',
        'logotipo_path', 'logotipo_nombre', 'telefono', 'email',
        'created_by', 'activo'
    ];

    public function colaboradores()
    {
        $this->hasMany(EntidadColaborador::class, 'id');
    }
}
