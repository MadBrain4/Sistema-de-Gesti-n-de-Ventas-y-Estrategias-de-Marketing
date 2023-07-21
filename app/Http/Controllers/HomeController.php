<?php

namespace App\Http\Controllers;

use App\Mail\ComentarioCliente;
use App\Models\AireAutomotriz;
use App\Models\AireIndustrial;
use App\Models\CombustibleLinea;
use App\Models\Distribuidora;
use App\Models\Elemento;
use App\Models\FiltroCodificacion;
use App\Models\Panel;
use App\Models\Sellado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(){
        return view("inicio");
    }

    public function distribuidores(){
        return view("distribuidores.distribuidores");
    }

    public function busqueda_distribuidores(Request $request){
        $est = ( $request->input('estado') != "" ) ? htmlspecialchars( $request->input('estado') ) : "Venezuela";
    
        $output = [];
        $output["distribuidoras"] = "";
        $output["cantidad"] = "";
        $output["titulo"] = "";

        $limit = 4;
        $page = ( $request->has('pagina') ) ? htmlspecialchars( ( $request->input('pagina') ) ) : 1;
        $inicio = $limit * ($page - 1);

        if( $est != "Venezuela"){
            $numFilasTotales = Distribuidora::where('pais', 'Venezuela')
                                ->where(function ($query) use ($est) {
                                    $query->where('estado', "=", $est);
                                    $query->orWhere('estado', "=", 'Nacional');
                                })->count();
        }
        else {
            $numFilasTotales = Distribuidora::where('pais', '=', 'Venezuela')
                                ->count();
        }

        if( $numFilasTotales == 0){
            $est = 'Venezuela';

            $numFilasTotales = Distribuidora::where('pais', '=', 'Venezuela')
                                ->count();
        }

        if( ( $numFilasTotales > 0 ) && ( $est == "Venezuela" ) ){
            $sql = "SELECT nombre, email, direccion, estado, ciudad, telefono, telefono2 FROM distribuidoras 
                                                    WHERE pais = 'Venezuela' 
                                                    LIMIT $inicio, $limit";
            $seleccionar_distribuidoras = DB::Table('distribuidoras')
                                            ->select('nombre', 'email', 'direccion', 'estado', 'ciudad', 'telefono', 'telefono2')
                                            ->where('pais', 'Venezuela')
                                            ->offset($inicio)
                                            ->take($limit)
                                            ->get();

            for($i = 0; $i < count($seleccionar_distribuidoras); $i++){
                $nombre = $seleccionar_distribuidoras[$i]->nombre;
                $telefono = $seleccionar_distribuidoras[$i]->telefono;
                $telefono2 = isset($seleccionar_distribuidoras[$i]->telefono2) ? $seleccionar_distribuidoras[$i]->telefono2 : 'No tiene';
                $direccion = $seleccionar_distribuidoras[$i]->direccion;
                $estado = $seleccionar_distribuidoras[$i]->estado;
                $ciudad = $seleccionar_distribuidoras[$i]->ciudad;
                $correo = $seleccionar_distribuidoras[$i]->email;

                $output['distribuidoras'] .= "<div>"; 
                $output['distribuidoras'] .= "<h2 class='n_nombre_distri' id='nombre_distribuidor'>$nombre</h2>";
                $output['distribuidoras'] .= "<p class='info_distri' id='telefono_distribuidor'><b>Teléfonos: </b> $telefono</p>";
                $output['distribuidoras'] .= "<p class='info_distri' id='telefono_distribuidor'><b>Teléfonos 2: </b> $telefono2</p>";
                $output['distribuidoras'] .= "<p class='info_distri' id='direccion_distribuidor'><b>Dirección: </b> $direccion</p>";
                if( $estado != 'Nacional'){
                    $output['distribuidoras'] .= "<p class='info_distri' id='ciudad_distribuidor'><b>Ciudad: </b> $ciudad</p>";
                }
                else {
                    $output['distribuidoras'] .= "<p class='info_distri' id='ciudad_distribuidor'><b>Cobertura Nacional </b> </p>";
                }
                $output['distribuidoras'] .= "<p class='info_distri' id='correo_distribuidor'><b>Correo: </b> $correo </p>"; 
                $output['distribuidoras'] .= "</div>";
                $output["titulo"] = "<h2>Distribuidores de $est</h2>";
            }
            $output['cantidad'] = "Vacio";
        }
        else if( ( $numFilasTotales > 0 ) && ( $est != "Venezuela" ) ){
            $seleccionar_distribuidoras = Distribuidora::select('nombre', 'email', 'direccion', 'ciudad', 'estado', 'telefono', 'telefono2')
                                            ->where('pais', 'Venezuela')
                                            ->where(function ($query) use ($est) {
                                                $query->where('estado', "=", $est);
                                                $query->orWhere('estado', "=", 'Nacional');
                                            })
                                            ->offset($inicio)
                                            ->take($limit)
                                            ->get();

            for($i = 0; $i < count($seleccionar_distribuidoras); $i++){
                $nombre = $seleccionar_distribuidoras[$i]->nombre;
                $telefono = $seleccionar_distribuidoras[$i]->telefono;
                $telefono2 = isset( $seleccionar_distribuidoras[$i]->telefono2 ) ? $seleccionar_distribuidoras[$i]->telefono2 : 'No tiene';
                $direccion = $seleccionar_distribuidoras[$i]->direccion;
                $estado = $seleccionar_distribuidoras[$i]->estado;
                $ciudad = $seleccionar_distribuidoras[$i]->ciudad;
                $correo = $seleccionar_distribuidoras[$i]->email;

                $output['distribuidoras'] .= "<div>"; 
                $output['distribuidoras'] .= "<h2 class='n_nombre_distri' id='nombre_distribuidor'>$nombre</h2>";
                $output['distribuidoras'] .= "<p class='info_distri' id='telefono_distribuidor'><b>Teléfonos: </b> $telefono</p>";
                $output['distribuidoras'] .= "<p class='info_distri' id='telefono_distribuidor'><b>Teléfonos 2: </b> $telefono2</p>";
                $output['distribuidoras'] .= "<p class='info_distri' id='direccion_distribuidor'><b>Dirección: </b> $direccion</p>";
                if( $estado != 'Nacional'){
                    $output['distribuidoras'] .= "<p class='info_distri' id='ciudad_distribuidor'><b>Ciudad: </b> $ciudad</p>";
                }
                else {
                    $output['distribuidoras'] .= "<p class='info_distri' id='ciudad_distribuidor'><b>Cobertura Nacional </b> </p>";
                }
                $output['distribuidoras'] .= "<p class='info_distri' id='correo_distribuidor'><b>Correo: </b> $correo</p>";
                $output['distribuidoras'] .= "</div>";
                $output["titulo"] = "<h2>Distribuidores de $est</h2>";
            }
        }

        $output['paginacion'] = "";

        $numeroInicio = 1;
        if($numFilasTotales > 0){
            $totalPaginas = ceil($numFilasTotales / $limit);

            if(($page - 4) > 1){
                $numeroInicio = $page - 3;
            }
            
            $numeroFinal = $numeroInicio + 7;
            
            if($numeroFinal > $totalPaginas){
                $numeroFinal = $totalPaginas;
            }

            $output['paginacion'] .= "";
            if($page != 1){
                $anterior = $page - 1;
                $output['paginacion'] .= "<a onclick='getData(1)'  style='cursor: pointer;'>  <<  </a>"; 
                $output['paginacion'] .= "<a onclick='getData($anterior)'  style='cursor: pointer;'>  <  </a>"; 
            }

            for($i = $numeroInicio; $i <= $numeroFinal; $i++){
                if($page == $i){
                    $output['paginacion'] .= "<p>" . $i ." </p>";
                }
            }
            if($page != $totalPaginas){
                $siguiente = $page  + 1;
                $output['paginacion'] .= "<a onclick='getData($siguiente)'  style='cursor: pointer;'>  >  </a>"; 
                $output['paginacion'] .= "<a onclick='getData($totalPaginas)'  style='cursor: pointer;'> >> </a>"; 
            }
        }

        return response()->json($output);
    }

    public function descargas(){
        return view("descargas.descargas");
    }

    public function documentos($catalogo){
        if( $catalogo == 'pasajero' || $catalogo == 'equivalencias' || $catalogo == 'especificaciones' || $catalogo == 'agricola' || $catalogo == 'comercial' ||  $catalogo == 'fuera_carretera' || $catalogo == 'completo' ){
            return view('descargas.documentos', compact('catalogo') );
        }
    }

    public function carrito_compras(Request $request){
        $FiltroCodificacion = FiltroCodificacion::findOrFail($request->input('id'));
        if( $request->has('cantidad') ){
            if( $request->input('cantidad') != '' && $request->input('cantidad') != null){
                $cantidad = $request->input('cantidad');
            }
            else {
                $cantidad = 1;
            }
        }
        else {
            $cantidad = 1;
        }

        if( !session()->has('carrito') || session()->get('carrito') == null ){
                $producto = array(
                    'ID' => $request->input('id'),
                    'codigo' => $FiltroCodificacion->codigo,
                    'cantidad' => $cantidad,
                    'precio' => $FiltroCodificacion->precio,
                );
                session()->push( 'carrito', $producto );
                session()->push( 'id_carrito', $request->input('id') );
                $a = 1;
        }
        else {
            if( in_array($request->input('id'), session()->get('id_carrito'), false ) != false ){
                $clave = array_search( $request->input('id'), session()->get('id_carrito'), false );
                $producto = array(
                    'ID' => session('carrito')[$clave]['ID'],
                    'codigo' => session('carrito')[$clave]['codigo'],
                    'cantidad' => session('carrito')[$clave]['cantidad'] + $cantidad,
                    'precio' => session('carrito')[$clave]['precio'],
                );
                $carrito_compras = session()->pull('carrito');
                $carrito_compras[$clave] = $producto;
                session()->put('carrito', $carrito_compras);
                $a = 2;
            }
            else {
                $producto = array(
                    'ID' => $request->input('id'),
                    'codigo' => $FiltroCodificacion->codigo,
                    'cantidad' => $cantidad,
                    'precio' => $FiltroCodificacion->precio,
                );
                session()->push( 'carrito', $producto );
                session()->push( 'id_carrito', $request->input('id') );
                $a = 3;
            }
        }
        session(['producto_agregado' => true]);
        return redirect()->back();
    }

    public function carrito(){
        $carrito = session('carrito');

        return view('carrito.carrito', compact('carrito') );
    }

    public function carrito_eliminar($id){
        $carrito_compras = session()->pull('carrito');
        $carrito_compras_id = session()->pull('id_carrito');
        $car = "a";
        foreach( $carrito_compras as $carrito ){
            if( $carrito['ID'] == $id ){
                $car = $carrito['codigo'];
            }
            else {
                session()->push( 'carrito', $carrito );
            }
        }
        foreach( $carrito_compras_id as $carrito_id ){
            if( $carrito_id == $id ){
                $car_id = $carrito_id;
            }
            else {
                session()->push( 'id_carrito', $carrito_id );
            }
        }
        
        session(['producto_eliminado' => true]);
        return redirect()->back();
    }

    public function lista_eliminar($id){
        $lista_compras = session()->pull('lista');
        $car = "a";
        foreach( $lista_compras as $lista ){
            if( $lista['ID'] == $id ){
                $car = $lista['codigo'];
            }
            else {
                session()->push( 'lista', $lista );
            }
        }
        
        session(['producto_eliminado' => true]);
        return redirect()->back();
    }

    public function deseos(Request $request){
        $id = $request->input('id');
        $filtro = FiltroCodificacion::find( $request->input('id') );
        $lista = session()->get('lista', []);

        if( isset( $lista[$id] ) ){
            
        }
        else {
            $lista[$id] = [
                'ID' => $id,
                'codigo' => $filtro->codigo,
                'precio' => $filtro->precio,
            ];
        }

        session()->put('lista', $lista);
        session(['producto_lista_agregado' => true]);
        return redirect()->back();
    }

    public function lista_deseos(){
        return view('carrito.lista_deseos');
    }

    public function enviar_correo(Request $request){
        $message = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'content' => 'required|min:3',
        ]);
        Mail::to('Josevld412@gmail.com')->queue(new ComentarioCliente($message));
        return redirect()->back();
    }
}
