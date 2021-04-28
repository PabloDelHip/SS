<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\State;
use App\City;

class NationsController extends Controller
{
    public function getCountries()
    {
        try {
            $countries = Country::orderBy('country', 'asc')
                                ->where('status', true)->get();
            return response()->json([
                'success' => true,
                'message' => 'Paises obtenidos correctamente',
                'data' => $countries
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo obtener a los paises',
                'err' => $e
            ], 500);
        }
    }

    public function getStates($id_country)
    {
        try {
            $states = State::orderBy('name', 'asc')
                                ->where('country_id', $id_country)
                                ->where('status', true)->get();
            return response()->json([
                'success' => true,
                'message' => 'Estados obtenidas correctamente',
                'data' => $states
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo obtener a los estados',
                'err' => $e
            ], 500);
        }
    }

    public function getCitys($id_state)
    {
        try {
            $citys = City::orderBy('city', 'asc')
                                ->where('state_id', $id_state)
                                ->where('status', true)->get();
            return response()->json([
                'success' => true,
                'message' => 'Ciudades obtenidas correctamente',
                'data' => $citys
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo obtener a los ciudades',
                'err' => $e
            ], 500);
        }
    }
}