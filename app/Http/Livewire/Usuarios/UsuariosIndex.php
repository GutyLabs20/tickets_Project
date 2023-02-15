<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\TipoUsuario;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class UsuariosIndex extends Component
{
    use WithPagination;

    public $title;
    public $usuario, $nombres, $apellidos, $email, $tipo_id;
    public $modal_edit = false;
    public $q;

    protected $queryString = [
        'q' => ['except' => '']
    ];

    protected $listeners = ['render'];

    protected $rules = [
        'usuario.nombres' => 'required|string|min:2',
        'usuario.apellidos' => 'required|string|min:2',
        'usuario.usuario' => 'required|string|min:2',
        'usuario.email' => 'required|email',
        'usuario.tipousuario_id' => 'required',
    ];

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->title = "Gestores";
    }

    public function render()
    {
        $tipousuarios = TipoUsuario::where('activo',1)->pluck('id', 'nombre');

        $e = DB::table('tipousuarios')->where('nombre', 'Cliente')->first();

        if (!isset($e)) {
            $usuarios = User::where('activo', 1)->paginate(10);
        } else {
            $e = $e->id;
            $usuarios = User::where(function($query) use ($e){
                $query
                    ->where('activo', 1)
                    ->whereNotIn('tipousuario_id', [$e]);
            })
                ->when( $this->q, function($query){
                    return $query->where( function($query){
                        $query
                            ->where('nombres', 'like', '%'.$this->q . '%')
                            ->orWhere('apellidos', 'like', '%' .$this->q . '%');
                    });
                });

            $usuarios = $usuarios->paginate(10);
        }

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
