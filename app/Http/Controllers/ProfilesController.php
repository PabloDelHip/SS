<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProfilesController extends Controller
{
    public function getProfiles(Request $request, $type)
    {
        try{
            $profiles = Profile::select('profiles.*')
                    ->join('contacts', 'profiles.contact_id', '=', 'contacts.id')
                    ->where('contacts.type', $type)
                    ->get();

            return response()->json([
            'success' => true,
            'message' => 'Perfiles encontrados',
            'data' => $profiles,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo obtener los perfiles',
                'data' => null,
                'err' => $e
            ], 500);
        }
    }

    public function getProfile($id)
    {
        $profile = Profile::find($id);

        if ($profile->image){
            $profile->image = Storage::disk('images-profile')->url($profile->image);
        }

        return response()->json([
            'success' => true,
            'message' => 'Perfil encontrado',
            'data' => $profile,
        ], 200);
    }

    public function getProfileByContactId($id)
    {
        $profile = Profile::where('contact_id', $id)->first();
        if ($profile->image){
            $profile->image = Storage::disk('images-profile')->url($profile->image);
        }

        return response()->json([
            'success' => true,
            'message' => 'Perfil encontrado',
            'data' => $profile,
        ], 200);
    }

    public function post(Request $request){
        $content = $request->all();

        $profile = new Profile();
        $profile->name = $content['name'];
        $profile->last_name = $content['last_name'];
        $profile->birth_date = $content['birth_date'];
        $profile->sex = $content['sex'];
        $profile->contact_id = $content['contact_id'];

        $profile->image = $this->saveFileBase64($content['picture'], $profile->image, 'profile', 'images-profile');

        $profile->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Perfil insertado',
            'data' => $profile,
        ], 200);
    }

    public function put(Request $request, $id){
        $profile = Profile::find($id);
        $content = $request->all();

        $profile->name = $content['name'];
        $profile->last_name = $content['last_name'];
        $profile->birth_date = $content['birth_date'];
        $profile->sex = $content['sex'];
        $profile->contact_id = $content['contact_id'];

        $profile->image = $this->saveFileBase64($content['picture'], $profile->image, 'profile', 'images-profile');

        $profile->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Perfil actualizado',
            'data' => $profile,
        ], 200);
    }

    public function saveFileBase64($fileBase64, $nameFile, string $prefixName, string $routeFile)
    {
        if ($fileBase64){
            $extension = explode('/', explode(':', substr($fileBase64, 0, strpos($fileBase64, ';')))[1])[1];
            $replace = substr($fileBase64, 0, strpos($fileBase64, ',')+1);
            
            $file = str_replace($replace, '', $fileBase64);
            $file = str_replace(' ', '+', $file);
            
            $fileName = $nameFile;
            if (!$fileName){
                $fileName = $prefixName."-".Str::random(20).'.'.$extension;
                $nameFile = $fileName;
            }
            $successFile = Storage::disk($routeFile)->put($fileName, base64_decode($file));
        }

        return $nameFile;
    }
}