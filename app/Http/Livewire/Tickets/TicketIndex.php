<?php

namespace App\Http\Livewire\Tickets;

use App\Models\Ticket;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

use function PHPUnit\Framework\isNull;

class TicketIndex extends Component
{
    use WithPagination;

    public $categorizaciones;

    public $title;
    public $color, $colorCol, $colorPrioridad, $colorImpacto;
    public $modal_delete = false;
    public $modal_enable = false;

    public $ticket_id, $codigo_ticket, $fecha_registro, $pn, $prioAtencion, $impAtencion, $categoriaAtencion, $clasificacionAtencion;
    public $usuario_registro, $contacto, $compania, $rolcontacto;
    public $titulo, $descripcion, $estado, $asignado;
    public $ticket, $prioridad, $impacto, $categoria, $clasificacion, $tecnicoAsignado;
    public $fechaInicioTicket, $diagnosticoTicket, $diaspasadosDFH, $diaspasadosDFI, $diaspasadosDFF;
    public $fechaFinTicket, $solucionTicket;
    public $fechaCancelado_ticket, $comentarioCancelado_ticket;
    public $tl_fechainicio, $tl_diagnostico, $tl_clasificado, $tl_descripcion, $tl_fechafin, $tl_solucion, $tl_terminado, $tl_fechacancelado, $tl_ticketcancelado;
    public $sl_fechainicio, $sl_diagnostico, $sl_clasificado, $sl_descripcion, $sl_fechafin, $sl_solucion, $sl_terminado;

    public $listaTecnicos = [], $listaPrioridades = [], $listaImpactos = [], $listaClasificaciones = [], $listeaCategorias = [];

    public $modal_ver = false, $modal_asignar = false, $modal_atencion = false;
    public $modal_lineatiempo = false, $modal_solucion = false, $modal_finalizar = false, $modal_cancelar = false;

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

    public function modelAsignado() { return [ 'asignado' => true, ]; }

    public function modelDiagnostico() {
        $fecha_inicio_ticket = Carbon::now();
        $fechaInicio = date($fecha_inicio_ticket);
        $this->fechaInicioTicket = $fechaInicio;
        return [
            'fecha_inicio_ticket' => $this->fechaInicioTicket,
            'diagnostico_ticket' => $this->diagnosticoTicket,
            'estado_id' => 3
        ];
    }

    public function modelSolucion() {
        $fechaticket_fin = Carbon::now();
        $fecha_fin_ticket = date($fechaticket_fin);
        $this->fechaFinTicket = $fecha_fin_ticket;
        return [
            'fecha_fin_ticket' => $this->fechaFinTicket,
            'respuesta_ticket' => $this->solucionTicket,
            'estado_id' => 3
        ];
    }

    public function modelCancelado() {
        $fecha_fin_ticket = Carbon::now();
        $fechaFin = date($fecha_fin_ticket);
        $this->fechaCancelado_ticket = $fechaFin;
        return [
            'fecha_ticket_cancelado' => $this->fechaCancelado_ticket,
            'comentario_ticket_cancelado' => $this->comentarioCancelado_ticket,
            'estado_id' => 5
        ];
    }

    public function modelFinalizar() { return [ 'estado_id' => 4, ]; }

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
        $verTicket = Ticket::where('id', $id)->first();
        $dfh = Carbon::parse($verTicket->fecha_registro);
        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;
        $this->fecha_registro = $dfh->diffForHumans();
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
            case (6):
                $this->color = 'teal';
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
        $this->resetValidation();
        $this->reset();
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

        $this->modal_atencion = true;
    }

    public function diagnosticoTicket()
    {
        Ticket::where('id', $this->ticket_id)->update($this->modelDiagnostico());
        $this->modal_atencion = false;
        $this->reset([
            'modal_asignar', 'fechaInicioTicket', 'diagnosticoTicket'
        ]);
        $this->emit('alert', 'Diagnostico del ticket fue ingresado satisfactoriamente');
    }

    public function lineatiempoTicket($id)
    {
        $verTicket = Ticket::where('id', $id)->first();
        $dfa = Carbon::now();
        $dfh = Carbon::parse($verTicket->fecha_registro);
        $dfI = Carbon::parse($verTicket->fecha_inicio_ticket);
        $dfF = Carbon::parse($verTicket->fecha_fin_ticket);

        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;

        $this->fecha_registro = $this->dias_pasados($dfh, $dfa);
        $this->compania = $verTicket->companiaTicket->nombre;
        $this->titulo = $verTicket->ticket_titulo_registro;
        $this->descripcion = $verTicket->ticket_descripcion_registro;
        $this->estado = $verTicket->estadoTicket->nombre;

        $this->tl_descripcion = $verTicket->ticket_descripcion_registro;
        $this->tl_fechainicio = $this->dias_pasados($dfI, $dfa);
        $this->tl_diagnostico = $verTicket->diagnostico_ticket;
        $this->tl_clasificado = $verTicket->clasificacionTicket->nombre ? $verTicket->clasificacionTicket->nombre : 'Ticket';

        $this->tl_fechafin = $this->dias_pasados($dfF, $dfa);
        $this->tl_solucion = $verTicket->respuesta_ticket;
        $this->tl_terminado = $verTicket->ticket_terminado;

        $this->tl_fechacancelado = $verTicket->fecha_ticket_cancelado;
        $this->tl_ticketcancelado = $verTicket->comentario_ticket_cancelado;

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
            case (6):
                $this->color = 'teal';
                break;
            default:
                $this->color = 'grey';
        }

        $this->modal_lineatiempo = true;
    }

    public function solucionTicket($id)
    {
        $verTicket = Ticket::where('id', $id)->first();
        $dfa = Carbon::now();
        $dfh = Carbon::parse($verTicket->fecha_registro);
        $dfI = Carbon::parse($verTicket->fecha_inicio_ticket);

        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;

        $this->fecha_registro = $this->dias_pasados($dfh, $dfa);
        $this->compania = $verTicket->companiaTicket->nombre;
        $this->titulo = $verTicket->ticket_titulo_registro;
        $this->descripcion = $verTicket->ticket_descripcion_registro;
        $this->estado = $verTicket->estadoTicket->nombre;

        $this->sl_descripcion = $verTicket->ticket_descripcion_registro;
        $this->sl_fechainicio = $this->dias_pasados($dfI, $dfa);
        $this->sl_diagnostico = $verTicket->diagnostico_ticket;
        $this->sl_clasificado = $verTicket->clasificacionTicket->nombre;

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

        $this->modal_solucion = true;
    }

    public function solucionarTicket()
    {
        Ticket::where('id', $this->ticket_id)->update($this->modelSolucion());
        $this->modal_solucion = false;
        $this->reset([
            'modal_solucion', 'fechaFinTicket', 'solucionTicket'
        ]);
        $this->emit('alert', 'El ticket fue solucionado satisfactoriamente');
    }


    public function finalizarTicket($id)
    {
        $verTicket = Ticket::where('id', $id)->first();
        $dfa = Carbon::now();
        $dfh = Carbon::parse($verTicket->fecha_registro);
        $dfI = Carbon::parse($verTicket->fecha_inicio_ticket);
        $dfF = Carbon::parse($verTicket->fecha_fin_ticket);

        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;

        $this->fecha_registro = $this->dias_pasados($dfh, $dfa);
        $this->compania = $verTicket->companiaTicket->nombre;
        $this->titulo = $verTicket->ticket_titulo_registro;
        $this->descripcion = $verTicket->ticket_descripcion_registro;
        $this->estado = $verTicket->estadoTicket->nombre;

        $this->tl_descripcion = $verTicket->ticket_descripcion_registro;
        $this->tl_fechainicio = $this->dias_pasados($dfI, $dfa);
        $this->tl_diagnostico = $verTicket->diagnostico_ticket;
        $this->tl_clasificado = $verTicket->clasificacionTicket->nombre;

        $this->tl_fechafin = $this->dias_pasados($dfF, $dfa);
        $this->tl_solucion = $verTicket->respuesta_ticket;
        $this->tl_terminado = $verTicket->ticket_terminado;

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
            case (6):
                $this->color = 'teal';
                break;
            default:
                $this->color = 'grey';
        }

        $this->modal_finalizar = true;
    }


    public function cerrarTicket()
    {
        Ticket::where('id', $this->ticket_id)->update($this->modelFinalizar());
        $this->modal_finalizar = false;
        $this->reset([
            'modal_finalizar'
        ]);
        $this->emit('alert', 'El ticket fue finalizado satisfactoriamente');
    }

    public function cancelandoTicket($id)
    {
        $verTicket = Ticket::where('id', $id)->first();
        $dfa = Carbon::now();
        $dfh = Carbon::parse($verTicket->fecha_registro);
        $dfI = Carbon::parse($verTicket->fecha_inicio_ticket);
        $this->comentarioCancelado_ticket = '';
        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;

        $this->fecha_registro = $this->dias_pasados($dfh, $dfa);
        $this->compania = $verTicket->companiaTicket->nombre;
        $this->titulo = $verTicket->ticket_titulo_registro;
        $this->descripcion = $verTicket->ticket_descripcion_registro;
        $this->estado = $verTicket->estadoTicket->nombre;

        $this->sl_descripcion = $verTicket->ticket_descripcion_registro;
        $this->sl_fechainicio = $this->dias_pasados($dfI, $dfa);
        $this->sl_diagnostico = $verTicket->diagnostico_ticket;
        // $this->sl_clasificado = is_null($verTicket->clasificacionTicket->nombre) ? '' : $verTicket->clasificacionTicket->nombre;

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

        $this->modal_cancelar = true;
    }

    public function cancelarTicket()
    {
        Ticket::where('id', $this->ticket_id)->update($this->modelCancelado());
        $this->modal_cancelar = false;
        $this->reset([
            'modal_cancelar', 'fechaCancelado_ticket','comentarioCancelado_ticket'
        ]);
        $this->emit('alert', 'El ticket fue cancelado satisfactoriamente');
    }

    public function render()
    {
        $tickets = Ticket::latest()->paginate(10);
        return view('livewire.tickets.ticket-index',[
            'tickets' => $tickets
        ]);
    }

    function dias_pasados($fecha_inicial,$fecha_actual)
    {
        $dias = (strtotime($fecha_inicial)-strtotime($fecha_actual))/86400;
        $dias = abs($dias);
        $dias = floor($dias);

        $ffDI = Carbon::parse($fecha_inicial);

        if ($dias > 7) {
            $dias = $ffDI->isoFormat('LLLL');
        } else {
            $dias = $ffDI->diffForHumans();
        }

        return $dias;
    }
}
