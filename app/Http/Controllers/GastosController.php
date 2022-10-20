<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Gastos\GastosRequest;
use App\Repositories\GastosRepository;

class GastosController extends ApiController
{
    private $gastosRepository;

    public function __construct(GastosRepository $gastosRepository)
    {
        $this->gastosRepository = $gastosRepository;
    }

    public function create(GastosRequest $request) {
        try {
            $data = $request->all();
            $response = $this->gastosRepository->create($data);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function update(GastosRequest $request, $clave) {
        try {
            $data = $request->all();
            $response = $this->gastosRepository->update($data, $clave);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function get() {
        try {
            $response = $this->gastosRepository->get();
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function find($clave) {
        try {
            $response = $this->gastosRepository->find($clave);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function delete($clave) {
        try {
            $response = $this->gastosRepository->delete($clave);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function getByClaveClientesTours($clave_clientes_tours) {
        try {
            $response = $this->gastosRepository->getByClaveClientesTours($clave_clientes_tours);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }        
    }
    
}
