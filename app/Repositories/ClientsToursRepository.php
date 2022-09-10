<?php

namespace App\Repositories;
use App\Http\Controllers\ApiController;
use App\Client_Tour;
class ClientsToursRepository extends ApiController {

  public function get() {
    return Client_Tour::with('tour')
      ->with('cliente')  
      ->get();
  }

  public function getTours($claveCliente) {
    return Client_Tour::where('clave_cliente', $claveCliente)
      ->with('tour')
      ->with('cliente')  
      ->get();
  }
  
  public function create(array $data) {
    return Client_Tour::create($data);
  }

  public function delete($clave) {
    return Client_Tour::where('clave', $clave)->delete();
  }

  public function find($clave) {
    return Client_Tour::where("clave", $clave)
      ->with('tour')
      ->with('cliente')  
      ->get();
  }

  public function update(array $data, $clave) {
    return Client_Tour::where('clave', $clave)
         ->update($data);
  }

}