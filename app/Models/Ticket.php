<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'tickets';

    protected $fillable = [
        'codigo_ticket',
        'fecha_registro',
        'usuario_registro',
        'compania_id',
        'nombre_usuario_clasificacion',
        'ticket_titulo_registro',
        'ticket_descripcion_registro',
        'imagen_ticket_registro',
        'prioridad_id',
        'impacto_id',
        'categoria_id',
        'clasificacion_id',
        'tecnico_responsable',
        'fecha_inicio_ticket',
        'diagnostico_ticket',
        'fecha_fin_ticket',
        'respuesta_ticket',
        'fecha_respuesta_cliente',
        'respuesta_cliente',
        'estado_id',
    ];

    public function usuario_registro() { return $this->belongsTo(EntidadColaborador::class, 'usuario_registro'); }
    public function prioridad() { return $this->belongsTo(Prioridad::class, 'prioridad_id'); }
    public function impacto() { return $this->belongsTo(Impacto::class, 'impacto_id'); }
    public function categoria() { return $this->belongsTo(Categoria::class, 'categoria_id'); }
    public function clasificacion() { return $this->belongsTo(Clasificacion::class, 'clasificacion_id'); }
    public function tecnico_responsable() { return $this->belongsTo(User::class, 'tecnico_responsable'); }
    public function estado() { return $this->belongsTo(Estado::class, 'estado_id'); }
    public function compania() { return $this->belongsTo(Entidad::class, 'compania_id'); }
}
