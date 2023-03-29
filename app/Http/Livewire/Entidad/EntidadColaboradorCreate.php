<?php

namespace App\Http\Livewire\Entidad;

use App\Models\EntidadColaborador;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;

class EntidadColaboradorCreate extends Component
{
    public $open = false;
    public $nombres, $apellidos, $email, $telefono, $area_id, $entidad, $puesto, $cargos;
    public $compania;

    protected $rules = [
        'nombres' => 'required|min:2',
        'apellidos' => 'required|min:2',
        'email' => 'required|min:2|email|unique:entidad_colaboradores',
        'telefono' => 'required|min:2'
    ];

    public function mount()
    {
        $entidad_id = \Route::current()->parameter('id');
        $e = DB::table('entidad')->where('nro_doc', $entidad_id)->first();
        $this->entidad = $e->id;
        $this->compania = $e->nro_doc;
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
        $this->puesto = '';
    }

    public function save()
    {
        $this->validate();
        $rol_usuario = DB::table('tipousuarios')->where('nombre', 'Cliente')->first();

        // $bytes = openssl_random_pseudo_bytes(4);
        $bytes = '12345678';
        $pass = bin2hex($bytes);

        $cad01 = explode(' ', ucwords($this->nombres));
        $cad02 = explode(' ', ucwords($this->apellidos));
        $cadUs = ucwords($cad01[0]) . ' ' . ucwords($cad02[0]);

        EntidadColaborador::create([
            'nombres' => ucwords($this->nombres),
            'apellidos' => ucwords($this->apellidos),
            'email' => $this->email,
            'telefono' => $this->telefono,
            'entidad_id' => $this->entidad,
            'rol' => $this->puesto
        ]);

        User::create([
            'nombres' => ucwords($this->nombres),
            'apellidos' => ucwords($this->apellidos),
            'usuario' => $cadUs,
            'email' => $this->email,
            'password' => Hash::make($bytes),
            'tipousuario_id' => intval($rol_usuario->id),
            'compania' => $this->compania,
            'is_customer' => true
        ]);

        $this->reset([
            'open', 'nombres', 'apellidos', 'email', 'telefono', 'puesto'
        ]);
        $this->emitTo('entidad.entidad-colaborador-index', 'render');
        $this->emit('alert', 'Registrado satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.entidad.entidad-colaborador-create');
    }
}
