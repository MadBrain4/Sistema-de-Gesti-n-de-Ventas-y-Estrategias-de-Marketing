<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LineaController extends Controller
{
    public function lineas_aceite(){
        return view('lineas.linea_aceite');
    }

    public function lineas_aire(){
        return view('lineas.linea_aire');
    }

    public function lineas_combustible(){
        return view('lineas.linea_combustible');
    }

    public function lineas_fluidos(){
        return view('lineas.linea_fluidos');
    }
}
