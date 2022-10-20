<?php

namespace App\Http\Livewire\Utilitarios;

use App\Models\Estado;
use Livewire\Component;

class EstadoCreate extends Component
{
    public $open = false;
    public $nombre, $descripcion, $valor;

    protected $rules = [
        'nombre' => 'required|min:2',
        'descripcion' => 'required|min:2',
        'valor' => 'required|min:1'
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

        Estado::create([
            'nombre' => ucfirst($this->nombre),
            'descripcion' => ucfirst($this->descripcion),
            'valor' => $this->valor
        ]);

        $this->reset([
            'open', 'nombre', 'descripcion', 'valor'
        ]);
        $this->emitTo('utilitarios.estado-index', 'render');
        $this->emit('alert', 'Registrado satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.utilitarios.estado-create');
    }
}
