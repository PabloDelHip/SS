<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CorridasRepository;
use App\Repositories\ReservacionesRepository;
use PDF;

class HomeController extends ApiController
{
    private $corridasRepository, $reservacionesRepository;

    public function __construct(
        CorridasRepository $corridasRepository,
        ReservacionesRepository $reservacionesRepository)
    {
        $this->corridasRepository = $corridasRepository;
        $this->reservacionesRepository = $reservacionesRepository;
    }

    public function index() {
        return view('home.inicio');
    }

    public function pdfCorridas($date, $nacionalidad) {
        /* $pdf = app('dompdf.wrapper');
        $pdf->loadView('<h1>Styde.net</h1>');
        return $pdf->download('mi-archivo.pdf'); */
        $fecha = $this->dateSql($date);
        $dateTime = $fecha." 00:00:00.000";
        $corridas =  $this->corridasRepository->getCorridas($dateTime);
        //dd($corridas);
        $corridasData = array();
        foreach ($corridas as $corrida) {
            $data = [];
            $data['corrida'] = $corrida['clave'];
            $data["nombre_tour"] = $corrida['tour']['nombretour'];
            $data["fecha"] = $fecha;
            $data["elaboro"] = $corrida['elaboro'];
            $data["observacion"] = $corrida['observacion'];
            $data['reservaciones'] = $this->reservacionesRepository->findByCorrida($corrida['clave'], $nacionalidad);
           //  dd($data['reservaciones'][0]['hotel']);
            $totalPax = 0;
            foreach ($data['reservaciones'] as $reservacion) {
                $totalPax += $reservacion['paxa'] + $reservacion['paxb'];
                $reservacion['pax'] = $reservacion['paxa'].'.'.$reservacion['paxb'];
            }
            $data['totalPax'] = $totalPax;
            $data['nombre_guia'] = $corrida['guia']['nombre'];
            $data['aborde'] = $corrida['guia']['aborde'];
            //$data['reservaciones']['totalPax'] = $data[''];
            array_push($corridasData, $data);
        }
        $corridasData = $this->showAll($corridasData);
        $corridasData = json_decode(json_encode($corridasData), true);
        $corridasData = $corridasData['original']['data'];  
           
        $data = [
            'fecha' => $fecha,
            'corridasData' => $corridasData
        ];
        $pdf = PDF::loadView('reportes.vista-pdf', $data);
        return $pdf->stream('archivo.pdf');
    }
}
