<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{
    use HasFactory;
    protected $table = 'experiencia';
    protected $fillable = ['satisfaccion', 'valor', 'colaborador_id', 'ticket_id', 'fecha_calificacion'];

    public function experienciasTickets() { return $this->hasMany(Ticket::class, 'id'); }
    // public function experienciaContacto() { return $this->belongsTo(EntidadColaborador::class, 'colaborador_id'); }
    // public function experienciaTicket() { return $this->belongsTo(Ticket::class, 'ticket_id'); }
}
