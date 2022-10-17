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
    public $modal_edit = false;
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
        $this->reset(['tipo']);
        $this->abrirModal();
    }

    public function editar(TipoUsuario $tipo)
    {
        // $this->modal_edit = true;
        $this->tipo = $tipo;
        $this->abrirModal();
    }

    public function abrirModal() {
        $this->modal = true;
    }
    public function cerrarModal() {
        $this->modal = false;
    }

    public function updatingActive()
    {
        $this->resetPage();
    }

    public function updatingQ()
    {
        $this->resetPage();
    }
}
