<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AplicacionTipo;

class BusquedaAplicacionController extends Controller
{
    public function index(){
        $tipo_aplicaciones = AplicacionTipo::select('id','aplicacion')
                                ->get();

        $paginas = ['10', '25', '50', '100'];

        return view('busquedaAplicacion.index', compact( 'tipo_aplicaciones', 'paginas' ) );
    }
}
