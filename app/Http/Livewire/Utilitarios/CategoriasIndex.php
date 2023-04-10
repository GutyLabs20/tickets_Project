<?php

namespace App\Http\Livewire\Utilitarios;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriasIndex extends Component
{
    use WithPagination;

    public $title;
    public $modal_edit = false;
    public $modal_ver = false;
    public $categoria, $nombre, $descripcion;

    protected $listeners = ['render'];

    protected $rules = [
        'categoria.nombre' => 'required|string|min:2',
        'categoria.descripcion' => 'required|string|min:2',
    ];

    public function mount()
    {
        $this->title = "Categorías";
    }

    public function render()
    {
        $categorias = Categoria::paginate(10);
        return view('livewire.utilitarios.categorias-index', ['categorias' => $categorias]);
    }

    public function editar(Categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->modal_edit = true;
    }

    public function actualizar()
    {
        $this->validate();
        $this->categoria->save();
        $this->modal_edit = false;
        // $this->emit('alert', 'Registro actualizado.');
    }

    public function saveDelete(Categoria $categoria)
    {
        $categoria->activo = 0;
        $categoria->save();
        session()->flash('message', 'Registro eliminado correctamente');
    }
}
