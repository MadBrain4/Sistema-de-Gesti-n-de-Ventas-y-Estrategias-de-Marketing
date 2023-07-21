<?php

namespace App\Http\Controllers;

use App\Http\Requests\IniciarSesionRequest;
use App\Models\User_Webfiltros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function iniciar_sesion(){
        if( !session()->has('email_web') ){
            return view('sesion.iniciar');
        }
        else {
            return redirect()->route('index');
        }
    }

    public function ingresar_usuario(IniciarSesionRequest $request){
        $credentials = $request->getCredentials();

        $nombre = User_Webfiltros::select('name', 'password')
                                    ->where('email', $credentials['email'])
                                    ->get();

        if( count($nombre) > 0 ){
            if(Hash::check($request->password, $nombre[0]->password)){
                session(['email_web' => $credentials['email']]);
                session(['name_web' => $nombre[0]->name]);

                return redirect()->route('index');
            }
            else {
                session(['contraseña_equivocada' => true]);
                return redirect()->route('iniciar_sesion');
            }
        }
        else{
            session(['correo_equivocado' => true]);
            return redirect()->route('iniciar_sesion');
        }
    }

    public function cerrar_sesion(){
        session()->forget('email_web');
        session()->forget('carrito');
        session()->forget('id_carrito');
        session()->forget('lista');
        return redirect()->route('index');
    }
}
