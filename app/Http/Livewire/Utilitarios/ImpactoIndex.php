<?php

namespace App\Http\Livewire\Utilitarios;

use App\Models\Impacto;
use Livewire\Component;
use Livewire\WithPagination;

class ImpactoIndex extends Component
{
    use WithPagination;

    public $title;
    public $modal_edit = false;
    public $impacto, $nombre, $descripcion;

    protected $listeners = ['render'];

    protected $rules = [
        'impacto.nombre' => 'required|string|min:2',
        'impacto.descripcion' => 'required|string|min:2',
    ];

    public function mount()
    {
        $this->title = "Impactos";
    }

    public function render()
    {
        $impactos = Impacto::paginate(10);
        return view('livewire.utilitarios.impacto-index', ['impactos' => $impactos]);
    }

    public function editar(Impacto $impacto)
    {
        $this->impacto = $impacto;
        $this->modal_edit = true;
    }

    public function actualizar()
    {
        $this->validate();
        $this->impacto->save();
        $this->modal_edit = false;
        // $this->emit('alert', 'Registro actualizado.');
    }

    public function saveDelete(Impacto $impacto)
    {
        $impacto->activo = 0;
        $impacto->save();
        session()->flash('message', 'Registro eliminado correctamente');
    }
}
