<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';
    protected $fillable = ['nombre', 'descripcion', 'activo'];

    public function categoria_tickets()
    {
        return $this->hasMany(Ticket::class, 'id');
    }
}
