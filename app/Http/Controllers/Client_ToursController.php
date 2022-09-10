<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClientsTours\ClientTourCreateRequest;
use App\Repositories\ClientsToursRepository;
use App\Http\Controllers\ApiController;

class Client_ToursController extends ApiController
{
    private $clientTourRepository;

    public function __construct(ClientsToursRepository $clientTourRepository)
    {
        $this->repository = $clientTourRepository;
    }

    public function create(ClientTourCreateRequest $request) {
        try {
            $data = $request->all();
            $response = $this->repository->create($data);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function get() {
        try {
            $response = $this->repository->get();
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function find($clave) {
        try {
            $response = $this->repository->find($clave);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function getTours($claveCliente) {
        try {
            $response = $this->repository->getTours($claveCliente);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function delete($clave) {
        try {
            $response = $this->repository->delete($clave);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function update(ClientTourCreateRequest $request, $clave) {
        try {
            $data = $request->all();
            $response = $this->repository->update($data, $clave);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }
}
