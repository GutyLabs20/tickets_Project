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
    public $entidad, $tipo_doc, $nro_doc, $nombre, $slug, $descripcion, $logotipo_path, $logotipo_nombre, $telefono, $email;
    public $q;

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
        'entidad.email' => 'required'
    ];

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->title = "Empresas";
        // $this->codigo = $this->generate_string(6);
    }

    public function generate_string($strleng)
    {
        $input = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($input);
        $random_string = '';
        for ($i=0; $i < $strleng; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

    public function render()
    {
        $entidades = Entidad::where('activo', 1)
            ->when( $this->q, function($query){
                return $query->where( function($query){
                    $query
                        ->where('nro_doc', 'like', '%'.$this->q . '%')
                        ->orWhere('nombre', 'like', '%' .$this->q . '%');
                });
            });
        $entidades = $entidades->paginate(10);
        $tipodocumento = DB::table('tipodocumento')->where('activo', 1)->pluck('nombre', 'id');
        return view('livewire.entidad.entidad-index', ['entidades' => $entidades, 'tipodocumento' => $tipodocumento]);
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

    public function saveDelete(Entidad $entidad)
    {
        $entidad->activo = 0;
        $entidad->save();
        session()->flash('message', 'Registro eliminado correctamente');
    }
}
