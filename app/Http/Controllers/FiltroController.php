<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FiltroController extends Controller
{
    public function Filtro(Request $request){
        $codigo = $request->input('codigo');
        if( $request->has('codigoVehiculo') ){
            $codigoVehiculo = $request->input('codigoVehiculo');
            return view('filtro.filtro', compact('codigo', 'codigoVehiculo') );
        }
        else if( $request->has('cod') ){
            $cod = $request->input('cod');
            return view('filtro.filtro', compact('codigo', 'cod') );
        }
        else if( $request->has('esp') ){
            $esp = $request->input('esp');
            return view('filtro.filtro', compact('codigo', 'esp') );
        }
        else if( $request->has('carr') ){
            $carr = $request->input('carr');
            return view('filtro.filtro', compact('codigo', 'carr') );
        }
        else if( $request->has('des') ){
            $des = $request->input('des');
            return view('filtro.filtro', compact('codigo', 'des') );
        }
        return view('filtro.filtro', compact('codigo'));
    }
}
