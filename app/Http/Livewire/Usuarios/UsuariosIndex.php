<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\TipoUsuario;
use App\Models\User;
use App\Models\Usuario;
use Livewire\Component;

class UsuariosIndex extends Component
{
    public $title;
    public $usuario, $nombres, $apellidos, $email, $tipo_id;
    public $modal_edit = false;

    protected $listeners = ['render'];

    protected $rules = [
        'usuario.nombres' => 'required|string|min:2',
        'usuario.apellidos' => 'required|string|min:2',
        'usuario.usuario' => 'required|string|min:2',
        'usuario.email' => 'required|email',
        'usuario.tipousuario_id' => 'required',
    ];

    public function mount()
    {
        $this->title = "Gestores";
    }

    public function render()
    {
        $tipousuarios = TipoUsuario::pluck('id', 'nombre');
        $usuarios = User::where('activo', 1)->paginate(10);
        return view('livewire.usuarios.usuarios-index', [
            'usuarios' => $usuarios,
            'tipousuarios' => $tipousuarios
        ]);
    }

    public function editar(Usuario $usuario)
    {
        $this->usuario = $usuario;
        $this->modal_edit = true;
    }

    public function actualizar()
    {
        $this->validate();
        $this->usuario->save();
        $this->modal_edit = false;
    }

    public function saveDelete(Usuario $usuario)
    {
        $usuario->activo = 0;
        $usuario->save();
        session()->flash('message', 'Usuario eliminado correctamente');
    }
}
