<?php
namespace App\Http\Controllers\API;

use App\User;
use App\Permission;
use App\Role;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;


class ApiLoginController extends Controller
{
    /**
     * Get the list of API of Login
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            // Si la autenticación es exitosa, obtén el usuario autenticado
            $user = Auth::user();

            $rol = $user->roles->pluck('name');

            $role = Role::where('name', $rol)->first();

            $permisos = $role->permissions;

            return response()->json([
                'permisos' => $permisos,
                'rol' => $rol,
                'user' => $user, 
            ], 200);
        } else {
            return response()->json(['error' => 'No autorizado'], 401);
        }
    }
    
}
