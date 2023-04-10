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
    public $modal_delete = false;
    // public $colaborador, $nombre, $descripcion, $entidad_id;
    public $colaborador, $nombres, $apellidos, $email, $telefono, $area_id, $entidad_id, $cargos, $rol;
    public $q;

    protected $listeners = ['render', 'delete'];

    protected $queryString = [
        'q' => ['except' => '']
    ];

    public function rules()
    {
        return [
            'colaborador.nombres' => 'required|string|min:2',
            'colaborador.apellidos' => 'required|string|min:2',
            'colaborador.email' => 'required|string|min:2|email',
            'colaborador.telefono' => 'required|string|min:2',
            'colaborador.rol' => '',
            'colaborador.activo' => 'int',
        ];
    }

    // 'colaborador.email' => 'required|string|min:2|email|unique:entidad_colaboradores,email,'. $this->id,

    // protected $rules = [
    //     'colaborador.nombres' => 'required|string|min:2',
    //     'colaborador.apellidos' => 'required|string|min:2',
    //     'colaborador.email' => 'required|string|min:2|email|unique:entidad_colaboradores,email,'. $this->id,
    //     'colaborador.telefono' => 'required|string|min:2',
    //     'colaborador.rol' => '',
    // ];

    public function updatingQ()
    {
        $this->resetPage();
    }
    public function updatingColaborador()
    {
        $this->resetPage();
    }
    public function updatingModalDelete()
    {
        $this->resetPage();
    }

    public function mount($id)
    {
        $this->title = 'Colaboradores';
        $this->entidad_id = $id;
        $this->cargos = DB::table('entidad_cargos')->where('activo', 1)->pluck('nombre', 'id');
    }

    public function render()
    {
        $e = DB::table('entidad')->where('nro_doc', $this->entidad_id)->first();
        $e = $e->id;
        $colaboradores = EntidadColaborador::where(function($query) use ($e){
            $query
                // ->where('activo', 1)
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
        $this->colaborador->nombres = ucwords($this->colaborador->nombres);
        $this->colaborador->apellidos = ucwords($this->colaborador->apjellidos);
        $this->colaborador->email = strtolower($this->colaborador->email);
        $this->colaborador->save();
        $this->modal_edit = false;
        $this->emit('alert', 'Colaborador actualizado satisfactoriamente.');
    }

    public function saveDelete(EntidadColaborador $colaborador)
    {
        // DB::table('users')
        // ->where(
        //     ['compania',$this->entidad_id]
        // )
        // ->update([
        //     'activo' => 0
        // ]);
        $colaborador->activo = 0;
        $colaborador->save();
        session()->flash('message', 'Registro eliminado correctamente');
    }

    // public function delete(EntidadColaborador $colaborador)
    // {
    //     $this->colaborador = $colaborador;
    //     $this->modal_delete = true;
    // }

    // public function eliminar()
    // {
    //     $this->validate();

    //     DB::table('users')
    //         ->where('compania',
    //             $this->entidad_id->id)
    //         ->update([
    //             'activo' => 0
    //         ]);
    //     $this->colaborador->activo = 0;
    //     $this->colaborador->save();
    //     $this->modal_delete = false;

    //     $this->emit('alert', 'Registro eliminado correctamente');
    // }
}
