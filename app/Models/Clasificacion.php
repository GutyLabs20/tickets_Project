<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    use HasFactory;
    protected $table = 'clasificaciones';
    protected $fillable = ['nombre', 'descripcion', 'activo'];

    public function clasificacion_tickets()
    {
        return $this->hasMany(Ticket::class, 'id');
    }
}
