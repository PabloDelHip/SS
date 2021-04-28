<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact_Vendor;
use DB;
use Illuminate\Database\Eloquent\MassAssignmentException;

class ContactsVendorsController extends Controller
{
  public function getContactsByVendorId($id)
  {
    try{
      $contacts = Contact_Vendor::select("profiles.*", DB::raw("users.id IS NOT NULL AS WithUser"))
                ->join('profiles', 'profiles.contact_id', '=', 'contacts_vendors.contact_id')
                ->leftjoin('users', 'users.contact_id', '=', 'contacts_vendors.contact_id')
                ->where('contacts_vendors.vendor_id', $id)->get();

      foreach ($contacts as $contact) {
        $contact->contact;
      }
      return response()->json([
          'success' => true,
          'message' => 'Contactos encontrados',
          'data' => $contacts,
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'No se pudo obtener los contactos',
        'data' => null,
        'err' => $e
      ], 500);
    }
  }

  public function post(Request $request)
  {
    $content = $request->all();

    $contactVendor = new Contact_Vendor();
    $contactVendor->contact_id = $content['contact_id'];
    $contactVendor->vendor_id = $content['vendor_id'];

    $contactVendor->save();
    
    return response()->json([
        'success' => true,
        'message' => 'Información insertada',
        'data' => $contactVendor,
    ], 200);
  }
}