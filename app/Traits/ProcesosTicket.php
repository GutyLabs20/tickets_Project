<?php
namespace App\Traits;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait ProcesosTicket {

    public function ticketID($IdTicket)
    {
        // $ticket = DB::table('tickets')->where('id', $IdTicket)->first();
        $ticket = Ticket::where('id', $IdTicket)->first();
        if(!$ticket){
            $ticket = NULL;
        }
        return $ticket;
    }

    public function dias_pasados($fecha_inicial)
    {
        $fecha_actual = Carbon::now();
        $format_fecha_inicial = Carbon::parse($fecha_inicial);

        $dias = (strtotime($format_fecha_inicial)-strtotime($fecha_actual))/86400;
        $dias = abs($dias);
        $dias = floor($dias);

        if ($dias > 7) {
            $dias = $format_fecha_inicial->isoFormat('LL');
        } else {
            $dias = $format_fecha_inicial->diffForHumans();
        }

        return $dias;
    }

    public function seleccionColorEstadoModal($colorRecibido)
    {
        switch ($colorRecibido) {
            case (1):
                $color = 'orange';
                break;
            case (2):
                $color = 'yellow';
                break;
            case (3):
                $color = 'indigo';
                break;
            case (4):
                $color = 'green';
                break;
            case (5):
                $color = 'red';
                break;
            case (6):
                $color = 'teal';
                break;
            default:
                $color = 'grey';
        }
        return $color;
    }

    public function seleccionColorPrioridadModal($colorRecibido)
    {
        switch ($colorRecibido) {
            case (1):
                $colorPrioridad = 'red';
                break;
            case (2):
                $colorPrioridad = 'yellow';
                break;
            case (3):
                $colorPrioridad = 'blue';
                break;
            case (4):
                $colorPrioridad = 'green';
                break;
            default:
                $colorPrioridad = 'grey';
        }
        return $colorPrioridad;
    }

    public function seleccionCalificacion($valor)
    {
        switch (intval($valor)) {
            case (1):
                $satisfaccion = 'Mala';
                break;
            case (2):
                $satisfaccion = 'Regular';
                break;
            case (3):
                $satisfaccion = 'Buena';
                break;
            case (4):
                $satisfaccion = 'Muy Buena';
                break;
            case (5):
                $satisfaccion = 'Excelente';
                break;
            default:
                $satisfaccion = 'Sin selección';
        }
        return $satisfaccion;
    }

}
