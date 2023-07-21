<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;
use LengthException;

class JetFilterController extends Controller
{
    public function index(){
        return view("jetfilter.index");
    }

    public function gestion(){
        return view("jetfilter.gestion");
    }

    public function validar(LoginRequest $request){
        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)){
            $fallo = "true";
            return redirect()->route('jet-filter.gestion',compact('fallo'));
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);
        session()->put('user',$request->email);

        return $this->authenticated($request, $user);
    }

    public function authenticated(Request $request, $user){
        return redirect()->route('jet-filter.sesion');
    }

    public function sesion(){
        return view('jetfilter.sesion');
    }
}
