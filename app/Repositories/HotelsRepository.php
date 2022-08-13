<?php

namespace App\Repositories;
use App\Http\Controllers\ApiController;
use App\Hotels;
class HotelsRepository extends ApiController{

    public function createHotel(array $dataHotel) {

        $last_hotel = Hotels::orderBy('clave', 'desc')->first();
        $hotel = new Hotels();
        $hotel->clave = $last_hotel['clave'] + 1;
        $hotel->nombre = $dataHotel['nombre'];
        $hotel->direccion = isset($dataHotel['direccion']) ? $dataHotel['direccion'] : '';
        $hotel->ciudad = $dataHotel['ciudad'];
        $hotel->estado = $dataHotel['estado'];
        $hotel->telefonos = isset($dataHotel['telefonos']) ? $dataHotel['telefonos'] : '';
        $hotel->zona = $dataHotel['zona'];
        $hotel->contacto = isset($dataHotel['contacto']) ? $dataHotel['contacto'] : '';
        $hotel->orden = $dataHotel['orden'];
        $hotel->pickfijo = isset($dataHotel['pickfijo']) ? $dataHotel['pickfijo'] : '';
        $hotel->cvehotxc = isset($dataHotel['cvehotxc']) ? $dataHotel['cvehotxc'] : '';
        $hotel->save();
        return $hotel;
    }

    public function update(array $hotel, $clave) {
        return Hotels::where('clave', $clave)
             ->update($hotel);
    }

    public function get() {
        $hotels = Hotels::where('status', 1)->orderBy("nombre")->get();
        return $this->showAll($hotels);
    }

    public function find($clave) {
        $hotels = Hotels::where("clave", $clave)
            ->where("status", 1)
            ->get();
        return $this->showAll($hotels);
    }

}
