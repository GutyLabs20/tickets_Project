<?php

namespace App\Http\Livewire\Entidad;

use App\Models\Entidad;
use App\Models\EntidadArea;
use App\Models\EntidadColaborador;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EntidadAreaIndex extends Component
{
    use WithPagination;

    public $title;
    public $modal_edit = false;
    public $modal_delete = false;
    public $modal_enable = false;
    public $area, $nombre, $descripcion, $entidad_id;
    public $q, $activo;

    protected $listeners = [
        'render',
        'delete' => 'eliminar',
        'enable' => 'habilitar'
    ];

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
    public function updatingActivo()
    {
        $this->resetPage();
    }
    public function updatingModalDelete()
    {
        $this->resetPage();
    }
    public function updatingModalEnable()
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
        $e = DB::table('entidad')->where('nro_doc', $this->entidad_id)->first();
        $areas = EntidadArea::where('entidad_id', $e->id)
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
        $this->emit('alert', 'Registro actualizado.');
    }

    public function delete(EntidadArea $area)
    {
        $this->area = $area;
        $this->modal_delete = true;
    }

    public function eliminar()
    {
        $this->validate();
        $this->area->activo = intval(0);
        $this->area->save();
        $this->modal_delete = false;
        $this->emit('alert', 'Registro eliminado correctamente');
        // session()->flash('message', 'Registro eliminado correctamente');
    }

    public function enable(EntidadArea $area)
    {
        $this->area = $area;
        $this->modal_enable = true;
    }

    public function habilitar()
    {
        $this->area->activo = intval(1);
        $this->area->save();
        $this->modal_enable = false;
        $this->emit('alert', 'Registro eliminado correctamente');
        // session()->flash('message', 'Registro eliminado correctamente');
    }

}
