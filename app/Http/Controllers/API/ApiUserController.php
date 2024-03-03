<?php
namespace App\Http\Controllers\API;

use App\User;
use App\Http\Controllers\Controller;

class ApiUserController extends Controller
{
    /**
     * Get the list of API of Usuario
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function getUserAPI () {
        $usuarios = User::orderBy('first_name', 'asc')->get()->toArray();
        return response()->json($usuarios);
    }
}
