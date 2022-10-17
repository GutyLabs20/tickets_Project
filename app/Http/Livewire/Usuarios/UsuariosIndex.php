<?php

namespace App\Http\Livewire\Usuarios;

use Livewire\Component;

class UsuariosIndex extends Component
{
    public $title;

    public function mount()
    {
        $this->title = "Usuarios";
    }

    public function render()
    {
        return view('livewire.usuarios.usuarios-index');
    }
}
