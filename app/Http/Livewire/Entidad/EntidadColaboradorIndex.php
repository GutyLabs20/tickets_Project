<?php

namespace App\Http\Livewire\Entidad;

use Livewire\Component;

class EntidadColaboradorIndex extends Component
{
    public $entidad_id;

    public function mount($id)
    {
        $this->entidad_id = $id;
    }

    public function render()
    {
        return view('livewire.entidad.entidad-colaborador-index');
    }
}
