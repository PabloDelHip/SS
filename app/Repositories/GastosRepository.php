<?php

namespace App\Repositories;
use App\Http\Controllers\ApiController;
use App\Gastos;

class GastosRepository extends ApiController {
  
  public function create(array $data) {
    return Gastos::create($data);
  }

  public function update(array $data, $clave) {
    return Gastos::where('clave', $clave)
         ->update($data);
  }

  public function get() {
    return Gastos::where('status', 1)
      ->get();
  }

  public function find($clave) {
    return Gastos::findOrFail($clave);
  }

  public function delete($clave) {
    return Gastos::where('clave', $clave)
         ->update([
           "status" => 0
         ]);
  }

  public function getByClaveClientesTours($clave_clientes_tours) {
    return Gastos::where('clave_clientes_tours', $clave_clientes_tours)
      ->where('status', 1)
      ->get();
  }

}