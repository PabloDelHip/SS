<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Guias\GuiaCreateRequest;
use App\Repositories\GuiasRepository;

class GuiasController extends ApiController
{
    private $guiaRepository;

    public function __construct(GuiasRepository $guiaRepository)
    {
        $this->guiaRepository = $guiaRepository;
    }

    public function create(GuiaCreateRequest $request) {
        try {
            $data = $request->all();
            $response = $this->guiaRepository->create($data);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function update(GuiaCreateRequest $request, $clave) {
        try {
            $data = $request->all();
            $response = $this->guiaRepository->update($data, $clave);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function delete($clave) {
        try {
            $data = [];
            $data['status'] = 0;
            $response = $this->guiaRepository->update($data, $clave);
            return $this->showAll($response);
        } catch (MassAssignmentException $err) {
            return  $this->errorResponse($th, 500);
        }
    }

    public function get() {
        $response = $this->guiaRepository->get();
        return $this->showAll($response);
    }

    public function find($clave) {
        $response = $this->guiaRepository->find($clave);
        return $this->showAll($response);
    }

}
