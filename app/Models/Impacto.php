<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impacto extends Model
{
    use HasFactory;
    protected $table = 'impacto';
    protected $fillable = ['nombre', 'descripcion', 'activo'];
}
