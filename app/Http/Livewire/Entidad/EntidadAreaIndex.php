<?php

namespace App\Http\Livewire\Entidad;

use App\Models\EntidadArea;
use Livewire\Component;

class EntidadAreaIndex extends Component
{
    public $title, $empresa;
    public $entidad_id, $codigo;
    public $q;

    protected $queryString = [
        'q' => ['except' => '']
    ];

    public function mount($id)
    {
        $this->title = 'Areas';
        $this->entidad_id = $id;
    }

    public function render()
    {
        $areas = EntidadArea::where('entidad_id', $this->entidad_id)
            ->when( $this->q, function($query){
                return $query->where( function($query){
                    $query
                        ->where('nro_doc', 'like', '%'.$this->q . '%')
                        ->orWhere('nombre', 'like', '%' .$this->q . '%');
                });
            });
        $areas = $areas->paginate(10);

        return view('livewire.entidad.entidad-area-index', ['areas' => $areas]);
    }

}
