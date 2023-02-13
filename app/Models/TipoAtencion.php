<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAtencion extends Model
{
    use HasFactory;
    protected $table = 'tipo_atencion';
    protected $fillable = ['nombre', 'descripcion', 'activo'];

    public function companias()
    {
        return $this->hasMany(Entidad::class, 'id');
    }
}
