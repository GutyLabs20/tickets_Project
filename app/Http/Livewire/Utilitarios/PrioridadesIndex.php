<?php

namespace App\Http\Livewire\Utilitarios;

use App\Models\Prioridad;
use Livewire\Component;
use Livewire\WithPagination;

class PrioridadesIndex extends Component
{
    use WithPagination;

    public $title;
    public $modal_edit = false;
    public $prioridad, $nombre, $descripcion;

    protected $listeners = ['render'];

    protected $rules = [
        'prioridad.nombre' => 'required|string|min:2',
        'prioridad.descripcion' => 'required|string|min:2',
    ];

    public function mount()
    {
        $this->title = "Prioridades";
    }

    public function render()
    {
        $prioridades = Prioridad::where('activo', 1)->paginate(10);
        return view('livewire.utilitarios.prioridades-index', ['prioridades' => $prioridades]);
    }

    public function editar(Prioridad $prioridad)
    {
        $this->prioridad = $prioridad;
        $this->modal_edit = true;
    }

    public function actualizar()
    {
        $this->validate();
        $this->prioridad->save();
        $this->modal_edit = false;
        // $this->emit('alert', 'Registro actualizado.');
    }

    public function saveDelete(Prioridad $prioridad)
    {
        $prioridad->activo = 0;
        $prioridad->save();
        session()->flash('message', 'Registro eliminado correctamente');
    }
}
