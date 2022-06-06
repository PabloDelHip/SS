<?php

namespace App\Repositories;
use App\Http\Controllers\ApiController;
use App\Clientes;
class ClientesRepository extends ApiController{

    public function get() {
        $clientes = Clientes::orderBy("nombre")->get();
        return $this->showAll($clientes);
    }

    public function find($clave) {
        $clientes = Clientes::where("clave", $clave)->get();
        return $this->showAll($clientes);
    }

}
