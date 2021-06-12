<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReservacionesRepository;
use App\Http\Controllers\ApiController;

class ReservacionesController extends ApiController
{
    private $repository;

    public function __construct(ReservacionesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request) {
        $reserva = [];
        return $this->repository->store($reserva);
    }
}
