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
        'contacto',
        'nombre_usuario_clasificacion',
        'ticket_titulo_registro',
        'ticket_descripcion_registro',
        'imagen_ticket_registro',
        'prioridad_id',
        'impacto_id',
        'categoria_id',
        'clasificacion_id',
        'tecnico_responsable',
        'asignado',
        'fecha_inicio_ticket',
        'diagnostico_ticket',
        'fecha_fin_ticket',
        'respuesta_ticket',
        'ticket_terminado',
        'calificado',
        'fecha_respuesta_cliente',
        'respuesta_cliente',
        'fecha_ticket_cancelado',
        'comentario_ticket_cancelado',
        'calificado_id',
        'estado_id',
    ];

    public function usuarioRegistro() { return $this->belongsTo(User::class, 'usuario_registro'); }
    public function contactoTicket() { return $this->belongsTo(EntidadColaborador::class, 'contacto'); }
    public function companiaTicket() { return $this->belongsTo(Entidad::class, 'compania_id'); }
    public function tecnicoResponsable() { return $this->belongsTo(User::class, 'tecnico_responsable'); }
    public function prioridadTicket() { return $this->belongsTo(Prioridad::class, 'prioridad_id'); }
    public function impactoTicket() { return $this->belongsTo(Impacto::class, 'impacto_id'); }
    public function categoriaTicket() { return $this->belongsTo(Categoria::class, 'categoria_id'); }
    public function clasificacionTicket() { return $this->belongsTo(Clasificacion::class, 'clasificacion_id'); }
    public function estadoTicket() { return $this->belongsTo(Estado::class, 'estado_id'); }
    public function experienciaTicket() { return $this->belongsTo(Experiencia::class, 'calificacion_id'); }
}
