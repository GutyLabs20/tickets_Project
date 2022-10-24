<?php

namespace App\Http\Livewire\Entidad;

use App\Models\EntidadArea;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EntidadAreaCreate extends Component
{
    public $open = false;
    public $nombre, $descripcion, $entidad_id;

    protected $rules = [
        'nombre' => 'required|min:2',
        'descripcion' => 'required|min:2'
    ];

    // public function mount($id)
    // {
    //     $this->title = 'Areas';
    //     $this->entidad_id = $id;
    // }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModal();
    }
    public function openModal()
    {
        $this->open = true;
    }
    public function closeModal()
    {
        $this->open = false;
        $this->resetCreateForm();
    }
    private function resetCreateForm(){
        $this->nombre = '';
        $this->descripcion = '';
    }

    public function save()
    {
        $this->validate();

        EntidadArea::create([
            'nombre' => ucfirst($this->nombre),
            'descripcion' => ucfirst($this->descripcion),
            'entidad_id' => $this->entidad_id
        ]);

        $this->reset([
            'open', 'nombre', 'descripcion'
        ]);
        $this->emitTo('entidad.entidad-area-index', 'render');
        $this->emit('alert', 'Registrado satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.entidad.entidad-area-create');
    }
}
