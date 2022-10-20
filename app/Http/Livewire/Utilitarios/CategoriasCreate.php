<?php

namespace App\Http\Livewire\Utilitarios;

use App\Models\Categoria;
use Livewire\Component;

class CategoriasCreate extends Component
{
    public $open = false;
    public $nombre, $descripcion;

    protected $rules = [
        'nombre' => 'required|min:2',
        'descripcion' => 'required|min:2'
    ];

    public function save()
    {
        $this->validate();

        Categoria::create([
            'nombre' => ucfirst($this->nombre),
            'descripcion' => ucfirst($this->descripcion)
        ]);

        $this->reset([
            'open', 'nombre', 'descripcion'
        ]);
        $this->emitTo('utilitarios.categorias-index', 'render');
        $this->emit('alert', 'Registrado satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.utilitarios.categorias-create');
    }
}
