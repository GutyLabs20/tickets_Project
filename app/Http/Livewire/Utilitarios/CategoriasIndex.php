<?php

namespace App\Http\Livewire\Utilitarios;

use Livewire\Component;
use Livewire\WithPagination;

class CategoriasIndex extends Component
{
    use WithPagination;

    public $title;
    public $modal_edit = false;
    public $tipo, $nombre, $descripcion;

    protected $listeners = ['render'];

    protected $rules = [
        'tipo.nombre' => 'required|string|min:2',
        'tipo.descripcion' => 'required|string|min:2',
        'tipo.slug' => 'string'
    ];

    public function mount()
    {
        $this->title = "Categorías";
    }

    public function render()
    {
        return view('livewire.utilitarios.categorias-index');
    }
}
