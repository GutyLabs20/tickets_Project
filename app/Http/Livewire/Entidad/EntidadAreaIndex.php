<?php

namespace App\Http\Livewire\Entidad;

use App\Models\Entidad;
use App\Models\EntidadArea;
use Livewire\Component;
use Livewire\WithPagination;

class EntidadAreaIndex extends Component
{
    use WithPagination;

    public $title;
    public $modal_edit = false;
    public $area, $nombre, $descripcion, $entidad_id;
    public $q;

    protected $listeners = ['render'];

    protected $queryString = [
        'q' => ['except' => '']
    ];

    protected $rules = [
        'area.nombre' => 'required|string|min:2',
        'area.descripcion' => 'required|string|min:2',
    ];

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function mount($id)
    {
        $this->title = 'Areas';
        $this->entidad_id = $id;
    }

    public function render()
    {
        $areas = EntidadArea::where('entidad_id', $this->entidad_id)
            ->when( $this->q, function($query){
                return $query->where( function($query){
                    $query
                        ->where('nombre', 'like', '%'.$this->q . '%')
                        ->orWhere('descripcion', 'like', '%' .$this->q . '%');
                });
            });
        $areas = $areas->paginate(10);

        return view('livewire.entidad.entidad-area-index', ['areas' => $areas]);
    }

    public function editar(EntidadArea $area)
    {
        $this->area = $area;
        $this->modal_edit = true;
    }

    public function actualizar()
    {
        $this->validate();
        $this->area->save();
        $this->modal_edit = false;
        // $this->emit('alert', 'Registro actualizado.');
    }

    public function saveDelete(Entidad $entidad)
    {
        $entidad->activo = 0;
        $entidad->save();
        session()->flash('message', 'Registro eliminado correctamente');
    }
}
