<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exception\TokenExpiredException;
use Tymon\JWTAuth\Exception\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Acceso;
use Illuminate\Support\Facades\Storage;

class AuthUserController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        /*$usuarios = Acceso::all();
        foreach ($usuarios as $usuario) {
            Acceso::where('idusuario', $usuario->idusuario)
                    ->update(['password' => bcrypt($usuario->password)]);
        }

        dd('Bien');*/
        $credentials = $request->only('email','password');
        
        $validator = Validator::make($credentials, [
            'email' => 'required',
            'password' => 'required'
        ]);

        //dd($credentials);
        
        if($validator->fails())
        {
           
            return response()->json([
                'succes' => false,
                'message' => 'Error en la validacion',
                'errors' => $validator->errors()
            ], 422);
        }

        $token = JWTAuth::attempt($credentials);
        
        if($token) {
            $user = Acceso::where('email', $credentials['email'])->get()->first();
            $user->profile = $user->profile;

            return response()->json([
                'succes' => true,
                'token' => $token,
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'succes' => false,
                'message' => 'Error en la validacion',
                'errors' => $validator->errors()
            ], 401);
        }

        /*return $this->respondWithToken($token); */
    }

    public function refreshToken(Request $request)
    {
        $token = JWTAuth::getToken();
        try {
            $token = JWTAuth::refresh($token);
            return response()->json([
                'succes' => true,
                'token' => $token,
            ], 200);
        } catch (TokenBlacklistedException $ex) {
            return response()->json([
                'succes' => false,
                'message' => 'No se pudo refrescar el token',
            ], 422);
        }
        catch (TokenExpiredException $ex) {
            return response()->json([
                'succes' => false,
                'message' => 'No se pudo refrescar el token (expirado)',
            ], 422);
        }
        catch(TokenInvalidException $ex) {
            return response()->json([
                'succes' => false,
                'message' => 'No se pudo refrescar el token (invalido)',
                'error' => $ex
            ], 422);
        }
    }

    public function logout()
    {
        $token = JWTAuth::getToken();

        try {
            jwTAuth::invalidate($token);

            return response()->json([
                'succes' => true,
                'message' => 'Token Invalidado'
            ], 200);
        } catch(JWTException $ex) {
            return response()->json([
                'succes' => true,
                'message' => 'Error al invalidar el Token'
            ], 422);
        }
    }

    public function me() {
        $token = JWTAuth::getToken();
        return $token;
    }
}
