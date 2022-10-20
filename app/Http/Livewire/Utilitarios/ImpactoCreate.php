<?php

namespace App\Http\Livewire\Utilitarios;

use App\Models\Impacto;
use Livewire\Component;

class ImpactoCreate extends Component
{
    public $open = false;
    public $nombre, $descripcion;

    protected $rules = [
        'nombre' => 'required|min:2',
        'descripcion' => 'required|min:2'
    ];

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

        Impacto::create([
            'nombre' => ucfirst($this->nombre),
            'descripcion' => ucfirst($this->descripcion)
        ]);

        $this->reset([
            'open', 'nombre', 'descripcion'
        ]);
        $this->emitTo('utilitarios.impacto-index', 'render');
        $this->emit('alert', 'Registrado satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.utilitarios.impacto-create');
    }
}
