<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntidadColaborador extends Model
{
    use HasFactory;
    protected $table = 'entidad_colaboradores';
    protected $fillable = ['nombres', 'apellidos', 'email', 'telefono', 'entidad_id', 'rol', 'activo'];

    public function compania() { return $this->belongsTo(Entidad::class, 'entidad_id'); }

    public function contactoExperiencias() { return $this->hasMany(Experiencia::class, 'id'); }
}
