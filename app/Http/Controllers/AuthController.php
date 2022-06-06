<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exception\TokenExpiredException;
use Tymon\JWTAuth\Exception\TokenblacklistedException;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }*/

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logiin(Request $request)
    {
        dd('Hola');
        /*$credentials = $request->only('email','password');
        
        $validator = Validator::make($credentials, [
            'email' => 'required',
            'password' => 'required'
        ]);

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
            return response()->json([
                'succes' => true,
                'token' => $token,
                'user' => User::where('idusuario', $credentials['email'])->get()->first()
            ], 200);
        } else {
            return response()->json([
                'succes' => false,
                'message' => 'Error en la validacion',
                'errors' => $validator->errors()
            ], 401);
        }*/

        /*return $this->respondWithToken($token); */
    }


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken(Request $request)
    {
        return 'refresate';
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
    }
}
