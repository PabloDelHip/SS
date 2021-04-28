<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\MassAssignmentException;
use App\Vendor;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
  public function getList(){
    try {
      $vendors = Vendor::where('status', '=', true)->get();
      foreach ($vendors as $vendor) {
        $vendor->address = $vendor->address;
        $vendor->address->country = $vendor->address->country;
        $vendor->address->state = $vendor->address->state;
        $vendor->address->city = $vendor->address->city;
      }

      if(count($vendors))
      {
        return response()->json([
          'success' => true,
          'message' => 'Agencias Seleccionadas de forma correcta',
          'data' => $vendors
        ], 200);
      }

      return response()->json([
        'success' => true,
        'message' => 'No cuenta con agencias',
      ], 200); 
    } catch (MassAssignmentException $err) {
      return response()->json([
        'succes' => false,
        'message' => 'Error al obtener la agencia',
        'err' => $err->getMessage()
      ], 500);
    }
  }

  public function getVendor($id){
    try {
      $vendor = Vendor::where('id', $id)->where('status', '=', true)->get();

      if(count($vendor))
      {
        return response()->json([
          'success' => true,
          'message' => 'Agencias Seleccionadas de forma correcta',
          'data' => $vendor->first(),
        ], 200);   
      }

      return response()->json([
        'success' => false,
        'message' => 'La agencia seleccionada no existe',
      ], 200); 
    } catch (MassAssignmentException $err) {
      return response()->json([
        'succes' => false,
        'message' => 'Error al obtener agencias',
        'err' => $err->getMessage()
      ], 500);
    }
  }

  public function post(Request $request){
    try{
      $content = $request->all();

      $vendor = new Vendor();
      $vendor->code = $content['code'];
      $vendor->name = $content['name'];
      $vendor->business_name = $content['business_name'];
      $vendor->description = $content['description'];
      $vendor->web = $content['web'];
      $vendor->email = $content['email'];
      $vendor->address_id = $content['address_id'];
      $vendor->status = $content['status'];
      $vendor->phone = $content['phone'];
      $vendor->save();

      return response()->json([
        'success' => true,
        'message' => 'Agencia insertada',
        'data' => $vendor,
      ], 200);
    }
    catch (Exception $ex){
      return response()->json([
        'success' => true,
        'message' => 'Agencia insertada',
        'err' => $ex,
      ], 200);
    }
  }

  public function delete($id_vendor)
  {
    Vendor::where('id', $id_vendor)->update(['status' => false]);
    
    return response()->json([
      'succes' => true,
      'message' => 'Agencia eliminada de forma correcta',
      'data' => Vendor::where('id', $id_vendor)->get()->first()
    ], 200);
  }
}