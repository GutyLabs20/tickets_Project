<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UsuariosCrear extends Component
{
    public $open = false;
    public $nombres, $apellidos, $usuario, $email, $tipousuario_id, $password;
    public $tipousuarios;

    protected $rules = [
        'nombres' => 'required|min:2',
        'apellidos' => 'required|min:2',
        'email' => 'required|email|min:2|unique:users',
        'tipousuario_id' => 'required',
        'password' => 'required|min:8',
    ];

    public function mount()
    {
        $this->tipousuarios = DB::table('tipousuarios')->where('activo', 1)->pluck('nombre', 'id');
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
        $this->tipousuario_id = '';
        $this->password = '';
    }

    public function save()
    {
        $this->validate();
        $nom = explode(' ', $this->nombres);
        $ape = explode(' ', $this->apellidos);
        $this->usuario = ucwords($nom[0]) . ' ' . ucwords($ape[0]);
        User::create([
            'nombres' => ucwords($this->nombres),
            'apellidos' => ucwords($this->apellidos),
            'usuario' => ucwords($this->usuario),
            'email' => $this->email,
            'tipousuario_id' => intval($this->tipousuario_id),
            'password' => Hash::make($this->password)
        ]);

        $this->reset([
            'open', 'nombres', 'apellidos', 'usuario', 'email', 'password', 'tipousuario_id'
        ]);
        $this->emitTo('usuarios.usuarios-index', 'render');
        $this->emit('alert', 'Registrado satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.usuarios.usuarios-crear');
    }
}
