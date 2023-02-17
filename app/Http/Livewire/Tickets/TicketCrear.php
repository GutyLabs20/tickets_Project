<?php

namespace App\Http\Livewire\Tickets;

use Livewire\Component;

class TicketCrear extends Component
{
    public $open = false;
    public $nombres, $apellidos, $usuario, $email, $tipousuario_id, $password;
    public $tipousuarios;

    public function create()
    {
        // $this->resetCreateForm();
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

    public function render()
    {
        return view('livewire.tickets.ticket-crear');
    }
}
