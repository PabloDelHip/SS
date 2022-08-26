<?php

namespace App\Repositories;
use App\Http\Controllers\ApiController;
use App\Guias;

class GuiasRepository extends ApiController{

    public function create(array $data) {
      $last_guia = Guias::orderBy('clave', 'desc')->first();
      $guia = new Guias();
      $guia->clave = $last_guia['clave'] + 1;
      $guia->nombre = $data['nombre'];
      $guia->idiomas = $data['idiomas'];
      $guia->direccion = $data['direccion'];
      $guia->telefono = $data['telefono'];
      $guia->honorarios = $data['honorarios']; 
      $guia->aborde = $data['aborde'];
      $guia->save();
      return $guia;
    }

    public function update(array $data, $clave) {
        return Guias::where('clave', $clave)
             ->update($data);
    }

    public function get() {
        return Guias::where('status', 1)->orderBy("nombre")->get();
        
    }

    public function find($clave) {
        return Guias::where("clave", $clave)
            ->where("status", 1)
            ->get();
    }

}
