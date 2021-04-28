<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Validator;
use App\Customer;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function updateOrCreateCustomer($id_customer = 0, Request $request)
    {   
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'numeric',
                'sex' => 'numeric|between:1,3'
    
            ]);
    
            if($validator->fails())
            {
                return response()->json([
                    'succes' => false,
                    'message' => 'Error en la validacion',
                    'errors' => $validator->errors()
                ], 422);
            }
            $birth_date = Carbon::parse($request->birth_date);
            $customer = Customer::updateOrCreate(
                ['id' => $id_customer],
                ['name' => $request->name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'birth_date' => $birth_date,
                    'sex' => $request->sex,
                    'additional_information' => $request->additional_information,
                    'country_id' => $request->country['id'],
                    'state_id' => $request->state['id'],
                    'city_id' => $request->city['id'],
                ]
            );
            return response()->json([
                'succes' => true,
                'message' => 'contacto guardada de forma correcta',
                'contacto' => $customer
            ], 200);
        } catch (MassAssignmentException $err) {
            return response()->json([
                'succes' => false,
                'message' => 'Error al guardar el contacto',
                'err' => $err->getMessage()
            ], 500);
        }
        
    }

    public function getListCustomer($id_provider) 
    {
        try {

            $customers = Customer::with('country')
                        ->with('state')
                        ->with('city')
                        ->where('status', '=', true)
                        ->orderBy('id', 'ASC')->get();
                        
            return response()->json([
                'succes' => true,
                'message' => 'contactos seleccionados de forma correcta',
                'contactos' => $customers
            ], 200);
            
        } catch (MassAssignmentException $err) {
            return response()->json([
                'succes' => false,
                'message' => 'Error al mostrar contactos',
                'err' => $err->getMessage()
            ], 500);
        }
        
    }

    public function getCustomer($id_customer) {
        try {
            $customers = Customer::where('id', $id_customer)->get()->first();
            
            if($customers) {
                $customers->city = $customers->city; 
                $customers->country = $customers->country; 
                $customers->state = $customers->state; 
                return response()->json([
                    'succes' => true,
                    'message' => 'contacto seleccionado de forma correcta',
                    'data' => $customers
                ], 200);
            }
            else {
                //echo 'sin contenido';
                return response()->json([
                    'succes' => false,
                    'message' => 'La consulta fue correcta pero no hay datos',
                ], 204);
            }
        } catch (MassAssignmentException $err) {
            return response()->json([
                'succes' => false,
                'message' => 'Error al mostrar contactos',
                'err' => $err->getMessage()
            ], 500);
        }
    }

    public function deleteCustomer($id_customer)
    {
        Customer::where('id', $id_customer)
            ->update(['status' => false]);
        
        return response()->json([
            'succes' => true,
            'message' => 'Contacto eliminado de forma correcta',
            'data' => Customer::where('id', $id_customer)->get()->first()
        ], 200);
    }
}
