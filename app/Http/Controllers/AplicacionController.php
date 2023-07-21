<?php

namespace App\Http\Controllers;

use App\Models\AireAutomotriz;
use App\Models\AireIndustrial;
use App\Models\Aplicacion;
use App\Models\AplicacionVehiculo;
use App\Models\CombustibleLinea;
use App\Models\Elemento;
use App\Models\Equivalencia;
use App\Models\FiltroCodificacion;
use App\Models\Panel;
use App\Models\Sellado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AplicacionController extends Controller
{
    public function aplicaciones(Request $request){
        if( $request->has('aplic') && $request->has('marca') && $request->has('vehic') ){
            $aplic = $request->input('aplic');
            $marca = $request->input('marca');
            $vehic = $request->input('vehic');
            return view( 'busqueda_aplicaciones.aplicaciones', compact('aplic', 'marca', 'vehic') );
        }
        else if( $request->has('aplic') && $request->has('marca') ){
            $aplic = $request->input('aplic');
            $marca = $request->input('marca');
            return view( 'busqueda_aplicaciones.aplicaciones', compact('aplic', 'marca') );
        }
        else if( $request->has('aplic') ){
            $aplic = $request->input('aplic');
            return view( 'busqueda_aplicaciones.aplicaciones', compact('aplic') );
        }
        else {
            return view( 'busqueda_aplicaciones.aplicaciones' );
        }
    }

    public function aplicaciones_rapida ($aplicacion){
        return view( 'busqueda_aplicaciones.aplicaciones', compact('aplicacion') );
    }

    public function marca (Request $request){
        $id = $request->input('id_aplicacion');
        $cadena = '';
        if( $request->has('id_marca') ){
            $id_marca = $request->input('id_marca');

            $marcas = Aplicacion::from('aplicacion as a')
                        ->select( 'a.id_marca', 'a_m.marca' )
                        ->join('aplicacion_marca as a_m', 'a_m.id', '=', 'a.id_marca')
                        ->where('a.id_tipo', '=', $id)
                        ->whereNull("a.deleted_at")
                        ->whereNull('a_m.deleted_at')
                        ->groupBy('a.id_marca')
                        ->get();

            $cadena = "<option value='0' disabled>Seleccionar Marca</option>";
            foreach ( $marcas as $marca ) {
                if( $marca->id_marca == $id_marca ){
                    $cadena .= '<option value=';
                    $cadena .= $marca->id_marca;
                    $cadena .= ' selected>';
                    $cadena .= $marca->marca;
                    $cadena .= '</option>';
                }
                else {
                    $cadena .= '<option value=';
                    $cadena .= $marca->id_marca;
                    $cadena .= '>';
                    $cadena .= $marca->marca;
                    $cadena .= '</option>';
                }
            } 

        }
        else{

            $marcas = Aplicacion::from('aplicacion as a')
                        ->select('a.id_marca', 'a_m.marca' )
                        ->join('aplicacion_marca as a_m', 'a_m.id', '=', 'a.id_marca')
                        ->where('a.id_tipo', '=', $id)
                        ->whereNull("a.deleted_at")
                        ->whereNull('a_m.deleted_at')
                        ->groupBy('a.id_marca')
                        ->get();

            $cadena = "<option value='0' disabled selected>Seleccionar Marca</option>";

            foreach ( $marcas as $marca) {
                $cadena .= '<option value=';
                $cadena .= $marca->id_marca;
                $cadena .= '>';
                $cadena .= $marca->marca;
                $cadena .=  '</option>';
            } 
        }

        return response()->json($cadena);
    }

    public function tabla(Request $request){
        $id_marca = $request->input('id_marca');
        $id_tipo = $request->input('id_aplicacion');

        $page = $request->has('pagina') ? $request->input('pagina') : 1;
        $limit = $request->has('registros') ? $request->input('registros') : 10;
        $inicio = $limit * ($page - 1);
        
        if ( $request->has('campo') && $request->input('campo') != null && $request->input('campo') != '' ) {
            $campo = $request->input('campo');
            $campo = '%' . $campo . '%';
            $cantidad_filtrado = Aplicacion::from('aplicacion as a')
                            ->join('aplicacion_vehiculo as a_v', 'a_v.id', '=', 'a.id_vehiculo')
                            ->distinct('a.id_vehiculo', 'a_v.modelo', 'a_v.cilindrada', 'a_v.ano')
                            ->where('a.id_marca', '=', $id_marca)
                            ->where('a.id_tipo', '=', $id_tipo)
                            ->whereNull('a.deleted_at')
                            ->whereNull('a_v.deleted_at')
                            ->where(function ($query) use ($campo) {
                                $query->where('a_v.modelo', 'LIKE', $campo)
                                      ->orWhere('a_v.cilindrada', 'LIKE', $campo)
                                      ->orWhere('a_v.ano', 'LIKE', $campo);
                            })
                            ->count();
                            
            $seleccionado = Aplicacion::from( 'aplicacion as a' )
                            ->select('a.id_vehiculo as id_vehiculo', 'a_v.modelo as modelo', 'a_v.cilindrada as cilindrada', 'a_v.ano as ano')
                            ->distinct()
                            ->join('aplicacion_vehiculo as a_v', 'a_v.id', '=', 'a.id_vehiculo')
                            ->where('a.id_marca', '=', $id_marca)
                            ->where('a.id_tipo', '=', $id_tipo)
                            ->whereNull('a.deleted_at')
                            ->whereNull('a_v.deleted_at')
                            ->where(function ($query) use ($campo) {
                                $query->where('a_v.modelo', 'LIKE', $campo)
                                      ->orWhere('a_v.cilindrada', 'LIKE', $campo)
                                      ->orWhere('a_v.ano', 'LIKE', $campo);
                            })
                            ->groupBy('a.id_vehiculo', 'a_v.modelo', 'a_v.cilindrada', 'a_v.ano')
                            ->orderBy('a_v.modelo')
                            ->offset($inicio)
                            ->take($limit)
                            ->get(); 
            
        }
        else {
            $cantidad_filtrado = Aplicacion::from('aplicacion as a')
                            ->join('aplicacion_vehiculo as a_v', 'a_v.id', '=', 'a.id_vehiculo')
                            ->distinct('a.id_vehiculo', 'a_v.modelo', 'a_v.cilindrada', 'a_v.ano')
                            ->where('a.id_marca', '=', $id_marca)
                            ->where('a.id_tipo', '=', $id_tipo)
                            ->whereNull('a.deleted_at')
                            ->whereNull('a_v.deleted_at')
                            ->count();

            $seleccionado = Aplicacion::from( 'aplicacion as a' )
                            ->select('a.id_vehiculo as id_vehiculo', 'a_v.modelo as modelo', 'a_v.cilindrada as cilindrada', 'a_v.ano as ano')
                            ->distinct()
                            ->join('aplicacion_vehiculo as a_v', 'a_v.id', '=', 'a.id_vehiculo')
                            ->where('a.id_marca', '=', $id_marca)
                            ->where('a.id_tipo', '=', $id_tipo)
                            ->where('a.id_tipo', '=', $id_tipo)
                            ->whereNull('a.deleted_at')
                            ->whereNull('a_v.deleted_at')
                            ->groupBy('a.id_vehiculo', 'a_v.modelo', 'a_v.cilindrada', 'a_v.ano')
                            ->orderBy('a_v.modelo')
                            ->offset($inicio)
                            ->take($limit)
                            ->get();                
        }

        $cantidad_total = Aplicacion::from( 'aplicacion as a' )
                            ->join('aplicacion_vehiculo as a_v', 'a_v.id', '=', 'a.id_vehiculo')
                            ->where('a.id_marca', '=', $id_marca)
                            ->where('a.id_tipo', '=', $id_tipo)
                            ->whereNull('a.deleted_at')
                            ->whereNull('a_v.deleted_at')
                            ->distinct('a.id_vehiculo', 'a_v.modelo', 'a_v.cilindrada', 'a_v.ano')
                            ->count();

        $output['totalRegistros'] = $cantidad_total;
        $output['totalFiltro'] = $cantidad_filtrado;
        $output['datos'] = "";
        $output['paginacion'] = "";   

        foreach($seleccionado as $selec){
            $id_vehiculo = $selec->id_vehiculo;

            $output['datos'] .= '<tr>';
            $output['datos'] .= "<td class='busqueda_apli'><a href='/aplicaciones?aplic=$id_tipo&marca=$id_marca&vehic=$id_vehiculo' class='link a'>" . $selec->modelo . "</a></td>";
            $output['datos'] .= '<td class="busqueda_apli">' . $selec->cilindrada . '</td>';
            $output['datos'] .= '<td class="busqueda_apli">' . $selec->ano . '</td>';
            $output['datos'] .= '</tr>';
        }

        $numeroInicio = 1;
        if( $output['totalFiltro'] > 0 ){
            $totalPaginas = ceil($output['totalFiltro'] / $limit);

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


        if( $request->has('regreso') ){
            $output['tipo'] = $id_tipo;
            $output['marca'] = $id_marca;
        }

        return response()->json($output);
    }

    public function vehiculo(Request $request){
        $id_tipo = $request->input('id_aplicacion');
        $id_vehiculo = $request->input('id_vehiculo');
        $id_marca = $request->input('id_marca');
        $cadena = "";

        $vehiculo_seleccionado = AplicacionVehiculo::select('modelo', 'motor', 'ano', 'cilindrada')
                                    ->where('id', '=', $id_vehiculo)
                                    ->whereNull('deleted_at')
                                    ->get();

        $modelo = $vehiculo_seleccionado[0]->modelo;
        $motor = $vehiculo_seleccionado[0]->motor;
        $año = $vehiculo_seleccionado[0]->ano;
        $cilindrada = $vehiculo_seleccionado[0]->cilindrada;

        $cadena .= '<table class="vehiculo_seleccionado">';
        $cadena .= '<thead class="equivalencias">';
        $cadena .= '<tr>';
        $cadena .= '<td class="equivalencias tilt_blanco" colspan="2">Vehículo</td>';
        $cadena .= '</tr>';
        $cadena .= '</thead>';
        $cadena .= '<tbody>';
        $cadena .= '<tr>';
        $cadena .= '<td>Modelo:</td>';
        $cadena .= "<td>$modelo</td>";
        $cadena .= '</tr>';
        $cadena .= '<tr>';
        $cadena .= '<td>Motor:</td>';
        $cadena .= "<td>$motor</td>";
        $cadena .= '</tr>';
        $cadena .= '<tr>';
        $cadena .= '<td>Año:</td>';
        $cadena .= "<td>$año</td>";
        $cadena .= '</tr>';
        $cadena .= '<tr class="cilindrada">';
        $cadena .= '<td>Cilindros:</td>';
        $cadena .= "<td>$cilindrada</td>";
        $cadena .= '</tr>';
        $cadena .= "</tbody></table><table class='vehiculo_seleccionado'>";
        $cadena .= "<thead><tr><td class='codigos tilt_blanco' colspan='2'>Filtros</td></tr></thead>";

        $aplicacion_vehiculo = Aplicacion::where('id_tipo', '=', $id_tipo)
                                    ->where('id_marca', '=', $id_marca)
                                    ->where('id_vehiculo', '=', $id_vehiculo)
                                    ->whereNull('deleted_at')
                                    ->get();
        
        foreach( $aplicacion_vehiculo as $apl_veh ){
            $codigo = $apl_veh->codigo;
            $id = $apl_veh->id;
            $clase = $apl_veh->filtro->clase->clase;
            if( $clase == 'Aire Automotriz' ){
                $clase = 'aireautomotriz';
            }
            else if( $clase == 'Aire Industrial' ){
                $clase = 'aireindustrial';
            }
            else if( $clase == 'Combustible en Linea' ){
                $clase = 'combustiblelinea';
            }
            else if( $clase == 'Elemento' ){
                $clase = 'elemento';
            }
            else if( $clase == 'Panel' ){
                $clase = 'panel';
            }
            else if( $clase == 'Sellado' ){
                $clase = 'sellado';
            }

            $cadena .= "<tr>";
            $cadena .= "<td>" . $apl_veh->aplicacion . ":</td>";
            $cadena .= "<td><a href='/filtro?codigo=$codigo&clase=$clase&codigoVehiculo=$id' class='link a'>" . $codigo . "</a></td>";
            $cadena .= "</tr>";
        }                     
        $cadena = $cadena . '</table>';  

        return response()->json($cadena);
    }

    public function filtro(Request $request){
        $codigo = $request->input('codigo');
        $output = [];
        $output['especificaciones'] = '';
        $output['titulo'] = '';
        $output['carrusel'] = '';
        $existencia = true;

        $filtro = FiltroCodificacion::select('id', 'id_clase')
                        ->where('codigo', '=', $codigo)
                        ->whereNull('deleted_at')
                        ->get();
        $id = $filtro[0]->id;
        if( $filtro[0]->clase->clase == 'Aire Automotriz'){
            $filtro_seleccionado = AireAutomotriz::where('codigo', '=', $codigo)
                        ->whereNull('deleted_at')
                        ->get();

            $output['titulo'] = "<h3 class='titulo_detalle'>Filtro de Aire Automotriz</h3>";
        
            if( count($filtro_seleccionado) > 0){
                $output['especificaciones'] = $this->plantillaFiltro($filtro_seleccionado, $codigo, 'aireautomotriz');
            
                $imagen = $filtro_seleccionado[0]->imagen;
                $imagen1 = $filtro_seleccionado[0]->imagen1;
                $imagen2 = $filtro_seleccionado[0]->imagen2;

                $img1 = "/images/fichas-filtros/web/$imagen.jpg";
                $img2 = "/images/fichas-filtros/web/$imagen1.jpg";
                $img3 = "/images/fichas-filtros/web/$imagen2.jpg";

                $num_imagenes = 0;
                $num_imagenes = file_exists (public_path() . $img1) ? $num_imagenes + 1 : $num_imagenes; 
                $num_imagenes = file_exists (public_path() . $img2) ? $num_imagenes + 1 : $num_imagenes; 
                $num_imagenes = file_exists (public_path() . $img3) ? $num_imagenes + 1 : $num_imagenes; 
            }
        }
        else if( $filtro[0]->clase->clase == 'Aire Industrial' ){
            $filtro_seleccionado = AireIndustrial::where('codigo', '=', $codigo)
                        ->whereNull('deleted_at')
                        ->get();

            $output['titulo'] = "<h3 class='titulo_detalle'>Filtro de Aire Industrial</h3>";
            if( count($filtro_seleccionado) > 0){
                $output['especificaciones'] = $this->plantillaFiltro($filtro_seleccionado, $codigo, 'aireindustrial');
            
                $imagen = $filtro_seleccionado[0]->imagen;
                $imagen1 = $filtro_seleccionado[0]->imagen1;
                $imagen2 = $filtro_seleccionado[0]->imagen2;

                $img1 = "/images/fichas-filtros/web/$imagen.jpg";
                $img2 = "/images/fichas-filtros/web/$imagen1.jpg";
                $img3 = "/images/fichas-filtros/web/$imagen2.jpg";

                $num_imagenes = 0;
                $num_imagenes = file_exists (public_path() . $img1) ? $num_imagenes + 1 : $num_imagenes; 
                $num_imagenes = file_exists (public_path() . $img2) ? $num_imagenes + 1 : $num_imagenes; 
                $num_imagenes = file_exists (public_path() . $img3) ? $num_imagenes + 1 : $num_imagenes; 
            }
            else {
                $output['especificaciones'] = "<table class='vehiculo_detalles_seleccionado'>";
                $output['especificaciones'] .= '<tr>';
                $output['especificaciones'] .= '<td>Sin resultados</td>';
                $output['especificaciones'] .= '</tr>';
                $output['especificaciones'] .= '</table>';
                $num_imagenes = 0;
                $existencia = false;
            }

        }
        else if( $filtro[0]->clase->clase == 'Combustible en Linea' ){
            $filtro_seleccionado = CombustibleLinea::where('codigo', '=', $codigo)
                        ->whereNull('deleted_at')
                        ->get();

            $output['titulo'] = "<h3 class='titulo_detalle'>Filtro de Combustible en Linea</h3>";
        
            if( count($filtro_seleccionado) > 0){
                $output['especificaciones'] = $this->plantillaFiltro($filtro_seleccionado, $codigo, 'combustiblelinea');
            
                $imagen = $filtro_seleccionado[0]->imagen;
                $imagen1 = $filtro_seleccionado[0]->imagen1;
                $imagen2 = $filtro_seleccionado[0]->imagen2;

                $img1 = "/images/fichas-filtros/web/$imagen.jpg";
                $img2 = "/images/fichas-filtros/web/$imagen1.jpg";
                $img3 = "/images/fichas-filtros/web/$imagen2.jpg";

                $num_imagenes = 0;
                $num_imagenes = file_exists (public_path() . $img1) ? $num_imagenes + 1 : $num_imagenes; 
                $num_imagenes = file_exists (public_path() . $img2) ? $num_imagenes + 1 : $num_imagenes; 
                $num_imagenes = file_exists (public_path() . $img3) ? $num_imagenes + 1 : $num_imagenes; 
            }
            else {
                $output['especificaciones'] = "<table class='vehiculo_detalles_seleccionado'>";
                $output['especificaciones'] .= '<tr>';
                $output['especificaciones'] .= '<td>Sin resultados</td>';
                $output['especificaciones'] .= '</tr>';
                $output['especificaciones'] .= '</table>';
                $num_imagenes = 0;
                $existencia = false;
            }

        }
        else if( $filtro[0]->clase->clase == 'Elemento' ){
            $filtro_seleccionado = Elemento::where('codigo', '=', $codigo)
                        ->whereNull('deleted_at')
                        ->get();

            $output['titulo'] = "<h3 class='titulo_detalle'>Filtro de Elemento</h3>";
        
            if( count($filtro_seleccionado) > 0){
                $output['especificaciones'] = $this->plantillaFiltro($filtro_seleccionado, $codigo, 'elemento');
            
                $imagen = $filtro_seleccionado[0]->imagen;
                $imagen1 = $filtro_seleccionado[0]->imagen1;
                $imagen2 = $filtro_seleccionado[0]->imagen2;

                $img1 = "/images/fichas-filtros/web/$imagen.jpg";
                $img2 = "/images/fichas-filtros/web/$imagen1.jpg";
                $img3 = "/images/fichas-filtros/web/$imagen2.jpg";

                $num_imagenes = 0;
                $num_imagenes = file_exists (public_path() . $img1) ? $num_imagenes + 1 : $num_imagenes; 
                $num_imagenes = file_exists (public_path() . $img2) ? $num_imagenes + 1 : $num_imagenes; 
                $num_imagenes = file_exists (public_path() . $img3) ? $num_imagenes + 1 : $num_imagenes; 
            }
            else {
                $output['especificaciones'] = "<table class='vehiculo_detalles_seleccionado'>";
                $output['especificaciones'] .= '<tr>';
                $output['especificaciones'] .= '<td>Sin resultados</td>';
                $output['especificaciones'] .= '</tr>';
                $output['especificaciones'] .= '</table>';
                $num_imagenes = 0;
                $existencia = false;
            }
        }
        else if( $filtro[0]->clase->clase == 'Panel' ){
            $filtro_seleccionado = Panel::where('codigo', '=', $codigo)
                        ->whereNull('deleted_at')
                        ->get();

            $output['titulo'] = "<h3 class='titulo_detalle'>Filtro de Panel</h3>";
        
            if( count($filtro_seleccionado) > 0){
                $output['especificaciones'] = $this->plantillaFiltro($filtro_seleccionado, $codigo, 'panel');
            
                $imagen = $filtro_seleccionado[0]->imagen;
                $imagen1 = $filtro_seleccionado[0]->imagen1;
                $imagen2 = $filtro_seleccionado[0]->imagen2;

                $img1 = "/images/fichas-filtros/web/$imagen.jpg";
                $img2 = "/images/fichas-filtros/web/$imagen1.jpg";
                $img3 = "/images/fichas-filtros/web/$imagen2.jpg";

                $num_imagenes = 0;
                $num_imagenes = file_exists (public_path() . $img1) ? $num_imagenes + 1 : $num_imagenes; 
                $num_imagenes = file_exists (public_path() . $img2) ? $num_imagenes + 1 : $num_imagenes; 
                $num_imagenes = file_exists ( public_path() .$img3) ? $num_imagenes + 1 : $num_imagenes; 
            }
            else {
                $output['especificaciones'] = "<table class='vehiculo_detalles_seleccionado'>";
                $output['especificaciones'] .= '<tr>';
                $output['especificaciones'] .= '<td>Sin resultados</td>';
                $output['especificaciones'] .= '</tr>';
                $output['especificaciones'] .= '</table>';
                $num_imagenes = 0;
                $existencia = false;
            }
        }
        else if( $filtro[0]->clase->clase == 'Sellado' ){
            $filtro_seleccionado = Sellado::where('codigo', '=', $codigo)
                        ->whereNull('deleted_at')
                        ->get();
            $output['titulo'] = "<h3 class='titulo_detalle'>Filtro de Sellado</h3>";
            if( count($filtro_seleccionado) > 0){
                $output['especificaciones'] = $this->plantillaFiltro($filtro_seleccionado, $codigo, 'sellado');
                
                $imagen = $filtro_seleccionado[0]->imagen;
                $imagen1 = $filtro_seleccionado[0]->imagen1;
                $imagen2 = $filtro_seleccionado[0]->imagen2;

                $img1 = "/images/fichas-filtros/web/$imagen.jpg";
                $img2 = "/images/fichas-filtros/web/$imagen1.jpg";
                $img3 = "/images/fichas-filtros/web/$imagen2.jpg";

                $num_imagenes = 0;
                $num_imagenes = file_exists (public_path() . $img1) ? $num_imagenes + 1 : $num_imagenes; 
                $num_imagenes = file_exists (public_path() . $img2) ? $num_imagenes + 1 : $num_imagenes; 
                $num_imagenes = file_exists (public_path() . $img3) ? $num_imagenes + 1 : $num_imagenes;
            }
            else {
                $output['especificaciones'] = "<table class='vehiculo_detalles_seleccionado'>";
                $output['especificaciones'] .= '<tr>';
                $output['especificaciones'] .= '<td>Sin resultados</td>';
                $output['especificaciones'] .= '</tr>';
                $output['especificaciones'] .= '</table>';
                $num_imagenes = 0;
                $existencia = false;
            }
        }  
        
        $output['carrusel'] .= "<div class='container-all'>";  

        if( $existencia != false){
            if($num_imagenes > 1){
                if( file_exists( public_path() . $img1 )){
                    $output['carrusel'] .= "<input type='radio' id='1' name='image-slide' hidden/>";
                }
                if( file_exists( public_path() . $img2 )){
                    $output['carrusel'] .= "<input type='radio' id='2' name='image-slide' hidden/>"; 
                }
                if( file_exists( public_path() . $img3 )){
                    $output['carrusel'] .= "<input type='radio' id='3' name='image-slide' hidden/>";
                }
            }

    
            if($num_imagenes > 1){
                $output['carrusel'] .= "<div class='slide'>";
            }
                
                if( file_exists (public_path() . $img1)){
                    $output['carrusel'] .= "<div class='item-slide'>
                                <img src='$img1' alt='' class='imagen' data='$img1' >
                            </div>";
                }
                if( file_exists (public_path() . $img2)){
                    $output['carrusel'] .= "<div class='item-slide'>
                                <img src='$img2' alt='' class='imagen' data='$img2' >
                            </div>";
                }
                if( file_exists (public_path() . $img3)){
                $output['carrusel'] .= "<div class='item-slide'>
                                <img src='$img3' alt='' class='imagen' data='$img3' >
                            </div>";
                }
                if( $num_imagenes == 0 ){
                    $output['carrusel'] .= "<div class='item-slide'>
                            <img src='/images/fichas-filtros/web/no-img.jpg' alt='' class='imagen' data='/images/fichas-filtros/web/no-img.jpg' width='300' height='300' >
                        </div>";
                }

            if($num_imagenes > 1){
                $output['carrusel'] .= "</div>";
            }

            $i = 1;
            if($num_imagenes > 1){
                $output['carrusel'] .= "<div class='pagination'>";
                if( file_exists (public_path() . $img1)){
                    $output['carrusel'] .= "
                        <label class='pagination-item' for='1'>
                            <img src='$img1' >
                        </label>";
                    $i++;
                }
                if( file_exists ( public_path() . $img2)){   
                $output['carrusel'] .= "<label class='pagination-item' for='2'>
                        <img src='$img2' >
                    </label>";
                    $i++;
                }
                if( file_exists (public_path() . $img3)){
                $output['carrusel'] .= "<label class='pagination-item' for='3'>
                        <img src='$img3' >
                    </label>";
                    $i++;
                }
                $output['carrusel'] .= "</div>";
            }

            $output['carrusel'] .= "</div>";
        } 
        else {
            if( $num_imagenes == 0 ){
                $output['carrusel'] .= "<div class='item-slide'>
                            <img src='/images/fichas-filtros/web/no-img.jpg' alt='' class='imagen' data='/images/fichas-filtros/web/no-img.jpg' width='300' height='300' >
                        </div>";
            }
            $output['carrusel'] .= "</div>";
        }

        if( $request->has('codigoVehiculo') && $request->input('codigoVehiculo') != null ){
            $aplicacion = Aplicacion::select('id_tipo', 'id_marca', 'id_vehiculo')
                                    ->find($request->input('codigoVehiculo'));
            $idTipo = $aplicacion->id_tipo;
            $idMarca = $aplicacion->id_marca;
            $idVehiculo = $aplicacion->id_vehiculo;

            $output['carrusel'] .= "<a href='/aplicaciones?aplic=$idTipo&marca=$idMarca&vehic=$idVehiculo' ><img src='/img/tipo/bt_volver.png' alt='' class='bt_busq'></a>";
        }
        else if( $request->has('buscarCodigo') ){
            $output['carrusel'] .= "<a href='/codigo' ><img src='/img/tipo/bt_volver.png' alt='' class='bt_busq'></a>";
        }
        else if( $request->has('buscarEspecificacion') ){
            $output['carrusel'] .= "<a href='/especificaciones' ><img src='/img/tipo/bt_volver.png' alt='' class='bt_busq'></a>";
        }
        else if( $request->has('carr') ){
            $output['carrusel'] .= "<a href='/carrito' ><img src='/img/tipo/bt_volver.png' alt='' class='bt_busq'></a>";
        }
        else if( $request->has('des') ){
            $output['carrusel'] .= "<a href='/lista_deseos' ><img src='/img/tipo/bt_volver.png' alt='' class='bt_busq'></a>";
        }
        
        if( session()->has('email_web') ){
            $output['compras'] = "<div style='display: flex' >";
            $output['compras'] .= "<div class='fila1'>";
            $output['compras'] .= "<form action='/compras' method='POST'>
                    <input type='hidden' value='$id' name='id' />
                    <div class='fila2' >
                        <input type='submit' value='Comprar' class='comprate' />
                        <input placeholder='Seleccione Cantidad' type='number' name='cantidad' />
                    </div>
                    </form>";
            $output['compras'] .= "</div>";
            $output['compras'] .= "<form action='/deseos' method='POST'>
                    <input type='hidden' value='$id' name='id' />
                    <input src='/img/icono/lista-de-deseos.png' type='image' class='compras' />
                    </form>";
            $output['compras'] .= "</div>";
        }
        else {
            $output['compras'] = '';
            $output['compras'] .= "<a href='/iniciar_sesion'><img src='/img/icono/carrito_compras.png' class='compras' /></a>";
            $output['compras'] .= "<a href='/iniciar_sesion'><img src='/img/icono/lista-de-deseos.png' class='compras'></a>";
        }

        $filtro_aplicacion = Aplicacion::from('aplicacion as a')
                                ->select('a_t.aplicacion', 'a_m.marca', 'a_v.modelo', 'a.id_tipo', 'a.id_marca', 'a.id_vehiculo')
                                ->join('aplicacion_tipo as a_t', 'a.id_tipo', '=', 'a_t.id')
                                ->join('aplicacion_marca as a_m', 'a.id_marca', '=', 'a_m.id')
                                ->join('aplicacion_vehiculo as a_v', 'a.id_vehiculo', '=', 'a_v.id')
                                ->orderBy('a.id_tipo')
                                ->orderBy('a_m.marca')
                                ->orderBy('a_v.modelo')
                                ->where('codigo', '=', $codigo)
                                ->whereNull('a_m.deleted_at')
                                ->whereNull('a_v.deleted_at')
                                ->whereNull('a_t.deleted_at')
                                ->whereNull('a.deleted_at')
                                ->get();

        $aplicacion = "";
        $aplicacion_marca = "";
        $output['aplicacion'] = "";
        $output['aplicacion'] .= "<table class='apli'>";
        $output['aplicacion'] .= "<thead class='apli'>"; 
        $output['aplicacion'] .= "<tr>"; 
        $output['aplicacion'] .= "<td class='tilt_blanco'><b>Aplicaciones</b></td>";
        $output['aplicacion'] .= "<td></td>";
        $output['aplicacion'] .= "<td></td>";
        $output['aplicacion'] .= "</tr>"; 
        $output['aplicacion'] .= "</thead>"; 
        $output['aplicacion'] .= "<tbody>";
        $output['aplicacion'] .= "<tr>"; 
        $output['aplicacion'] .= "<td style='background-color: #D8D8D8;' ><b>Tipo</b></td>";
        $output['aplicacion'] .= "<td style='background-color: #D8D8D8;'><b>Marca</b></td>";
        $output['aplicacion'] .= "<td style='background-color: #D8D8D8;'><b>Modelo</b></td>";
        $output['aplicacion'] .= "</tr>"; 

        foreach( $filtro_aplicacion as $fil_apl ){
            $aplicacion_colocar = $fil_apl->aplicacion;
            $aplicacion_colocar_marca = $fil_apl->marca;
            $aplicacion_vehiculo = $fil_apl->modelo;

            $id_tipo = $fil_apl->id_tipo;
            $id_marca = $fil_apl->id_marca;
            $id_vehiculo = $fil_apl->id_vehiculo;

            $output['aplicacion'] .= "<tr>"; 

            if($aplicacion != $fil_apl->aplicacion){
                $output['aplicacion'] .= "<td class='apli'><b>$aplicacion_colocar</b></td>";
            }
            else {
                $output['aplicacion'] .= "<td class='apli'></td>";
            }
            if($aplicacion_marca != $fil_apl->marca){
                $output['aplicacion'] .= "<td class='apli'><a href='/aplicaciones?aplic=$id_tipo&marca=$id_marca' class='link a'>".$aplicacion_colocar_marca."</a></td>";
            }
            else {
                $output['aplicacion'] .= "<td class='apli'></td>";
            }

            $output['aplicacion'] .= "<td class='apli'><a href='/aplicaciones?aplic=$id_tipo&marca=$id_marca&vehic=$id_vehiculo' class='link a'>$aplicacion_vehiculo</a></td>";
            $output['aplicacion'] .= "</tr>";  
            $aplicacion = $fil_apl->aplicacion; 
            $aplicacion_marca =  $fil_apl->marca; 
        }
        $output['aplicacion'] .= "</tbody>";
        $output['aplicacion'] .= "</table>";

        $equivalencia_filtro = Equivalencia::select('marca', 'codigo_marca')
                                    ->where('codigo', '=', $codigo)
                                    ->orderBy('marca')
                                    ->orderBy('codigo_marca')
                                    ->get();

        $equivalencia = "";
        $output['equivalencia'] = "";
        $output['equivalencia'] .= "<table class='eq'>";
        $output['equivalencia'] .= "<thead class='eq'>"; 
        $output['equivalencia'] .= "<tr>"; 
        $output['equivalencia'] .= "<td class='tilt_blanco'>Equivalencias</td>";
        $output['equivalencia'] .= "<td></td>";
        $output['equivalencia'] .= "</tr>"; 
        $output['equivalencia'] .= "</thead>"; 
        $output['equivalencia'] .= "<tbody>"; 
        $output['equivalencia'] .= "<tr>"; 
        $output['equivalencia'] .= "<td style='background-color: #A4A4A4;' ><b>Empresa</b></td>";
        $output['equivalencia'] .= "<td style='background-color: #A4A4A4;'><b>Código</b></td>";
        $output['equivalencia'] .= "</tr>"; 

        foreach( $equivalencia_filtro as $equi_fil ){
            $equivalencia_colocar = $equi_fil->marca;
            $equivalencia_codigo_marca = $equi_fil->codigo_marca;
            $output['equivalencia'] .= "<tr>";
            if($equivalencia != $equi_fil->marca){
                $output['equivalencia'] .= "<td class='eq'>$equivalencia_colocar </td>";
            }
            else {
                $output['equivalencia'] .= "<td class='eq'></td>";
            } 
            $output['equivalencia'] .= "<td class='eq'>$equivalencia_codigo_marca</td>";
            $output['equivalencia'] .= "</tr>";
            $equivalencia = $equi_fil->marca;  
        }
        $output['equivalencia'] .= "</tbody>"; 
        $output['equivalencia'] .= "</table>"; 

        if(isset($_POST['regreso'])){
            $output['tipo'] = $id_tipo;
            $output['marca'] = $id_marca;
        }

        return response()->json($output);
    }

    public function plantillaFiltro($filtro, $codigo, $tabla){        
            $cadena = "<table class='vehiculo_detalles_seleccionado'>";
            $cadena .= '<thead class="equivalencias"><tr><td class="equivalencias tilt_blanco">especificaciones</td>';
            $cadena .= '<td class="equivalencias tilt_blanco">' . $codigo . "</td>";
            $cadena .= "</tr></thead>";

            if($tabla == 'aireautomotriz' || $tabla == 'aireindustrial'){
                $cadena .= "<tr>";
                $cadena .= "<td>Tipo:</td>";
                $cadena .= "<td>" . $filtro[0]->filtro->tipo->tipo . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>ø ext1:</td>";
                $cadena .= "<td>" . $filtro[0]->diametroext1 . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena.= "<td>ø ext2:</td>";
                $cadena .= "<td>" . $filtro[0]->diametroext2 . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>ø int1:</td>";
                $cadena .= "<td>" . $filtro[0]->diametroint1 . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>ø int2:</td>";
                $cadena .= "<td>" . $filtro[0]->diametroint2 . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>Altura:</td>";
                $cadena .= "<td>" . $filtro[0]->altura . "</td>";
                $cadena .= "</tr>";
                $cadena .= "</table>";
            }
            else if($tabla == 'combustiblelinea' ){
                $cadena .= "<tr>";
                $cadena.= "<td>Tipo:</td>";
                $cadena .= "<td>" . $filtro[0]->filtro->tipo->tipo . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>ø ext:</td>";
                $cadena .= "<td>" . $filtro[0]->diametroext . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>ø Altura:</td>";
                $cadena .= "<td>" . $filtro[0]->altura . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>Entrada:</td>";
                $cadena .= "<td>" . $filtro[0]->entrada . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>Salida:</td>";
                $cadena .= "<td>" . $filtro[0]->salida . "</td>";
                $cadena .= "</tr>";
                $cadena .= "</table>";
            }
            else if($tabla == 'elemento' ){
                $cadena .= "<tr>";
                $cadena .= "<td>Tipo:</td>";
                $cadena .= "<td>" . $filtro[0]->filtro->tipo->tipo . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>ø ext1:</td>";
                $cadena .= "<td>" . $filtro[0]->diametroext1 . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>ø int1:</td>";
                $cadena .= "<td>" . $filtro[0]->diametroint1 . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>ø int2:</td>";
                $cadena .= "<td>" . $filtro[0]->diametroint2 . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>Altura:</td>";
                $cadena .= "<td>" . $filtro[0]->altura . "</td>";
                $cadena .= "</tr>";
                $cadena .= "</table>";
            }
            else if($tabla == 'panel' ){
                $cadena .= "<tr>";
                $cadena .= "<td>Tipo:</td>";
                $cadena .= "<td>" . $filtro[0]->filtro->tipo->tipo . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>Largo:</td>";
                $cadena .= "<td>" . $filtro[0]->largo . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>Ancho:</td>";
                $cadena .= "<td>" . $filtro[0]->ancho . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>Altura:</td>";
                $cadena .= "<td>" . $filtro[0]->altura . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>Detalle 1:</td>";
                $cadena .= "<td>" . $filtro[0]->detalle1 . "</td>";
                $cadena .= "</tr>";
                $cadena .= "</table>";
            }
            else if($tabla == 'sellado' ){
                $cadena .= "<tr>";
                $cadena .= "<td>Tipo:</td>";
                $cadena .= "<td>" . $filtro[0]->filtro->tipo->tipo . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>ø ext1:</td>";
                $cadena .= "<td>" . $filtro[0]->diametroext . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>Rosca:</td>";
                $cadena .= "<td>" . $filtro[0]->diametroint . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>Altura:</td>";
                $cadena .= "<td>" . $filtro[0]->altura . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>Empacadura:</td>";
                $cadena .= "<td>ø ext: " . $filtro[0]->diametroempext . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td></td>";
                $cadena .= "<td>ø int: " . $filtro[0]->diametroempint . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td></td>";
                $cadena .= "<td>Espesor: " . $filtro[0]->espesoremp . "</td>";
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>Valvula de Alivio</td>";
                if( $filtro[0]->valvulaal == 1){
                    $cadena .= "<td>SI</td>";
                }
                if( $filtro[0]->valvulaal == 0){
                    $cadena .= "<td>NO</td>";
                }
                $cadena .= "</tr>";
                $cadena .= "<tr>";
                $cadena .= "<td>Valvula Anti-Drain</td>";
                if( $filtro[0]->valvulaad == 1){
                    $cadena .= "<td>SI</td>";
                }
                if( $filtro[0]->valvulaad == 0){
                    $cadena .= "<td>NO</td>";
                }
                $cadena .= "</tr>";
                $cadena .= "</table>";
            }

            return $cadena;
        }

}
