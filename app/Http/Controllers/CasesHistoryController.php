<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\CasesHistory;
use Carbon\Carbon;

class CasesHistoryController extends Controller
{
    public function updateOrCreateCase($id_case_history = 0, Request $request) {
        try {
            
            $validator = Validator::make($request->all(), [
                'information' => 'required',
                'status' => 'required',
                'case_id' => 'required|numeric',
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
            $status = $request->status === 'true' || true ? true: false;
            $case = CasesHistory::updateOrCreate(
                ['id' => $id_case_history],
                [
                    'information' => $request->information,
                    'status' => $status,
                    'case_id' => $request->case_id,
                    'user_id' => $request->user_id
                ]
            );

            if($id_case_history == 0) {
                return response()->json([
                    'succes' => true,
                    'message' => 'Historico de Caso guardado de forma correcta',
                    'case' => $case
                ], 200);                
            }

            return response()->json([
                'succes' => true,
                'message' => 'Historico de Caso modificado de forma correcta',
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

    public function getList($id_case) {
        try {
            $casesHistory = [];
            $caseDate = [];
            $acum = 0;
            $cases_history = CasesHistory::with('cases')
            ->with('user.profile')
            ->where('case_id', $id_case)
            ->where('status', true)
            ->orderBy('id', 'DESC')->get();
            foreach ($cases_history as $case_history) {
                $created_at = Carbon::parse($case_history->created_at)->format('Y/m/d');
                if(!isset($casesHistory[$created_at])) {
                    $casesHistory[$created_at]
                        [0] = $case_history;
                    $caseDate[$acum] = $created_at;
                    $acum++;
                }
                else {
                    $total_cases_history = count($casesHistory[$created_at]);
                    $casesHistory[$created_at]
                        [$total_cases_history] = $case_history;
                }
            }

            $acum = 0;
            $casesHistoryJson = [];
            foreach ($casesHistory as $caseHistory) {
                $casesHistoryJson[$acum]['created_at'] = Carbon::parse($caseHistory[0]['created_at'])->format('Y/m/d'); 
                $casesHistoryJson[$acum]['data'] = $caseHistory;
                $acum++;
            }

            return response()->json([
                'succes' => true,
                'message' => 'Historico de Caso encontrados de forma correcta',
                'case' => $casesHistoryJson
            ], 200);
        } catch (MassAssignmentException $err) {
            return response()->json([
                'succes' => false,
                'message' => 'Error al guardar el caso',
                'err' => $err->getMessage()
            ], 500);
        }
    }
}
