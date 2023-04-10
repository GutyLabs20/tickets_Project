<?php

namespace App\Http\Livewire\Utilitarios;

use App\Models\Clasificacion;
use Livewire\Component;
use Livewire\WithPagination;

class ClasificacionesIndex extends Component
{
    use WithPagination;

    public $title;
    public $modal_edit = false;
    public $clasificacion, $nombre, $descripcion;

    protected $listeners = ['render'];

    protected $rules = [
        'clasificacion.nombre' => 'required|string|min:2',
        'clasificacion.descripcion' => 'required|string|min:2',
    ];

    public function mount()
    {
        $this->title = "Clasificaciones";
    }

    public function render()
    {
        $clasificaciones = Clasificacion::paginate(10);
        return view('livewire.utilitarios.clasificaciones-index', ['clasificaciones' => $clasificaciones]);
    }

    public function editar(Clasificacion $clasificacion)
    {
        $this->clasificacion = $clasificacion;
        $this->modal_edit = true;
    }

    public function actualizar()
    {
        $this->validate();
        $this->clasificacion->save();
        $this->modal_edit = false;
        // $this->emit('alert', 'Registro actualizado.');
    }

    public function saveDelete(Clasificacion $clasificacion)
    {
        $clasificacion->activo = 0;
        $clasificacion->save();
        session()->flash('message', 'Registro eliminado correctamente');
    }
}
