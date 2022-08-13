<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Hotels\HotelCreateRequest;
use App\Repositories\HotelsRepository;
use App\Http\Controllers\ApiController;

class HotelsController extends ApiController
{
    private $repository;

    public function __construct(HotelsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(HotelCreateRequest $request) {
        try {
            $dataHotel = $request->all();
            $response = $this->repository->createHotel($dataHotel);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function update(HotelCreateRequest $request, $clave) {
        try {
            $dataHotel = $request->all();
            $response = $this->repository->update($dataHotel, $clave);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function delete($clave) {
        try {
            $dataHotel = [];
            $dataHotel["status"] = 0;
            $response = $this->repository->update($dataHotel, $clave);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function get() {
        return $this->repository->get();
    }

    public function find($clave) {
        return $this->repository->find($clave);
    }
}
