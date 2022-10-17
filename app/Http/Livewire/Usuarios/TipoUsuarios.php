<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\TipoUsuario;
use Livewire\Component;
use Livewire\WithPagination;

class TipoUsuarios extends Component
{
    use WithPagination;

    public $title;
    public $modal = false;
    public $edit_modal = false;
    public $tipo;


    public function mount()
    {
        $this->title = "Tipo de Usuarios";
    }

    public function render()
    {
        $tipos = TipoUsuario::where('activo', 1)->paginate(10);
        return view('livewire.usuarios.tipo-usuarios', ['tipos' => $tipos]);
    }

    public function crear()
    {
        // $this->limpiarCampos();
        $this->abrirModal();
    }

    public function editar()
    {
        $this->edit_modal = true;
    }

    public function abrirModal() {
        $this->modal = true;
    }
    public function cerrarModal() {
        $this->modal = false;
    }
}
