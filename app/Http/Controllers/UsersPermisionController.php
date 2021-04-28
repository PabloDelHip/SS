<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\User_module;
use App\Modules;
use Exception;
use Illuminate\Validation\Rules\Exists;

class UsersPermisionController extends Controller
{
    public function getModules(Request $request){
        try{
            $modules = Modules::Select('id', 'name')->get();
            return response()->json([
                'success' => true,
                'message' => 'Modulos obtenidos correctamente',
                'data' => $modules
            ], 200);
        }
        catch (Exception $ex){
            return response()->json([
                'success' => false,
                'message' => 'No se pudo obtener los modulos',
                'err' => $e
            ], 500);
        }
    }

    public function permissionUserByModule(Request $request, $id, $name_module) {
        try {
            $modules = json_decode($this->getModules($request)->getContent())->data;
            $permissions = User_module::where('user_module.user_id', $id)->get();

            $moduleSelected = null;

            foreach ($modules as $module){
                if ($module->name == $name_module){
                    $moduleSelected = $module;
                    break;
                }
            }

            if ($moduleSelected == null){
                $modules = [];
            }
            else{
                $modules = [$moduleSelected];
            }

            foreach ($modules as $module){
                $addPermission = count($permissions) == 0;
                foreach ($permissions as $permission){
                    if ($permission->module_id == $module->id){
                        $addPermission = false;
                        $module->permission = $permission;
                        break;
                    }
                    $addPermission = true;
                }
                if ($addPermission){
                    $newPermission = new User_module();
                    $newPermission->user_id = +$id;
                    $newPermission->module_id = $module->id;
                    $newPermission->save();
                    $newPermission = User_module::find($newPermission->id);
                    $module->permission = $newPermission;
                }
            }

            if (count($modules) == 0){
                $modules = null;
            }
            else{
                $modules = $modules[0];
            }

            return response()->json([
                'success' => true,
                'message' => 'Permisos obtenidos correctamente',
                'data' => $modules
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo obtener los permisos',
                'data' => null,
                'err' => $e
            ], 500);
        }
    }

    public function permissionUsers(Request $request, $id) {
        try {
            $modules = json_decode($this->getModules($request)->getContent())->data;
            $permissions = User_module::where('user_module.user_id', $id)->get();

            foreach ($modules as $module){
                $addPermission = count($permissions) == 0;
                foreach ($permissions as $permission){
                    if ($permission->module_id == $module->id){
                        $addPermission = false;
                        $module->permission = $permission;
                        break;
                    }
                    $addPermission = true;
                }
                if ($addPermission){
                    $newPermission = new User_module();
                    $newPermission->user_id = +$id;
                    $newPermission->module_id = $module->id;
                    $newPermission->save();
                    $newPermission = User_module::find($newPermission->id);
                    $module->permission = $newPermission;
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Permisos obtenidos correctamente',
                'data' => $modules
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo obtener los permisos',
                'data' => null,
                'err' => $e
            ], 500);
        }
    }

    public function updatePermission(Request $request)
    {
        try {
            $module_id = $request->module_id;
            $user_id = $request->user_id;
            $column = $request->column;
            $value = $request->value;

            $module = User_module::where('user_id', '=', $user_id)
                ->where('module_id', '=', $module_id)
                ->update([$column => $value]);
            return response()->json([
                'success' => true,
                'message' => 'Los permisos se han actualizado correctamente',
                'data' => $module
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudieron actualizar los permisos',
                'err' => $e
            ], 500);
        }
    }
}
