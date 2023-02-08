<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\User;
use App\Models\Usuario;
use Livewire\Component;
use Livewire\WithPagination;

class UsuarioClientes extends Component
{
    use WithPagination;

    public $title;
    public $usuario, $nombres, $apellidos, $email, $tipo_id;
    public $modal_edit = false;

    public function mount()
    {
        $this->title = "Usuarios - Clientes";
    }

    protected $rules = [
        'usuario.nombres' => 'required|string|min:2',
        'usuario.apellidos' => 'required|string|min:2',
        'usuario.usuario' => 'required|string|min:2',
        'usuario.email' => 'required|email',
        'usuario.tipousuario_id' => 'required',
    ];

    public function render()
    {
        $usuarios = User::where('activo', 1)
                ->where('tipousuario_id', 6)
                ->paginate(10);
        return view('livewire.usuarios.usuario-clientes', [
            'usuarios' => $usuarios
        ]);
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
