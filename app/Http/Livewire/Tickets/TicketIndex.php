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
    public $color, $colorCol, $colorPrioridad, $colorImpacto;
    public $modal_edit = false;
    public $modal_delete = false;
    public $modal_enable = false;

    public $ticket_id, $codigo_ticket, $fecha_registro, $pn, $prioAtencion, $impAtencion, $categoriaAtencion, $clasificacionAtencion;
    public $usuario_registro, $contacto, $compania, $rolcontacto;
    public $titulo, $descripcion, $estado, $asignado;
    public $ticket, $prioridad, $impacto, $categoria, $clasificacion, $tecnicoAsignado;
    // public $ticket, $prioridad_id, $impacto_id, $categoria_id, $clasificacion_id, $tecnico_responsable;
    public $listaTecnicos = [], $listaPrioridades = [], $listaImpactos = [], $listaClasificaciones = [], $listeaCategorias = [];

    public $modal_ver = false, $modal_asignar = false, $modal_atencion = false;

    public $q, $activo;

    protected $listeners = [
        'render',
        'delete',
        'enable'
    ];

    public function rules()
    {
        // 'impacto' => 'required',
        return [
            'prioridad' => 'required',
            'categoria' => 'required',
            'clasificacion' => 'required',
            'tecnicoAsignado' => 'required',
        ];
    }

    public function modelData()
    {
        // 'impacto_id' => $this->impacto,
        return [
            'prioridad_id' => $this->prioridad,
            'categoria_id' => $this->categoria,
            'clasificacion_id' => $this->clasificacion,
            'tecnico_responsable' => $this->tecnicoAsignado,
        ];
    }

    // public function rules()
    // {
    //     return [
    //         'prioridad_id' => 'required',
    //         'impacto_id' => 'required',
    //         'categoria_id' => 'required',
    //         'clasificacion_id' => 'required',
    //         'tecnico_responsable' => 'required',
    //     ];
    // }

    // public function modelData()
    // {
    //     return [
    //         'prioridad_id' => $this->prioridad_id,
    //         'impacto_id' => $this->impacto_id,
    //         'categoria_id' => $this->categoria_id,
    //         'clasificacion_id' => $this->clasificacion_id,
    //         'tecnico_responsable' => $this->tecnico_responsable,
    //     ];
    // }

    public function modelAsignado() { return [ 'asignado' => true, ]; }

    public function updatingQ() { $this->resetPage(); }
    public function updatingModalDelete() { $this->resetPage(); }
    public function updatingModalEnable() { $this->resetPage(); }

    public function mount()
    {
        $this->resetPage();
        $this->title = "Tickets";
        $e = DB::table('tipousuarios')->where('nombre', 'Tecnico De Soporte')->first();
        $this->listaTecnicos = DB::table('users')->select(DB::raw('CONCAT(nombres, " ", apellidos) as tecnico'), 'id')
            ->where('tipousuario_id', $e->id)->where('is_staff', true)->where('activo', 1)->get()->pluck('tecnico', 'id');
        $this->listaPrioridades = DB::table('prioridades')->where('activo', 1)->pluck('nombre', 'id');
        $this->listaImpactos = DB::table('impacto')->where('activo', 1)->pluck('nombre', 'id');
        $this->listaClasificaciones = DB::table('clasificaciones')->where('activo', 1)->pluck('nombre', 'id');
        $this->listeaCategorias = DB::table('categorias')->where('activo', 1)->pluck('nombre', 'id');
    }

    public function mostrarTicket($id)
    {
        // . ' - ('. date('d-m-Y', strtotime($verTicket->fecha_registro)). ')'
        $verTicket = Ticket::where('id', $id)->first();
        $dfh = Carbon::parse($verTicket->fecha_registro);
        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;
        $this->fecha_registro = $dfh->diffForHumans();
        // $this->fecha_registro = $verTicket->fecha_registro;
        // $this->fecha_registro = $dfh->isoFormat('LLLL');
        $this->usuario_registro = $verTicket->usuarioRegistro->usuario;
        $this->contacto = $verTicket->contactoTicket->nombres. ' '. $verTicket->contactoTicket->apellidos;
        $this->compania = $verTicket->companiaTicket->nombre;
        $this->titulo = $verTicket->ticket_titulo_registro;
        $this->descripcion = $verTicket->ticket_descripcion_registro;
        $this->estado = $verTicket->estadoTicket->nombre;

        $this->asignado = $verTicket->asignado;

        if ($this->asignado == true) {
            $this->prioridad = $verTicket->prioridadTicket->nombre;
            // $this->impacto = $verTicket->impactoTicket->nombre;
            $this->categoria = $verTicket->categoriaTicket->nombre;
            $this->clasificacion = $verTicket->clasificacionTicket->nombre;
            $this->tecnicoAsignado = $verTicket->tecnicoResponsable->nombres. ' '.$verTicket->tecnicoResponsable->apellidos;
        }

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

        $this->modal_ver = true;
    }

    public function detalleTicket($id)
    {
        $verTicket = Ticket::where('id', $id)->first();
        $dfh = Carbon::parse($verTicket->fecha_registro);
        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;
        $this->fecha_registro = $dfh->diffForHumans();
        // $this->fecha_registro = $dfh->isoFormat('LLLL');
        // $this->fecha_registro = date_format($dfh,"d/m/Y H:i:s");
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

    public function asignarTicket()
    {
        $this->validate();
        Ticket::where('id', $this->ticket_id)->update($this->modelData());
        Ticket::where('id', $this->ticket_id)->update($this->modelAsignado());
        $this->modal_asignar = false;
        $this->reset([
            'modal_asignar', 'prioridad','categoria', 'clasificacion', 'tecnicoAsignado'
        ]);
        $this->emit('alert', 'Asignación del Ticket realizado satisfactoriamente');
    }

    public function atenderTicket($id)
    {
        $verTicket = Ticket::where('id', $id)->first();
        $dfh = Carbon::parse($verTicket->fecha_registro);
        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;
        $this->fecha_registro = $dfh->diffForHumans();
        $this->compania = $verTicket->companiaTicket->nombre;
        $this->titulo = $verTicket->ticket_titulo_registro;
        $this->descripcion = $verTicket->ticket_descripcion_registro;
        $this->estado = $verTicket->estadoTicket->nombre;

        $this->asignado = $verTicket->asignado;

        if ($this->asignado == true) {
            $this->contacto = $verTicket->contactoTicket->nombres. ' '. $verTicket->contactoTicket->apellidos;
            $this->rolcontacto = $verTicket->contactoTicket->rol;
            $this->prioAtencion = $verTicket->prioridadTicket->nombre;
            // $this->impAtencion = $verTicket->impactoTicket->nombre;
            $this->categoriaAtencion = $verTicket->categoriaTicket->nombre;
            $this->clasificacionAtencion = $verTicket->clasificacionTicket->nombre;
            $this->tecnicoAsignado = $verTicket->tecnicoResponsable->nombres. ' '.$verTicket->tecnicoResponsable->apellidos;

        }

        switch ($verTicket->estado_id) {
            case (1):
                $this->color = 'orange';
                break;
            case (2):
                $this->color = 'yellow';
                break;
            case (3):
                $this->color = 'indigo';
                break;
            case (4):
                $this->color = 'green';
                break;
            case (5):
                $this->color = 'red';
                break;
            default:
                $this->color = 'grey';
        }

        switch ($verTicket->prioridad_id) {
            case (1):
                $this->colorPrioridad = 'red';
                break;
            case (2):
                $this->colorPrioridad = 'red';
                break;
            case (3):
                $this->colorPrioridad = 'yellow';
                break;
            case (4):
                $this->colorPrioridad = 'green';
                break;
            default:
                $this->colorPrioridad = 'grey';
        }

        switch ($verTicket->impacto_id) {
            case (1):
                $this->colorImpacto = 'red';
                break;
            case (2):
                $this->colorImpacto = 'yellow';
                break;
            case (3):
                $this->colorImpacto = 'green';
                break;
            default:
                $this->colorImpacto = 'grey';
        }

        $this->modal_atencion = true;
    }

    public function render()
    {
        $tickets = Ticket::latest()->paginate(10);
        return view('livewire.tickets.ticket-index',[
            'tickets' => $tickets
        ]);
    }
}
