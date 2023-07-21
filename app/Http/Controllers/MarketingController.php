<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function index(){
        return view ("marketing.index");
    }

    public function presupuesto(){
        return view ("marketing.presupuesto");
    }

    public function proyeccion(){
        return view ("marketing.proyeccion");
    }

    public function prueba(){
        return view ("marketing.prueba");
    }


}
