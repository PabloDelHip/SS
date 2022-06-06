<?php

namespace App\Http\Controllers;
use App\Repositories\ClientesRepository;
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
}
