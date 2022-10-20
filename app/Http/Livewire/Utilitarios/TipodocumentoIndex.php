<?php

namespace App\Http\Livewire\Utilitarios;

use App\Models\Tipodocumento;
use Livewire\Component;
use Livewire\WithPagination;

class TipodocumentoIndex extends Component
{
    use WithPagination;

    public $title;
    public $modal_edit = false;
    public $documento, $nombre, $descripcion;

    protected $listeners = ['render'];

    protected $rules = [
        'documento.nombre' => 'required|string|min:2',
        'documento.descripcion' => 'required|string|min:2',
    ];

    public function mount()
    {
        $this->title = "Tipo de Documentos";
    }

    public function render()
    {
        $documentos = Tipodocumento::where('activo', 1)->paginate(10);
        return view('livewire.utilitarios.tipodocumento-index', ['documentos' => $documentos]);
    }

    public function editar(Tipodocumento $documento)
    {
        $this->documento = $documento;
        $this->modal_edit = true;
    }

    public function actualizar()
    {
        $this->validate();
        $this->documento->save();
        $this->modal_edit = false;
        // $this->emit('alert', 'Registro actualizado.');
    }

    public function saveDelete(Tipodocumento $documento)
    {
        $documento->activo = 0;
        $documento->save();
        session()->flash('message', 'Registro eliminado correctamente');
    }
}
