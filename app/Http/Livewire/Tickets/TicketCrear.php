<?php

namespace App\Http\Livewire\Tickets;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TicketCrear extends Component
{
    public $open = false;
    public $ticket_titulo_registro, $ticket_descripcion_registro, $estado_id,
            $cliente_usuario_registro, $fecha_registro, $usuario_registro, $compania_id;
    public $cliente_colaboradores, $companias;

    protected $rules = [
        'ticket_titulo_registro' => 'required|min:2',
        'ticket_descripcion_registro' => 'required|min:2',
        'cliente_usuario_registro' => '',
        'compania_id' => '',
        'estado_id' => '',
    ];

    public function mount()
    {
        $this->companias = DB::table('entidad')
                ->select(DB::raw("CONCAT(nro_doc,'  🏭 ',nombre) AS compania"),'id')
                ->where('activo', 1)->get()->pluck('compania', 'id');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModal();
    }
    public function openModal()
    {
        $this->open = true;
    }
    public function closeModal()
    {
        $this->open = false;
        $this->resetCreateForm();
    }

    private function resetCreateForm(){
        $this->ticket_titulo_registro = '';
        $this->ticket_descripcion_registro = '';
    }

    public function save()
    {
        $this->validate();
        $fechaRegistro_ticket = Carbon::now();
        $fechaHoy = date($fechaRegistro_ticket);
        $user_id = auth()->user()->id;

        Ticket::create([
            'fecha_registro' => $fechaHoy,
            'usuario_registro' => $user_id,
            'cliente_usuario_registro' => $this->cliente_usuario_registro,
            'ticket_titulo_registro' => ucwords($this->ticket_titulo_registro),
            'ticket_descripcion_registro' => ucfirst($this->ticket_descripcion_registro),
            'compania_id' => $this->compania_id,
            'estado_id' => intval(1)
        ]);

        $data = DB::table('tickets')->select('id')->latest()->first();
        $number = strval($data->id);
        $length = 8;
        $dataTicket = 'TR'.substr(str_repeat(0, $length).$number, - $length);
        Ticket::where('id', $data->id)->update(['codigo_ticket' => $dataTicket]);

        $this->reset([
            'open', 'fecha_registro', 'usuario_registro', 'ticket_titulo_registro', 'ticket_descripcion_registro'
        ]);
        $this->emitTo('tickets.ticket-index', 'render');
        $this->emit('alert', 'Ticket registrado satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.tickets.ticket-crear');
    }
}
