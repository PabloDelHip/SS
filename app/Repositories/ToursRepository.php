<?php

namespace App\Repositories;
use App\Http\Controllers\ApiController;
use App\Tours;
class ToursRepository extends ApiController{

    public function get() {
        $tours = Tours::orderBy("nombretour")->get();
        return $this->showAll($tours);
    }

    public function getId($id) {
        return Tours::select('clave', 'locacion' )->where("clave",$id)->get();
    }

    public function find($clave) {
        $tours = Tours::where("clave", $clave)->get();
        return $this->showAll($tours);
    }

}
