<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User_Webfiltros;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registrarse(){
        return view('sesion.registrarse');
    }

    public function crear(RegisterRequest $request){
        if( $request->has('registrarse') ){
            $users_web = new User_Webfiltros;
            $users_web->name = $request->input('name');
            $users_web->email = $request->input('email');
            $users_web->password = Hash::make($request->input('password'));
            $users_web->genero = $request->input('genero');
            $users_web->pais = $request->input('pais');
            $users_web->estado = $request->input('estado');
            $users_web->direccion = $request->input('direccion');
            $users_web->telefono = $request->input('telefono');
            $users_web->fecha_nacimiento = $request->input('nacimiento');

            $users_web->save();
        }
        session(['registrado' => true]);
        return redirect()->route('iniciar_sesion');
    }
}
