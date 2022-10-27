<?php

namespace App\Http\Livewire\Entidad;

use App\Models\EntidadCargo;
use Livewire\Component;
use Livewire\WithPagination;

class EntidadCargoIndex extends Component
{
    use WithPagination;

    public $title;
    public $modal_edit = false;
    public $cargo, $nombre, $descripcion;

    protected $listeners = ['render'];

    protected $rules = [
        'cargo.nombre' => 'required|string|min:2',
        'cargo.descripcion' => 'required|string|min:2',
    ];

    public function mount()
    {
        $this->title = "Puestos";
    }

    public function render()
    {
        $cargos = EntidadCargo::where('activo', 1)->paginate(10);
        return view('livewire.entidad.entidad-cargo-index', ['cargos' => $cargos]);
    }

    public function editar(EntidadCargo $cargo)
    {
        $this->cargo = $cargo;
        $this->modal_edit = true;
    }

    public function actualizar()
    {
        $this->validate();
        $this->cargo->save();
        $this->modal_edit = false;
        // $this->emit('alert', 'Registro actualizado.');
    }

    public function saveDelete(EntidadCargo $cargo)
    {
        $cargo->activo = 0;
        $cargo->save();
        session()->flash('message', 'Registro eliminado correctamente');
    }
}
