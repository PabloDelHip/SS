<?php

namespace App\Repositories;
use App\Http\Controllers\ApiController;
class ReservacionesRepository extends ApiController{
    
    //public $fillable = []

    public function store(array $reservacion) {

        $reservacion['nombre'] = 'Nombre';
        return $this->showAll($reservacion);
    }

}