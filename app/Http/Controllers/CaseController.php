<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Cases;

class CaseController extends Controller
{

    public function getCase($id_case) {
        try {
            $cases = Cases::where('id', $id_case)
                            ->with('vendor')
                            ->with('user.profile')->get()->first();
            if($cases) {
                return response()->json([
                    'succes' => true,
                    'message' => 'Caso seleccionado de forma correcta',
                    'data' => $cases
                ], 200);
            }
            else {
                return response()->json([
                    'succes' => false,
                    'message' => 'La consulta fue correcta pero no hay datos',
                ], 204);
            }
        } catch (MassAssignmentException $err) {
            return response()->json([
                'succes' => false,
                'message' => 'Error al guardar el caso',
                'err' => $err->getMessage()
            ], 500);
        }
    }

    public function updateOrCreateCase($id_case = 0, Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'case' => 'required',
                'vendor_id' => 'required|numeric',
                'user_id' => 'required|numeric'
    
            ]);
    
            if($validator->fails())
            {
                return response()->json([
                    'succes' => false,
                    'message' => 'Error en la validacion',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            $case = Cases::updateOrCreate(
                ['id' => $id_case],
                ['title' => $request->title,
                    'case' => $request->case,
                    'vendor_id' => $request->vendor_id,
                    'user_id' => $request->user_id
                ]
            );

            if($id_case == 0) {
                return response()->json([
                    'succes' => true,
                    'message' => 'Caso guardada de forma correcta',
                    'case' => $case
                ], 200);                
            }

            return response()->json([
                'succes' => true,
                'message' => 'Caso modificado de forma correcta',
                'case' => $case
            ], 201);

        } catch (MassAssignmentException $err) {
            return response()->json([
                'succes' => false,
                'message' => 'Error al guardar el caso',
                'err' => $err->getMessage()
            ], 500);
        }
    }

    public function getListVendor($id_vendor) {

        try {
            $cases = Cases::where('vendor_id', '=' ,$id_vendor)
                            ->with('user.contact')
                            ->with('user.profile')->get();

            return response()->json([
                'succes' => true,
                'message' => 'Casos encontrados de forma correcta',
                'cases' => $cases
            ], 200);

        } catch (MassAssignmentException $err) {
            return response()->json([
                'succes' => false,
                'message' => 'Error al obtener casos',
                'err' => $err->getMessage()
            ], 500);
        }
    }

    public function updateStatus($id, $status) {
        try {
            $status = $status === 'true' ? true: false;
            Cases::where('id', $id)
            ->update(['status' => $status]);
        
            return response()->json([
                'succes' => true,
                'message' => 'El status del caso fue actualizado',
                'contact' => Cases::where('id', $id)->with('user.contact')->with('user.profile')->get()->first()
            ], 200);
        } catch (MassAssignmentException $err) {
            return response()->json([
                'succes' => false,
                'message' => 'Error al editar el caso ',
                'err' => $err->getMessage()
            ], 500);
        }
    }
}
