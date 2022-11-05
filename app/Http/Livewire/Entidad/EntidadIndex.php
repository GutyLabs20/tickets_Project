<?php

namespace App\Http\Livewire\Entidad;

use App\Models\Entidad;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EntidadIndex extends Component
{
    use WithPagination;

    public $title;
    public $modal_edit = false;
    public $modal_delete = false;
    public $modal_enable = false;
    public $entidad, $tipo_doc, $nro_doc, $nombre, $slug, $descripcion, $logotipo_path, $logotipo_nombre, $telefono, $email;
    public $q, $activo;

    protected $listeners = ['render'];

    protected $queryString = [
        'q' => ['except' => '']
    ];

    protected $rules = [
        'entidad.tipo_doc' => 'required',
        'entidad.nro_doc' => 'required',
        'entidad.nombre' => 'required|string|min:2',
        'entidad.descripcion' => 'required|string|min:2',
        'entidad.telefono' => 'required',
        'entidad.email' => 'required',
        'entidad.activo' => 'int'
    ];

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->title = "Empresas";
        $this->tipodocumento = DB::table('tipodocumento')->where('activo', 1)->pluck('nombre', 'id');
    }

    public function render()
    {
        // where('activo', 1)
        $entidades = Entidad::
            when( $this->q, function($query){
                return $query->where( function($query){
                    $query
                        ->where('nro_doc', 'like', '%'.$this->q . '%')
                        ->orWhere('nombre', 'like', '%' .$this->q . '%');
                });
            });
        $entidades = $entidades->paginate(10);

        return view('livewire.entidad.entidad-index', ['entidades' => $entidades]);
    }

    public function editar(Entidad $entidad)
    {
        $this->entidad = $entidad;
        $this->modal_edit = true;
    }

    public function actualizar()
    {
        $this->validate();
        $this->entidad->nombre = strtoupper($this->entidad->nombre);
        $this->entidad->save();
        $this->modal_edit = false;
        // $this->emit('alert', 'Registro actualizado.');
    }

    public function delete(Entidad $entidad)
    {
        $this->entidad = $entidad;
        $this->modal_delete = true;
    }

    public function saveDelete()
    {
        // // dd($this->entidad->activo);
        // // if ($this->entidad->activo == 1) {
        // //     $this->entidad->activo = intval(0);
        // //     $this->entidad->save();
        // // }
        // if ($this->entidad->activo === 0) {
        //     $this->entidad->activo = intval(1);
        //     $this->entidad->save();
        // }
        // // dd($this->entidad->activo);
        $this->entidad->activo = intval(0);
        $this->entidad->save();

        $this->modal_delete = false;
        session()->flash('message', 'Registro eliminado correctamente');
    }

    public function enable(Entidad $entidad)
    {
        $this->entidad = $entidad;
        $this->modal_enable = true;
    }

    public function saveEnable()
    {
        $this->entidad->activo = intval(1);
        $this->entidad->save();

        $this->modal_enable = false;
        session()->flash('message', 'Registro eliminado correctamente');
    }

    // public function saveDelete(Entidad $entidad)
    // {
    //     $entidad->activo = 0;
    //     $entidad->save();
    //     session()->flash('message', 'Registro eliminado correctamente');
    // }
}
