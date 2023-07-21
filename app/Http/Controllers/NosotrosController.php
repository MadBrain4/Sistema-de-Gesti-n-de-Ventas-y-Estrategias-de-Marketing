<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NosotrosController extends Controller
{
    public function ayuda(){
        return view('nosotros.ayuda');
    }

    public function instrucciones_uso(){
        return view('nosotros.instrucciones');
    }

    public function noticias(){
        return view('nosotros.noticias');
    }
}
