<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ToursRepository;
use App\Http\Controllers\ApiController;

class ToursController extends ApiController
{
    private $repository;

    public function __construct(ToursRepository $repository)
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
