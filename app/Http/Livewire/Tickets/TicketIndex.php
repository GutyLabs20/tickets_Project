<?php

namespace App\Http\Livewire\Tickets;

use App\Models\Ticket;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TicketIndex extends Component
{
    use WithPagination;

    public $categorizaciones;

    public $title;
    public $color;
    public $modal_edit = false;
    public $modal_delete = false;
    public $modal_enable = false;

    public $ticket_id, $codigo_ticket, $fecha_registro;
    public $usuario_registro, $contacto, $compania;
    public $titulo, $descripcion, $estado;

    public $modal_asignar = false;

    public $q, $activo;

    protected $listeners = [
        'render',
        'delete',
        'enable'
    ];

    public function updatingQ() { $this->resetPage(); }
    public function updatingModalDelete() { $this->resetPage(); }
    public function updatingModalEnable() { $this->resetPage(); }

    public function mount()
    {
        // $this->activo = $entidad->activo;
        $this->title = "Tickets";
        // $this->tipodocumento = DB::table('tipodocumento')->where('activo', 1)->pluck('nombre', 'id');
        // $this->categorizaciones = DB::table('tipo_atencion')->where('activo', 1)->pluck('id', 'nombre');
    }

    public function mostrarTicket($id)
    {
        // . ' - ('. date('d-m-Y', strtotime($verTicket->fecha_registro)). ')'
        $verTicket = Ticket::where('id', $id)->first();
        $dfh = Carbon::parse($verTicket->fecha_registro);
        $this->codigo_ticket = $verTicket->codigo_ticket;
        $this->fecha_registro = $dfh->diffForHumans();
        // $this->fecha_registro = $verTicket->fecha_registro;
        $this->usuario_registro = $verTicket->usuarioRegistro->usuario;
        $this->contacto = $verTicket->contactoTicket->nombres. ' '. $verTicket->contactoTicket->apellidos;
        $this->compania = $verTicket->companiaTicket->nombre;
        $this->titulo = $verTicket->ticket_titulo_registro;
        $this->descripcion = $verTicket->ticket_descripcion_registro;
        $this->estado = $verTicket->estadoTicket->nombre;
        switch ($verTicket->estado_id) {
            case (1):
                $this->color = 'orange';
                break;
            case (2):
                $this->color = 'yellow';
                break;
            case (3):
                $this->color = 'indigo';
            case (4):
                $this->color = 'green';
                break;
            case (5):
                $this->color = 'red';
                break;
            default:
                $this->color = 'grey';
        }

        $this->modal_asignar = true;
    }

    public function render()
    {
        $tickets = Ticket::latest()->paginate(10);
        return view('livewire.tickets.ticket-index',[
            'tickets' => $tickets
        ]);
    }
}
