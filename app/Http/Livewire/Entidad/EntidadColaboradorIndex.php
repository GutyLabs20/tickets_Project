<?php

namespace App\Http\Livewire\Entidad;

use App\Models\EntidadColaborador;
use Livewire\Component;
use Livewire\WithPagination;

class EntidadColaboradorIndex extends Component
{
    use WithPagination;

    public $title;
    public $modal_edit = false;
    public $colaborador, $nombre, $descripcion, $entidad_id;
    public $q;

    protected $listeners = ['render'];

    protected $queryString = [
        'q' => ['except' => '']
    ];

    protected $rules = [
        'cola$colaborador.nombre' => 'required|string|min:2',
        'cola$colaborador.descripcion' => 'required|string|min:2',
    ];

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function mount($id)
    {
        $this->title = 'Colaboradores';
        $this->entidad_id = $id;
    }

    public function render()
    {
        $colaboradores = EntidadColaborador::where('entidad_id', $this->entidad_id)
            ->when( $this->q, function($query){
                return $query->where( function($query){
                    $query
                        ->where('nombre', 'like', '%'.$this->q . '%')
                        ->orWhere('descripcion', 'like', '%' .$this->q . '%');
                });
            });
        $colaboradores = $colaboradores->paginate(10);

        return view('livewire.entidad.entidad-colaborador-index', ['colaboradores' => $colaboradores]);
    }
}
