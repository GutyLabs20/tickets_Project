<?php

namespace App\Http\Livewire\Tickets;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class TicketIndex extends Component
{
    use WithPagination;

    public $categorizaciones;

    public $title;
    public $modal_edit = false;
    public $modal_delete = false;
    public $modal_enable = false;

    public $q, $activo;

    protected $listeners = [
        'render',
        'delete',
        'enable'
    ];

    public function updatingQ()
    {
        $this->resetPage();
    }
    public function updatingModalDelete()
    {
        $this->resetPage();
    }
    public function updatingModalEnable()
    {
        $this->resetPage();
    }

    public function mount()
    {
        // $this->activo = $entidad->activo;
        $this->title = "Tickets";
        // $this->tipodocumento = DB::table('tipodocumento')->where('activo', 1)->pluck('nombre', 'id');
        // $this->categorizaciones = DB::table('tipo_atencion')->where('activo', 1)->pluck('id', 'nombre');
    }

    public function render()
    {
        $tickets = Ticket::paginate(10);
        return view('livewire.tickets.ticket-index',[
            'tickets' => $tickets
        ]);
    }
}
