<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\HotelsRepository;
use App\Http\Controllers\ApiController;

class HotelsController extends ApiController
{
    private $repository;

    public function __construct(HotelsRepository $repository)
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
