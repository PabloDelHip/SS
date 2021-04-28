<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\User;
use Illuminate\Database\Eloquent\MassAssignmentException;

class ContactsController extends Controller
{
    public function getContact($id)
    {
        $contact = Contact::find($id);

        return response()->json([
            'success' => true,
            'message' => 'Contacto encontrado',
            'data' => $contact,
        ], 200);
    }

    public function post(Request $request){
        $content = $request->all();

        $contact = new Contact();
        $contact->type = $content['type'];
        $contact->rfc = $content['rfc'];
        $contact->type_person = $content['type_person'];
        $contact->emails = $content['emails'];
        $contact->moviles = $content['moviles'];
        $contact->phones = $content['phones'];
        $contact->address_id = $content['address_id'];

        $contact->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Contacto insertado',
            'data' => $contact,
        ], 200);
    }

    public function put(Request $request, $id){
        $contact = Contact::find($id);
        $content = $request->all();

        $contact->type = $content['type'];
        $contact->rfc = $content['rfc'];
        $contact->type_person = $content['type_person'];
        $contact->emails = $content['emails'];
        $contact->moviles = $content['moviles'];
        $contact->phones = $content['phones'];
        $contact->address_id = $content['address_id'];

        $contact->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Contacto actualizado',
            'data' => $contact,
        ], 200);
    }

    public function getListContactsVendor($id_vendor) {
        try {
            $contacts = User::where('vendor_id', '=' ,$id_vendor)
                            ->with('contact')
                            ->with('profile')->get();

            return response()->json([
                'succes' => true,
                'message' => 'Contactos encontrados de forma correcta',
                'contacts' => $contacts
            ], 200);

        } catch (MassAssignmentException $err) {
            return response()->json([
                'succes' => false,
                'message' => 'Error al obtener contactos',
                'err' => $err->getMessage()
            ], 500);
        }
    }

    public function putBlock($id, $status) {
        try {
            $status = $status === 'true' ? true: false;
            User::where('id', $id)
            ->update(['status' => $status]);
        
            return response()->json([
                'succes' => true,
                'message' => 'El status del contacto fue actualizado',
                'contact' => User::where('id', $id)->with('contact')->with('profile')->get()->first()
            ], 200);
        } catch (MassAssignmentException $err) {
            return response()->json([
                'succes' => false,
                'message' => 'Error al editar contacto ',
                'err' => $err->getMessage()
            ], 500);
        }
    }
}