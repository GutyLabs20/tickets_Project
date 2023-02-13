<?php

namespace App\Http\Livewire\Entidad;

use App\Models\Entidad;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EntidadCreate extends Component
{
    public $open = false;
    public $tipo_doc, $nro_doc, $nombre, $slug, $descripcion, $logotipo_path,
            $logotipo_nombre, $telefono, $email, $tipodocumento, $atencion_id;
    public $tipoatencion;

    protected $rules = [
        'tipo_doc' => 'required',
        'nro_doc' => 'required',
        'nombre' => 'required|min:2',
        'descripcion' => 'required|min:2',
        'telefono' => 'required',
        'email' => 'required|email|unique:entidad',
        'atencion_id' => 'required'
    ];

    public function mount()
    {
        $this->tipodocumento = DB::table('tipodocumento')->where('activo', 1)->pluck('nombre', 'id');
        $this->tipoatencion = DB::table('tipo_atencion')->where('activo', 1)->pluck('nombre', 'id');
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
        $this->tipo_doc = '';
        $this->nro_doc = '';
        $this->nombre = '';
        $this->descripcion = '';
        $this->telefono = '';
        $this->email = '';
        $this->atencion_id = '';
    }

    public function save()
    {
        $this->validate();
        // $this->codigo = $this->generate_string(6);
        Entidad::create([
            'tipo_doc' => strtoupper($this->tipo_doc),
            'nro_doc' => $this->nro_doc,
            'nombre' => strtoupper($this->nombre),
            'descripcion' => ucfirst($this->descripcion),
            'telefono' => $this->telefono,
            'email' => $this->email,
            'logotipo_path' => 'mi ruta del logotipo',
            'logotipo_nombre' => 'milogo.jpg',
            'created_by' => auth()->user()->id,
            'atencion_id' => intval($this->atencion_id)
        ]);

        $this->reset([
            'open', 'tipo_doc', 'nro_doc', 'nombre', 'descripcion', 'telefono', 'email', 'logotipo_path', 'tipoatencion'
        ]);
        $this->emitTo('entidad.entidad-index', 'render');
        $this->emit('alert', 'Registrado satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.entidad.entidad-create');
    }

    public function consulta_ruc($nro_doc)
    {
        $api_tocken = '835d4ba558ca6193356167e065c7c7809d0cef0bf72ef171ec47de96bbecfe3f';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiperu.dev/api/ruc/'.$nro_doc.'?api_token='.$api_tocken,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYPEER => false
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
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
}
