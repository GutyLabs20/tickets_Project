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

    protected $rules = [
        'tipo.nombre' => 'required|string|min:2',
        'tipo.descripcion' => 'required|string|min:2',
        'tipo.slug' => 'string'
    ];

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

    public function editar(TipoUsuario $tipo)
    {
        $this->tipo = $tipo;
        $this->modal_edit = true;
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
