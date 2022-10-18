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
    public $tipo, $nombre, $descripcion;

    protected $listeners = ['render'];

    protected $rules = [
        'tipo.nombre' => 'required|string|min:2',
        'tipo.descripcion' => 'required|string|min:2',
        'tipo.slug' => 'string'
    ];

    public function mount()
    {
        $this->title = "Tipo de Usuarios";
        // // $this->tipo = new TipoUsuario();
    }

    public function render()
    {
        $tipos = TipoUsuario::where('activo', 1)->paginate(10);
        return view('livewire.usuarios.tipo-usuarios', ['tipos' => $tipos]);
    }

    public function crear()
    {
        // $this->reset(['tipo']);
        $this->resetCreateForm();
        $this->modal = true;
    }

    public function editar(TipoUsuario $tipo)
    {
        $this->tipo = $tipo;
        $this->modal_edit = true;
    }

    public function actualizar()
    {
        $this->validate();
        $this->tipo->save();
        $this->modal_edit = false;
        // $this->emit('alert', 'Registro actualizado.');
    }

    public function saveDelete(TipoUsuario $tipo)
    {
        $tipo->activo = 0;
        $tipo->save();
        session()->flash('message', 'Registro eliminado correctamente');
    }

    private function resetCreateForm(){
        $this->nombre = '';
        $this->descripcion = '';
    }
}
