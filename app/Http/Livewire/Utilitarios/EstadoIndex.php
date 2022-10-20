<?php

namespace App\Http\Livewire\Utilitarios;

use App\Models\Estado;
use Livewire\Component;
use Livewire\WithPagination;

class EstadoIndex extends Component
{
    use WithPagination;

    public $title;
    public $modal_edit = false;
    public $estado, $nombre, $descripcion, $valor;

    protected $listeners = ['render'];

    protected $rules = [
        'estado.nombre' => 'required|string|min:2',
        'estado.descripcion' => 'required|string|min:2',
        'estado.valor' => 'required|string|min:1',
    ];

    public function mount()
    {
        $this->title = "Estados";
    }

    public function render()
    {
        $estados = Estado::where('activo', 1)->paginate(10);
        return view('livewire.utilitarios.estado-index', ['estados' => $estados]);
    }

    public function editar(Estado $estado)
    {
        $this->estado = $estado;
        $this->modal_edit = true;
    }

    public function actualizar()
    {
        $this->validate();
        $this->estado->save();
        $this->modal_edit = false;
        // $this->emit('alert', 'Registro actualizado.');
    }

    public function saveDelete(Estado $estado)
    {
        $estado->activo = 0;
        $estado->save();
        session()->flash('message', 'Registro eliminado correctamente');
    }
}
