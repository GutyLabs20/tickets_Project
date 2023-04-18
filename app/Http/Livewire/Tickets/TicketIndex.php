<?php

namespace App\Http\Livewire\Tickets;

use App\Models\Ticket;
use App\Traits\ProcesosTicket;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class TicketIndex extends Component
{
    use WithPagination, ProcesosTicket;

    public  $title;
    public  $colorEstado, $colorPrioridad, $colorImpacto;

    public  $ticket_id, $codigo_ticket, $fecha_registro, $compania, $titulo, $descripcion, $estado,
            $usuario_registro, $contacto, $rolcontacto, $asignado;
    public  $prioridad, $impacto, $categoria, $clasificacion, $tecnicoAsignado;
    public  $fechaInicioTicket, $diagnosticoTicket, $clasificado,
            $fechaFinTicket, $solucionTicket, $ticketTerminado, $fechaticketCancelado, $comentarioCanceladoticket;

    public  $prioridadAtencion, $categoriaAtencion, $clasificacionAtencion;

    public  $listaTecnicos = [], $listaPrioridades = [], $listaImpactos = [], $listaClasificaciones = [], $listaCategorias = [];

    public  $modal_asignar = false, $modal_atencion = false, $modal_solucion = false, $modal_finalizar = false;
    public  $modal_ver = false, $modal_lineatiempo = false, $modal_cancelar = false, $modal_cancelado = false;

    public $q, $activo;

    protected $listeners = [
        'render',
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

    public function modelDataAsignado()
    {
        // 'impacto_id' => $this->impacto,
        return [
            'prioridad_id' => $this->prioridad,
            'categoria_id' => $this->categoria,
            'clasificacion_id' => $this->clasificacion,
            'tecnico_responsable' => $this->tecnicoAsignado,
            'asignado' => true,
        ];
    }

    public function modelDataDiagnostico() {
        $fecha_inicio_ticket = Carbon::now();
        $fechaInicio = date($fecha_inicio_ticket);
        $this->fechaInicioTicket = $fechaInicio;
        return [
            'fecha_inicio_ticket' => $this->fechaInicioTicket,
            'diagnostico_ticket' => $this->diagnosticoTicket,
            'estado_id' => 3
        ];
    }

    public function modelDataSolucion() {
        $fechaticket_fin = Carbon::now();
        $fecha_fin_ticket = date($fechaticket_fin);
        $this->fechaFinTicket = $fecha_fin_ticket;
        return [
            'fecha_fin_ticket' => $this->fechaFinTicket,
            'respuesta_ticket' => $this->solucionTicket,
            'estado_id' => 6
        ];
    }

    public function modelDataCancelado() {
        $fecha_fin_ticket = Carbon::now();
        $fechaFin = date($fecha_fin_ticket);
        $this->fechaticketCancelado = $fechaFin;
        return [
            'fecha_ticket_cancelado' => $this->fechaticketCancelado,
            'comentario_ticket_cancelado' => $this->comentarioCanceladoticket,
            'estado_id' => 5
        ];
    }

    public function modelDataFinalizar() { return [ 'estado_id' => 4, ]; }

    public function updatingQ() { $this->resetPage(); }

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
        $this->listaCategorias = DB::table('categorias')->where('activo', 1)->pluck('nombre', 'id');
    }

    public function mostrarTicket($id)
    {
        // $verTicket = Ticket::where('id', $id)->first();
        $verTicket = $this->ticketID($id);
        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;
        $this->fecha_registro = $this->dias_pasados($verTicket->fecha_registro);
        $this->usuario_registro = $verTicket->usuarioRegistro->usuario;
        $this->contacto = $verTicket->contactoTicket->nombres. ' '. $verTicket->contactoTicket->apellidos;
        $this->rolcontacto = $verTicket->contactoTicket->rol;
        $this->compania = $verTicket->companiaTicket->nombre;
        $this->titulo = $verTicket->ticket_titulo_registro;
        $this->descripcion = $verTicket->ticket_descripcion_registro;
        $this->estado = $verTicket->estadoTicket->nombre;

        $this->asignado = $verTicket->asignado;

        if ($this->asignado == true) {
            $this->prioridad = $verTicket->prioridadTicket->nombre;
            $this->categoria = $verTicket->categoriaTicket->nombre;
            $this->clasificacion = $verTicket->clasificacionTicket->nombre;
            $this->tecnicoAsignado = $verTicket->tecnicoResponsable->nombres. ' '.$verTicket->tecnicoResponsable->apellidos;
        }

        $this->colorEstado = $this->seleccionColorEstadoModal($verTicket->estado_id);

        $this->modal_ver = true;
    }

    public function detalleTicket($id)
    {
        $verTicket = $this->ticketID($id);
        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;
        $this->fecha_registro = $this->dias_pasados($verTicket->fecha_registro);
        $this->compania = $verTicket->companiaTicket->nombre;
        $this->titulo = $verTicket->ticket_titulo_registro;
        $this->descripcion = $verTicket->ticket_descripcion_registro;
        $this->estado = $verTicket->estadoTicket->nombre;
        $this->colorEstado = $this->seleccionColorEstadoModal($verTicket->estado_id);
        $this->contacto = $verTicket->contactoTicket->nombres. ' '. $verTicket->contactoTicket->apellidos;
        $this->rolcontacto = $verTicket->contactoTicket->rol;
        $this->modal_asignar = true;
    }

    public function asignarTicket()
    {
        $this->validate();
        Ticket::where('id', $this->ticket_id)->update($this->modelDataAsignado());
        $this->modal_asignar = false;
        $this->reset([
            'modal_asignar', 'prioridad','categoria', 'clasificacion', 'tecnicoAsignado'
        ]);
        $this->emit('alert', 'Asignación del Ticket realizado satisfactoriamente');
    }

    public function atenderTicket($id)
    {
        $verTicket = $this->ticketID($id);
        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;
        $this->fecha_registro = $this->dias_pasados($verTicket->fecha_registro);
        $this->compania = $verTicket->companiaTicket->nombre;
        $this->titulo = $verTicket->ticket_titulo_registro;
        $this->descripcion = $verTicket->ticket_descripcion_registro;
        $this->estado = $verTicket->estadoTicket->nombre;

        $this->asignado = $verTicket->asignado;

        $this->contacto = $verTicket->contactoTicket->nombres. ' '. $verTicket->contactoTicket->apellidos;
        $this->rolcontacto = $verTicket->contactoTicket->rol;
        $this->prioridadAtencion = $verTicket->prioridadTicket->nombre;
        $this->categoriaAtencion = $verTicket->categoriaTicket->nombre;
        $this->clasificacionAtencion = $verTicket->clasificacionTicket->nombre;
        $this->tecnicoAsignado = $verTicket->tecnicoResponsable->nombres. ' '.$verTicket->tecnicoResponsable->apellidos;

        $this->colorEstado = $this->seleccionColorEstadoModal($verTicket->estado_id);
        $this->colorPrioridad = $this->seleccionColorPrioridadModal($verTicket->prioridad_id);

        $this->modal_atencion = true;
    }

    public function diagnosticoTicket()
    {
        Ticket::where('id', $this->ticket_id)->update($this->modelDataDiagnostico());
        $this->modal_atencion = false;
        $this->reset([
            'modal_asignar', 'fechaInicioTicket', 'diagnosticoTicket'
        ]);
        $this->emit('alert', 'Diagnostico del ticket fue ingresado satisfactoriamente');
    }

    public function lineatiempoTicket($id)
    {
        $verTicket = $this->ticketID($id);

        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;
        $this->fecha_registro = $this->dias_pasados($verTicket->fecha_registro);
        $this->compania = $verTicket->companiaTicket->nombre;
        $this->titulo = $verTicket->ticket_titulo_registro;
        $this->descripcion = $verTicket->ticket_descripcion_registro;
        $this->estado = $verTicket->estadoTicket->nombre;
        $this->fechaInicioTicket = $this->dias_pasados($verTicket->fecha_inicio_ticket);
        $this->diagnosticoTicket = $verTicket->diagnostico_ticket;
        $this->clasificacionAtencion = $verTicket->clasificacionTicket->nombre;
        $this->fechaFinTicket = $this->dias_pasados($verTicket->fecha_fin_ticket);
        $this->solucionTicket = $verTicket->respuesta_ticket;
        $this->ticketTerminado = $verTicket->ticket_terminado;
        $this->fechaticketCancelado = $verTicket->fecha_ticket_cancelado;
        $this->comentarioCanceladoticket = $verTicket->comentario_ticket_cancelado;

        $this->colorEstado = $this->seleccionColorEstadoModal($verTicket->estado_id);

        $this->modal_lineatiempo = true;
    }

    public function solucionTicket($id)
    {
        $verTicket = $this->ticketID($id);

        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;
        $this->fecha_registro = $this->dias_pasados($verTicket->fecha_registro);
        $this->compania = $verTicket->companiaTicket->nombre;
        $this->titulo = $verTicket->ticket_titulo_registro;
        $this->descripcion = $verTicket->ticket_descripcion_registro;
        $this->estado = $verTicket->estadoTicket->nombre;
        $this->fechaInicioTicket = $this->dias_pasados($verTicket->fecha_inicio_ticket);
        $this->diagnosticoTicket = $verTicket->diagnostico_ticket;
        $this->clasificacionAtencion = $verTicket->clasificacionTicket->nombre;

        $this->colorEstado = $this->seleccionColorEstadoModal($verTicket->estado_id);

        $this->modal_solucion = true;
    }

    public function solucionarTicket()
    {
        Ticket::where('id', $this->ticket_id)->update($this->modelDataSolucion());
        $this->modal_solucion = false;
        $this->reset([
            'modal_solucion', 'fechaFinTicket', 'solucionTicket'
        ]);
        $this->emit('alert', 'El ticket fue solucionado satisfactoriamente');
    }


    public function finalizarTicket($id)
    {
        $verTicket = $this->ticketID($id);

        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;
        $this->fecha_registro = $this->dias_pasados($verTicket->fecha_registro);
        $this->compania = $verTicket->companiaTicket->nombre;
        $this->titulo = $verTicket->ticket_titulo_registro;
        $this->descripcion = $verTicket->ticket_descripcion_registro;
        $this->estado = $verTicket->estadoTicket->nombre;
        $this->fechaInicioTicket = $this->dias_pasados($verTicket->fecha_inicio_ticket);
        $this->diagnosticoTicket = $verTicket->diagnostico_ticket;
        $this->clasificacionAtencion = $verTicket->clasificacionTicket->nombre;
        $this->fechaFinTicket = $this->dias_pasados($verTicket->fecha_fin_ticket);
        $this->solucionTicket = $verTicket->respuesta_ticket;
        $this->ticketTerminado = $verTicket->ticket_terminado;

        $this->colorEstado = $this->seleccionColorEstadoModal($verTicket->estado_id);

        $this->modal_finalizar = true;
    }


    public function cerrarTicket()
    {
        Ticket::where('id', $this->ticket_id)->update($this->modelDataFinalizar());
        $this->modal_finalizar = false;
        $this->reset([
            'modal_finalizar'
        ]);
        $this->emit('alert', 'El ticket fue finalizado satisfactoriamente');
    }

    public function cancelandoTicket($id)
    {
        $verTicket = $this->ticketID($id);

        $this->comentarioCanceladoticket = '';
        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;
        $this->fecha_registro = $this->dias_pasados($verTicket->fecha_registro);
        $this->compania = $verTicket->companiaTicket->nombre;
        $this->titulo = $verTicket->ticket_titulo_registro;
        $this->descripcion = $verTicket->ticket_descripcion_registro;
        $this->estado = $verTicket->estadoTicket->nombre;

        $this->colorEstado = $this->seleccionColorEstadoModal($verTicket->estado_id);

        $this->modal_cancelar = true;
    }

    public function cancelarTicket()
    {
        Ticket::where('id', $this->ticket_id)->update($this->modelDataCancelado());
        $this->modal_cancelar = false;
        $this->reset([
            'modal_cancelar', 'fechaticketCancelado','comentarioCanceladoticket'
        ]);
        $this->emit('alert', 'El ticket fue cancelado satisfactoriamente');
    }

    public function ticketCancelado($id)
    {
        $verTicket = $this->ticketID($id);

        $this->ticket_id = $verTicket->id;
        $this->codigo_ticket = $verTicket->codigo_ticket;
        $this->fecha_registro = $this->dias_pasados($verTicket->fecha_registro);
        $this->compania = $verTicket->companiaTicket->nombre;
        $this->titulo = $verTicket->ticket_titulo_registro;
        $this->descripcion = $verTicket->ticket_descripcion_registro;
        $this->estado = $verTicket->estadoTicket->nombre;
        $this->fechaInicioTicket = $this->dias_pasados($verTicket->fecha_inicio_ticket);
        $this->diagnosticoTicket = $verTicket->diagnostico_ticket;
        $this->clasificacionAtencion = 'ticket';
        $this->fechaFinTicket = $this->dias_pasados($verTicket->fecha_fin_ticket);
        $this->solucionTicket = $verTicket->respuesta_ticket;
        $this->ticketTerminado = $verTicket->ticket_terminado;
        $this->fechaticketCancelado = $this->dias_pasados($verTicket->fecha_ticket_cancelado);
        $this->comentarioCanceladoticket = $verTicket->comentario_ticket_cancelado;

        $this->colorEstado = $this->seleccionColorEstadoModal($verTicket->estado_id);

        $this->modal_cancelado = true;
    }

    public function render()
    {
        $tickets = Ticket::latest()->paginate(10);
        return view('livewire.tickets.ticket-index',[
            'tickets' => $tickets
        ]);
    }

}
