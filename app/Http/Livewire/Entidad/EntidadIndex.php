<?php

namespace App\Http\Livewire\Entidad;

use App\Models\Entidad;
use Livewire\Component;
use Livewire\WithPagination;

class EntidadIndex extends Component
{
    use WithPagination;

    public $title;
    public $modal_edit = false;
    public $entidad, $nombre, $descripcion;

    protected $listeners = ['render'];

    protected $rules = [
        'entidad.nombre' => 'required|string|min:2',
        'entidad.descripcion' => 'required|string|min:2',
    ];

    public function mount()
    {
        $this->title = "Empresas";
    }

    public function render()
    {
        $entidades = Entidad::where('activo', 1)->paginate(20);
        return view('livewire.entidad.entidad-index', ['entidades' => $entidades]);
    }

    public function editar(Entidad $entidad)
    {
        $this->entidad = $entidad;
        $this->modal_edit = true;
    }

    public function actualizar()
    {
        $this->validate();
        $this->entidad->save();
        $this->modal_edit = false;
        // $this->emit('alert', 'Registro actualizado.');
    }

    public function saveDelete(Entidad $entidad)
    {
        $entidad->activo = 0;
        $entidad->save();
        session()->flash('message', 'Registro eliminado correctamente');
    }
}
