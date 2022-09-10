<?php

namespace App\Http\Controllers;
use App\Repositories\ClientesRepository;
use App\Http\Requests\Clientes\ClientesRequest;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class ClientesController extends ApiController
{
    public function __construct(ClientesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get() {
        return $this->repository->get();
    }

    public function find($clave) {
        return $this->repository->find($clave);
    }

    public function create(ClientesRequest $request) {
        try {
            $data = $request->all();
            $response = $this->repository->create($data);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function update(ClientesRequest $request, $clave) {
        try {
            $data = $request->all();
            $response = $this->repository->update($data, $clave);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }
}
