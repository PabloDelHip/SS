<?php

namespace App\Repositories;
use App\Http\Controllers\ApiController;
use App\Hotels;
class HotelsRepository extends ApiController{

    public function get() {
        $hotels = Hotels::orderBy("nombre")->get();
        return $this->showAll($hotels);
    }

    public function find($clave) {
        $hotels = Hotels::where("clave", $clave)->get();
        return $this->showAll($hotels);
    }

}
