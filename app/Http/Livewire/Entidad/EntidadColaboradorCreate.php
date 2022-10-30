<?php

namespace App\Http\Livewire\Entidad;

use App\Models\EntidadColaborador;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class EntidadColaboradorCreate extends Component
{
    public $open = false;
    public $nombres, $apellidos, $email, $telefono, $area_id, $entidad_id, $puesto;

    protected $rules = [
        'nombres' => 'required|min:2',
        'apellidos' => 'required|min:2',
        'email' => 'required|min:2',
        'telefono' => 'required|min:2',
        'area_id' => 'required',
    ];

    public function mount()
    {
        $entidad_id = \Route::current()->parameter('id');
        $e = DB::table('entidad')->where('nro_doc', $entidad_id)->first();
        $this->entidad_id = $e->id;
        $this->areas = DB::table('entidad_areas')
            ->where(function($query){
                $query
                    ->where('activo', 1)
                    ->where('entidad_id', $this->entidad_id);
            })
            ->pluck('nombre', 'id');
        $this->cargos = DB::table('entidad_cargos')->where('activo', 1)->pluck('nombre', 'id');
    }

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
        $this->nombres = '';
        $this->apellidos = '';
        $this->email = '';
        $this->telefono = '';
        $this->area_id = '';
    }

    public function save()
    {
        $this->validate();

        EntidadColaborador::create([
            'nombres' => ucwords($this->nombres),
            'apellidos' => ucwords($this->apellidos),
            'email' => $this->email,
            'telefono' => $this->telefono,
            'slug' => Str::slug($this->nombres),
            'area_id' => $this->area_id,
            'entidad_id' => $this->entidad_id,
            'puesto' => $this->puesto
        ]);

        $this->reset([
            'open', 'nombres', 'apellidos', 'email', 'telefono', 'area_id', 'entidad_id'
        ]);
        $this->emitTo('entidad.entidad-colaborador-index', 'render');
        $this->emit('alert', 'Registrado satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.entidad.entidad-colaborador-create');
    }
}
