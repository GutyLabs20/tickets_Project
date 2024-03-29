<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\TipoUsuario;
use Livewire\Component;
use Illuminate\Support\Str;

class TipoCrear extends Component
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

        TipoUsuario::create([
            'nombre' => ucfirst($this->nombre),
            'descripcion' => ucfirst($this->descripcion),
            'slug' => Str::slug($this->nombre)
        ]);

        $this->reset([
            'open', 'nombre', 'descripcion'
        ]);
        $this->emitTo('usuarios.tipo-usuarios', 'render');
        $this->emit('alert', 'Registrado satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.usuarios.tipo-crear');
    }
}
