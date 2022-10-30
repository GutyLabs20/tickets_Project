<?php

namespace App\Http\Livewire\Entidad;

use App\Models\EntidadColaborador;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EntidadColaboradorIndex extends Component
{
    use WithPagination;

    public $title;
    public $modal_edit = false;
    // public $colaborador, $nombre, $descripcion, $entidad_id;
    public $colaborador, $nombres, $apellidos, $email, $telefono, $area_id, $entidad_id, $puesto;
    public $q;

    protected $listeners = ['render'];

    protected $queryString = [
        'q' => ['except' => '']
    ];

    protected $rules = [
        'colaborador.nombres' => 'required|string|min:2',
        'colaborador.apellidos' => 'required|string|min:2',
        'colaborador.email' => 'required|string|min:2',
        'colaborador.telefono' => 'required|string|min:2',
        'colaborador.area_id' => 'required',
        'colaborador.puesto' => '',
    ];

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function mount($id)
    {
        $this->title = 'Colaboradores';
        $this->entidad_id = $id;
        $this->areas = DB::table('entidad_areas')
            ->where(function($query){
                $query
                    ->where('activo', 1)
                    ->where('entidad_id', $this->entidad_id);
            })
            ->pluck('nombre', 'id');
        $this->cargos = DB::table('entidad_cargos')->where('activo', 1)->pluck('nombre', 'id');
        // $this->e = DB::table('entidad')->where('nro_doc', $this->entidad_id)->first();
    }

    public function render()
    {
        $e = DB::table('entidad')->where('nro_doc', $this->entidad_id)->first();
        $e = $e->id;
        $colaboradores = EntidadColaborador::where(function($query) use ($e){
            $query
                ->where('activo', 1)
                ->where('entidad_id', $e);
        })
            ->when( $this->q, function($query){
                return $query->where( function($query){
                    $query
                        ->where('nombres', 'like', '%'.$this->q . '%')
                        ->orWhere('apellidos', 'like', '%' .$this->q . '%');
                });
            });
        $colaboradores = $colaboradores->paginate(10);

        return view('livewire.entidad.entidad-colaborador-index', ['colaboradores' => $colaboradores]);
    }

    public function editar(EntidadColaborador $colaborador)
    {
        $this->colaborador = $colaborador;
        $this->modal_edit = true;
    }

    public function actualizar()
    {
        $this->validate();
        $this->colaborador->save();
        $this->modal_edit = false;
        // $this->emit('alert', 'Registro actualizado.');
    }

    public function saveDelete(EntidadColaborador $colaborador)
    {
        $colaborador->activo = 0;
        $colaborador->save();
        session()->flash('message', 'Registro eliminado correctamente');
    }
}
