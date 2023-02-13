<?php

namespace App\Http\Livewire\Utilitarios\Atencion;

use App\Models\TipoAtencion;
use Livewire\Component;
use Livewire\WithPagination;

class TipoatencionIndex extends Component
{
    use WithPagination;

    public $title;
    public $modal_edit = false;
    public $atencion, $nombre, $descripcion;

    protected $listeners = ['render'];

    protected $rules = [
        'atencion.nombre' => 'required|string|min:2',
        'atencion.descripcion' => 'required|string|min:2',
    ];

    public function mount()
    {
        $this->title = "Tipo de Atención";
    }

    public function render()
    {
        $atenciones = TipoAtencion::where('activo', 1)->paginate(10);
        return view('livewire.utilitarios.atencion.tipoatencion-index', ['atenciones' => $atenciones]);
    }

    public function editar(TipoAtencion $atencion)
    {
        $this->atencion = $atencion;
        $this->modal_edit = true;
    }

    public function actualizar()
    {
        $this->validate();
        $this->atencion->save();
        $this->modal_edit = false;
        // $this->emit('alert', 'Registro actualizado.');
    }

    public function saveDelete(TipoAtencion $atencion)
    {
        $atencion->activo = 0;
        $atencion->save();
        session()->flash('message', 'Registro eliminado correctamente');
    }
}
