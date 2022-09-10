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

    public function create(array $data) {
        $last_cliente = Clientes::orderBy('clave', 'desc')->first();
        $cliente = new Clientes();
        $cliente->clave = $last_cliente + 1;
        $cliente->razon = $data['razon'];
        $cliente->nombre = $data['nombre'];
        $cliente->direccion = $data['direccion'];
        $cliente->ciudad = $data['ciudad'];
        $cliente->estado = $data['estado']; 
        $cliente->rfc = $data['rfc'];
        $cliente->comision = $data['comision']; 
        $cliente->diarevision = $data['diarevision']; 
        $cliente->diapago = $data['diapago'];
        $cliente->diascred = $data['diascred'];
        $cliente->tcambio = $data['tcambio'];
        $cliente->ctacliente = $data['ctacliente'];
        $cliente->ag_activa = $data['ag_activa'];
        $cliente->saldo_ini = $data['saldo_ini'];
        $cliente->notipoc = $data['notipoc'];
        $cliente->prec_prop = $data['prec_prop'];
        $cliente->tienecred = $data['tienecred'];
        $cliente->cvexcaret = $data['cvexcaret'];
        $cliente->save();
        return $cliente;
    }

    public function update(array $data, $clave) {
        return Clientes::where('clave', $clave)
             ->update($data);
    }

}
