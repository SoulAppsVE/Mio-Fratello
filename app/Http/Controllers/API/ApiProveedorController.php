<?php
namespace App\Http\Controllers\API;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ApiProveedorController extends Controller
{
    /**
     * Get the list of API of Proveedor
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function getClientAPI () {

        $clientes = Client::select('id', 'first_name', 'last_name as ci', 'email','phone','address') 
        ->orderBy('first_name', 'asc')
        ->where('client_type', '!=', 'customer')
        ->get()
        ->toArray();

        return response()->json($clientes);

    }

    public function postClientAPI (Request $request) {

        $cliente = Client::create($request->all());

        return response()->json([
         'message' => "Proveedor creado con éxito",
         'cliente' => $cliente
        ],Response::HTTP_CREATED);

    }

    public function showClientAPI ($cliente) {

        $cliente = Client::find($cliente);

        return response()->json([
         'cliente' => $cliente
        ],Response::HTTP_CREATED);

    }

    public function updateClientAPI (Request $request, $cliente) {

        $cliente = Client::find($cliente);

        $cliente->update($request->all());
        return response()->json([
         'message' => "Proveedor actualizado con éxito",
         'cliente' => $cliente
        ],Response::HTTP_CREATED);

    }

    public function deleteClientAPI ($cliente) {

        $cliente = Client::find($cliente);

        if(($cliente->sells->count() == 0) && ($cliente->purchases->count() == 0)){

            $cliente->delete();
            return response()->json([
            'message' => "Proveedor eliminado con éxito",
            'cliente' => $cliente
            ],Response::HTTP_CREATED);

        } else {

            return response()->json([
            'message' => "Proveedor tiene compras hechas en la aplicación",
            ],Response::HTTP_CREATED);

        }    
    }
    
}
