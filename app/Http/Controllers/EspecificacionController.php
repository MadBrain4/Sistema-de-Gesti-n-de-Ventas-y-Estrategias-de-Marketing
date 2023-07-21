<?php

namespace App\Http\Controllers;

use App\Models\CombustibleLinea;
use App\Models\Elemento;
use App\Models\FiltroCodificacion;
use App\Models\Panel;
use App\Models\Sellado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EspecificacionController extends Controller
{
    public function especificaciones(){
        return view('busqueda_especificaciones.especificaciones');
    }

    public function clase(Request $request){
        $clase = $request->input('especificacion');

        $tipos_especificaciones = FiltroCodificacion::from('filtro_codificacion as f_c')
                                ->join('tipos as t', 't.id', '=', 'f_c.id_tipo')
                                ->join('categorias as cat', 'cat.id', '=', 't.id_categoria')
                                ->join('clases as cl', 'cl.id', '=', 'cat.id_clase')
                                ->select('t.tipo')
                                ->groupBy('t.tipo')
                                ->where('cl.clase', $clase)
                                ->get();
                                
        $cadena = "<option value='vacio' disabled selected>Seleccionar Tipo</option>";
        foreach (  $tipos_especificaciones as $tipos_esp ) {
            $tipo = $tipos_esp->tipo;
            $cadena = $cadena . '<option value="';
            $cadena = $cadena . $tipo;
            $cadena = $cadena . '">';
            $cadena = $cadena . $tipo;
            $cadena = $cadena . '</option>';
        } 
        return response()->json($cadena);
    }

    public function tipo(Request $request){
        $especificacion = $request->input('especificacion');
        $nombre_tipo = $request->input('nombre_tipo');

        $roscas = FiltroCodificacion::from('filtro_codificacion as f_c')
                                ->join('tipos as t', 't.id', '=', 'f_c.id_tipo')
                                ->join('categorias as cat', 'cat.id', '=', 't.id_categoria')
                                ->join('clases as cl', 'cl.id', '=', 'cat.id_clase')
                                ->join('espec_sellado as sel', 'sel.id_filtro', '=', 'f_c.id')
                                ->select('sel.diametroint')
                                ->groupBy('sel.diametroint')
                                ->where('cl.clase', "Sellado")
                                ->where("t.tipo", $nombre_tipo)
                                ->get();

        $cadena = "";
        $cadena = "<option value='vacio' disabled selected>Seleccionar Rosca</option>";
        foreach( $roscas as $rosca ) {
            $cadena = $cadena . '<option value="';
            $cadena = $cadena . $rosca->diametroint;
            $cadena = $cadena . '">';
            $cadena = $cadena . $rosca->diametroint;
            $cadena = $cadena . '</option>';    
        }
        return response()->json($cadena);
    }

    public function tabla(Request $request){
        $especificacion = $request->input('especificacion');
        $tipo = $request->has('tipo') ? $request->input('tipo') : null;
        $rosca = $request->has('rosca') ? $request->input('rosca') : null;

        $campo = ( $request->has('campo') ) ? $request->input('campo') : null;
        $campo_busqueda = "%" . $campo . "%";

        $limit = ( $request->has('registros') ) ? $request->input('registros') : 10;
        $page = ( $request->has('pagina') ) ? $request->input('pagina') : 1;
        $inicio = $limit * ($page - 1);


        if( $especificacion == 'Aire Automotriz' ){
            $filas_totales = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                                ->join('espec_aireautomotriz as e_a', 'e_a.id_filtro', '=', 'f_c.id')
                                ->whereNull('f_c.deleted_at')
                                ->whereNull('e_a.deleted_at')
                                ->where('f_c.id_clase', 1)
                                ->count();

            $filas_filtradas = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                                ->join('espec_aireautomotriz as e_a', 'e_a.id_filtro', '=', 'f_c.id')
                                ->where(function ($query) use ($campo_busqueda, $campo) {
                                    if( $campo != null ){
                                        $query->where('e_a.codigo', "LIKE", $campo_busqueda);
                                        $query->orWhere("diametroext1", 'LIKE', $campo_busqueda);
                                        $query->orWhere("diametroext2", 'LIKE', $campo_busqueda);
                                        $query->orWhere("diametroint1", 'LIKE', $campo_busqueda);
                                        $query->orWhere("diametroint2", 'LIKE', $campo_busqueda);
                                        $query->orWhere("altura", 'LIKE', $campo_busqueda);
                                    }
                                })
                                ->whereNull('f_c.deleted_at')
                                ->whereNull('e_a.deleted_at')
                                ->where('f_c.id_clase', 1)
                                ->count();

            $datos = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                            ->join('espec_aireautomotriz as e_a', 'e_a.id_filtro', '=', 'f_c.id')
                            ->select('f_c.codigo', 'diametroext1', 'diametroext2', 'diametroint1', 'diametroint2', 'altura')
                            ->where(function ($query) use ($campo, $campo_busqueda) {
                                if( $campo != null ){
                                    $query->where('e_a.codigo', "LIKE", $campo_busqueda);
                                    $query->orWhere("diametroext1", 'LIKE', $campo_busqueda);
                                    $query->orWhere("diametroext2", 'LIKE', $campo_busqueda);
                                    $query->orWhere("diametroint1", 'LIKE', $campo_busqueda);
                                    $query->orWhere("diametroint2", 'LIKE', $campo_busqueda);
                                    $query->orWhere("altura", 'LIKE', $campo_busqueda);
                                }
                            })
                            ->whereNull('f_c.deleted_at')
                            ->whereNull('e_a.deleted_at')
                            ->where('f_c.id_clase', 1)
                            ->offset($inicio)
                            ->take($limit)
                            ->get();
            
            $output = [];
            $output['totalRegistros'] = $filas_totales;
            $output['totalFiltro'] = $filas_filtradas;
            $output['data'] = "";


            $output['data'] .= "<table class='busqueda_apli'>";
            $output['data'] .= "<thead class='busqueda_apli about_sel_right'>";
            $output['data'] .= "<tr class='busqueda_apli'>";
            $output['data'] .= "<td class='busqueda_apli' >Código</td> ";
            $output['data'] .= "<td class='busqueda_apli' > ø ext (mm) </td> ";
            $output['data'] .= "<td class='busqueda_apli' > ø int (mm) </td> ";
            $output['data'] .= "<td class='busqueda_apli' > Altura (mm) </td> ";
            $output['data'] .= "</thead>";
            $output['data'] .= "<tbody>";
            foreach( $datos as $dato ){
                $codigo = $dato->codigo;
                $diametroext1 = $dato->diametroext1;
                $diametroext2 = $dato->diametroext2;
                $diametroint1 = $dato->diametroint1;
                $diametroint2 = $dato->diametroint2;
                $altura = $dato->altura;

                $output['data'] .= "<tr>";
                $output['data'] .= "<td class='busqueda_apli'><a href='/filtro?codigo=$codigo&esp=1' class='a' style='cursor: pointer'>$codigo </a></td>";
                $output['data'] .= "<td class='busqueda_apli'>$diametroext1 -- $diametroext2</td>";
                $output['data'] .= "<td class='busqueda_apli'>$diametroint1 -- $diametroint2</td>";
                $output['data'] .= "<td class='busqueda_apli'>$altura</td>";
                $output['data'] .= "</tr>";
            }
            $output['data'] .= "</tbody>";
            $output['data'] .= "</table>";
        }
        else if( $especificacion == 'Aire Industrial' ){
            $filas_totales = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                                ->join('espec_aireindustrial as e_a', 'e_a.id_filtro', '=', 'f_c.id')
                                ->whereNull('f_c.deleted_at')
                                ->whereNull('e_a.deleted_at')
                                ->where('f_c.id_clase', 2)
                                ->count();

            $filas_filtradas = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                                ->join('espec_aireindustrial as e_a', 'e_a.id_filtro', '=', 'f_c.id')
                                ->where(function ($query) use ($campo, $campo_busqueda) {
                                    if( $campo != null ){
                                        $query->where('e_a.codigo', "LIKE", $campo_busqueda);
                                        $query->orWhere("diametroext1", 'LIKE', $campo_busqueda);
                                        $query->orWhere("diametroext2", 'LIKE', $campo_busqueda);
                                        $query->orWhere("diametroint1", 'LIKE', $campo_busqueda);
                                        $query->orWhere("diametroint2", 'LIKE', $campo_busqueda);
                                        $query->orWhere("altura", 'LIKE', $campo_busqueda);
                                    }
                                })
                                ->whereNull('f_c.deleted_at')
                                ->whereNull('e_a.deleted_at')
                                ->where('f_c.id_clase', 2)
                                ->count();

            $datos = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                            ->join('espec_aireindustrial as e_a', 'e_a.id_filtro', '=', 'f_c.id')
                            ->select('f_c.codigo', 'diametroext1', 'diametroext2', 'diametroint1', 'diametroint2', 'altura')
                            ->where(function ($query) use ($campo, $campo_busqueda) {
                                if( $campo != null ){
                                    $query->where('e_a.codigo', "LIKE", $campo_busqueda);
                                    $query->orWhere("diametroext1", 'LIKE', $campo_busqueda);
                                    $query->orWhere("diametroext2", 'LIKE', $campo_busqueda);
                                    $query->orWhere("diametroint1", 'LIKE', $campo_busqueda);
                                    $query->orWhere("diametroint2", 'LIKE', $campo_busqueda);
                                    $query->orWhere("altura", 'LIKE', $campo_busqueda);
                                }
                            })
                            ->whereNull('f_c.deleted_at')
                            ->whereNull('e_a.deleted_at')
                            ->where('f_c.id_clase', 2)
                            ->offset($inicio)
                            ->take($limit)
                            ->get();
            
            $output = [];
            $output['totalRegistros'] = $filas_totales;
            $output['totalFiltro'] = $filas_filtradas;
            $output['data'] = "";


            $output['data'] .= "<table class='busqueda_apli'>";
            $output['data'] .= "<thead class='busqueda_apli about_sel_right'>";
            $output['data'] .= "<tr class='busqueda_apli'>";
            $output['data'] .= "<td class='busqueda_apli' >Código</td> ";
            $output['data'] .= "<td class='busqueda_apli' > ø ext (mm) </td> ";
            $output['data'] .= "<td class='busqueda_apli' > ø int (mm) </td> ";
            $output['data'] .= "<td class='busqueda_apli' > Altura (mm) </td> ";
            $output['data'] .= "</thead>";
            $output['data'] .= "<tbody>";
            foreach( $datos as $dato ){
                $codigo = $dato->codigo;
                $diametroext1 = $dato->diametroext1;
                $diametroext2 = $dato->diametroext2;
                $diametroint1 = $dato->diametroint1;
                $diametroint2 = $dato->diametroint2;
                $altura = $dato->altura;

                $output['data'] .= "<tr>";
                $output['data'] .= "<td class='busqueda_apli'><a href='/filtro?codigo=$codigo&esp=1' class='a' style='cursor: pointer'>$codigo </a></td>";
                $output['data'] .= "<td class='busqueda_apli'>$diametroext1 -- $diametroext2</td>";
                $output['data'] .= "<td class='busqueda_apli'>$diametroint1 -- $diametroint2</td>";
                $output['data'] .= "<td class='busqueda_apli'>$altura</td>";
                $output['data'] .= "</tr>";
            }
            $output['data'] .= "</tbody>";
            $output['data'] .= "</table>";
        }
        else if( $especificacion == 'Combustible en Linea' ){
            $filas_totales = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                                ->join('espec_combustiblelinea as e_c', 'e_c.id_filtro', '=', 'f_c.id')
                                ->whereNull('f_c.deleted_at')
                                ->whereNull('e_c.deleted_at')
                                ->where('f_c.id_clase', 3)
                                ->count();

            $filas_filtradas = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                                ->join('espec_combustiblelinea as e_c', 'e_c.id_filtro', '=', 'f_c.id')
                                ->where(function ($query) use ($campo, $campo_busqueda) {
                                    if( $campo != null ){
                                        $query->where('e_c.codigo', "LIKE", $campo_busqueda);
                                        $query->orWhere("diametroext", 'LIKE', $campo_busqueda);
                                        $query->orWhere("altura", 'LIKE', $campo_busqueda);
                                        $query->orWhere("entrada", 'LIKE', $campo_busqueda);
                                        $query->orWhere("salida", 'LIKE', $campo_busqueda);
                                    }
                                })
                                ->whereNull('f_c.deleted_at')
                                ->whereNull('e_c.deleted_at')
                                ->where('f_c.id_clase', 3)
                                ->count();

            $datos = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                            ->join('espec_combustiblelinea as e_c', 'e_c.id_filtro', '=', 'f_c.id')
                            ->select('f_c.codigo', 'diametroext', 'altura', 'entrada', 'salida')
                            ->where(function ($query) use ($campo, $campo_busqueda) {
                                if( $campo != null ){
                                    $query->where('e_c.codigo', "LIKE", $campo_busqueda);
                                    $query->orWhere("diametroext", 'LIKE', $campo_busqueda);
                                    $query->orWhere("altura", 'LIKE', $campo_busqueda);
                                    $query->orWhere("entrada", 'LIKE', $campo_busqueda);
                                    $query->orWhere("salida", 'LIKE', $campo_busqueda);
                                }
                            })
                            ->whereNull('f_c.deleted_at')
                            ->whereNull('e_c.deleted_at')
                            ->where('f_c.id_clase', 3)
                            ->offset($inicio)
                            ->take($limit)
                            ->get();
            
            $output = [];
            $output['totalRegistros'] = $filas_totales;
            $output['totalFiltro'] = $filas_filtradas;
            $output['data'] = "";


            $output['data'] .= "<table class='busqueda_apli'>";
            $output['data'] .= "<thead class='busqueda_apli about_sel_right'>";
            $output['data'] .= "<tr class='busqueda_apli'>";
            $output['data'] .= "<td class='busqueda_apli' >Código</td> ";
            $output['data'] .= "<td class='busqueda_apli' > ø ext (mm) </td> ";
            $output['data'] .= "<td class='busqueda_apli' > Altura (mm) </td> ";
            $output['data'] .= "<td class='busqueda_apli' > Líneas (mm) </td> ";
            $output['data'] .= "</thead>";
            $output['data'] .= "<tbody>";
            foreach( $datos as $dato ){
                $codigo = $dato->codigo;
                $diametroext = $dato->diametroext;
                $altura = $dato->altura;
                $entrada = $dato->entrada;
                $salida = $dato->salida;

                $output['data'] .= "<tr>";
                $output['data'] .= "<td class='busqueda_apli'><a href='/filtro?codigo=$codigo&esp=1' class='a' style='cursor: pointer'>$codigo </a></td>";
                $output['data'] .= "<td class='busqueda_apli'>$diametroext</td>";
                $output['data'] .= "<td class='busqueda_apli'>$altura</td>";
                $output['data'] .= "<td class='busqueda_apli'>Entrada: $entrada <br /> Salida: $salida</td>";
                $output['data'] .= "</tr>";
            }
            $output['data'] .= "</tbody>";
            $output['data'] .= "</table>";
        }
        else if( $especificacion == 'Elemento' ){
            $filas_totales = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                                ->join('espec_elemento as e_e', 'e_e.id_filtro', '=', 'f_c.id')
                                ->join('tipos as t', 'f_c.id_tipo', '=', 't.id')
                                ->whereNull('f_c.deleted_at')
                                ->whereNull('e_e.deleted_at')
                                ->where('f_c.id_clase', 4)
                                ->where('t.tipo', $tipo)
                                ->count();

            $filas_filtradas = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                                ->join('espec_elemento as e_e', 'e_e.id_filtro', '=', 'f_c.id')
                                ->join('tipos as t', 'f_c.id_tipo', '=', 't.id')
                                ->where(function ($query) use ($campo_busqueda, $campo) {
                                    if( $campo != null ){
                                        $query->where('e_e.codigo', "LIKE", $campo_busqueda);
                                        $query->orWhere("diametroext1", 'LIKE', $campo_busqueda);
                                        $query->orWhere("diametroint1", 'LIKE', $campo_busqueda);
                                        $query->orWhere("diametroint2", 'LIKE', $campo_busqueda);
                                        $query->orWhere("altura", 'LIKE', $campo_busqueda);
                                    }
                                })
                                ->whereNull('f_c.deleted_at')
                                ->whereNull('e_e.deleted_at')
                                ->where('f_c.id_clase', 4)
                                ->where('t.tipo', $tipo)
                                ->count();

            $datos = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                            ->join('espec_elemento as e_e', 'e_e.id_filtro', '=', 'f_c.id')
                            ->join('tipos as t', 'f_c.id_tipo', '=', 't.id')
                            ->select('f_c.codigo', 'diametroext1', 'diametroint1', 'diametroint2', 'altura')
                            ->where(function ($query) use ($campo, $campo_busqueda) {
                                if( $campo != null ){
                                    $query->where('e_e.codigo', "LIKE", $campo_busqueda);
                                    $query->orWhere("diametroext1", 'LIKE', $campo_busqueda);
                                    $query->orWhere("diametroint1", 'LIKE', $campo_busqueda);
                                    $query->orWhere("diametroint2", 'LIKE', $campo_busqueda);
                                    $query->orWhere("altura", 'LIKE', $campo_busqueda);
                                }
                            })
                            ->whereNull('f_c.deleted_at')
                            ->whereNull('e_e.deleted_at')
                            ->where('f_c.id_clase', 4)
                            ->where('t.tipo', $tipo)
                            ->offset($inicio)
                            ->take($limit)
                            ->get();
            
            $output = [];
            $output['totalRegistros'] = $filas_totales;
            $output['totalFiltro'] = $filas_filtradas;
            $output['data'] = "";


            $output['data'] .= "<table class='busqueda_apli'>";
            $output['data'] .= "<thead class='busqueda_apli about_sel_right'>";
            $output['data'] .= "<tr class='busqueda_apli'>";
            $output['data'] .= "<td class='busqueda_apli' >Código</td> ";
            $output['data'] .= "<td class='busqueda_apli' > ø ext (mm) </td> ";
            $output['data'] .= "<td class='busqueda_apli' > ø int (mm) </td> ";
            $output['data'] .= "<td class='busqueda_apli' > Altura (mm) </td> ";
            $output['data'] .= "</thead>";
            $output['data'] .= "<tbody>";
            foreach( $datos as $dato ){
                $codigo = $dato->codigo;
                $diametroext1 = $dato->diametroext1;
                $diametroint1 = $dato->diametroint1;
                $diametroint2 = $dato->diametroint2;
                $altura = $dato->altura;

                $output['data'] .= "<tr>";
                $output['data'] .= "<td class='busqueda_apli'><a href='/filtro?codigo=$codigo&esp=1' class='a' style='cursor: pointer'>$codigo </a></td>";
                $output['data'] .= "<td class='busqueda_apli'>$diametroext1</td>";
                $output['data'] .= "<td class='busqueda_apli'>$diametroint1 -- $diametroint2</td>";
                $output['data'] .= "<td class='busqueda_apli'>$altura</td>";
                $output['data'] .= "</tr>";
            }
            $output['data'] .= "</tbody>";
            $output['data'] .= "</table>";
        }
        else if( $especificacion == 'Panel' ){
            $filas_totales = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                                ->join('espec_panel as e_p', 'e_p.id_filtro', '=', 'f_c.id')
                                ->join('tipos as t', 'f_c.id_tipo', '=', 't.id')
                                ->whereNull('f_c.deleted_at')
                                ->whereNull('e_p.deleted_at')
                                ->where('f_c.id_clase', 5)
                                ->where('t.tipo', $tipo)
                                ->count();

            $filas_filtradas = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                                ->join('espec_panel as e_p', 'e_p.id_filtro', '=', 'f_c.id')
                                ->join('tipos as t', 'f_c.id_tipo', '=', 't.id')
                                ->where(function ($query) use ($campo_busqueda, $campo) {
                                    if( $campo != null ){
                                        $query->where('e_p.codigo', "LIKE", $campo_busqueda);
                                        $query->orWhere("largo", 'LIKE', $campo_busqueda);
                                        $query->orWhere("ancho", 'LIKE', $campo_busqueda);
                                        $query->orWhere("altura", 'LIKE', $campo_busqueda);
                                    }
                                })
                                ->whereNull('f_c.deleted_at')
                                ->whereNull('e_p.deleted_at')
                                ->where('f_c.id_clase', 5)
                                ->where('t.tipo', $tipo)
                                ->count();

            $datos = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                            ->join('espec_panel as e_p', 'e_p.id_filtro', '=', 'f_c.id')
                            ->join('tipos as t', 'f_c.id_tipo', '=', 't.id')
                            ->select('f_c.codigo', 'largo', 'ancho', 'altura')
                            ->where(function ($query) use ($campo, $campo_busqueda) {
                                if( $campo != null ){
                                    $query->where('e_p.codigo', "LIKE", $campo_busqueda);
                                    $query->orWhere("largo", 'LIKE', $campo_busqueda);
                                    $query->orWhere("ancho", 'LIKE', $campo_busqueda);
                                    $query->orWhere("altura", 'LIKE', $campo_busqueda);
                                }
                            })
                            ->whereNull('f_c.deleted_at')
                            ->whereNull('e_p.deleted_at')
                            ->where('f_c.id_clase', 5)
                            ->where('t.tipo', $tipo)
                            ->offset($inicio)
                            ->take($limit)
                            ->get();
            
            $output = [];
            $output['totalRegistros'] = $filas_totales;
            $output['totalFiltro'] = $filas_filtradas;
            $output['data'] = "";


            $output['data'] .= "<table class='busqueda_apli'>";
            $output['data'] .= "<thead class='busqueda_apli about_sel_right'>";
            $output['data'] .= "<tr class='busqueda_apli'>";
            $output['data'] .= "<td class='busqueda_apli' >Código</td> ";
            $output['data'] .= "<td class='busqueda_apli' > Largo (mm) </td> ";
            $output['data'] .= "<td class='busqueda_apli' > Ancho (mm) </td> ";
            $output['data'] .= "<td class='busqueda_apli' > Altura (mm) </td> ";
            $output['data'] .= "</thead>";
            $output['data'] .= "<tbody>";
            foreach( $datos as $dato ){
                $codigo = $dato->codigo;
                $largo = $dato->largo;
                $ancho = $dato->ancho;
                $altura = $dato->altura;

                $output['data'] .= "<tr>";
                $output['data'] .= "<td class='busqueda_apli'><a href='/filtro?codigo=$codigo&esp=1' class='a' style='cursor: pointer'>$codigo </a></td>";
                $output['data'] .= "<td class='busqueda_apli'>$largo</td>";
                $output['data'] .= "<td class='busqueda_apli'>$ancho</td>";
                $output['data'] .= "<td class='busqueda_apli'>$altura</td>";
                $output['data'] .= "</tr>";
            }
            $output['data'] .= "</tbody>";
            $output['data'] .= "</table>";
        }
        else if( $especificacion == 'Sellado' ){
            $filas_totales = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                                ->join('espec_sellado as e_s', 'e_s.id_filtro', '=', 'f_c.id')
                                ->join('tipos as t', 'f_c.id_tipo', '=', 't.id')
                                ->whereNull('f_c.deleted_at')
                                ->whereNull('e_s.deleted_at')
                                ->where('f_c.id_clase', 6)
                                ->where('t.tipo', $tipo)
                                ->where('e_s.diametroint', $rosca)
                                ->count();

            $filas_filtradas = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                                ->join('espec_sellado as e_s', 'e_s.id_filtro', '=', 'f_c.id')
                                ->join('tipos as t', 'f_c.id_tipo', '=', 't.id')
                                ->where(function ($query) use ($campo_busqueda, $campo) {
                                    if( $campo != null ){
                                        $query->where('e_s.codigo', "LIKE", $campo_busqueda);
                                        $query->orWhere("diametroext", 'LIKE', $campo_busqueda);
                                        $query->orWhere("diametroint", 'LIKE', $campo_busqueda);
                                        $query->orWhere("altura", 'LIKE', $campo_busqueda);
                                        $query->orWhere("diametroempext", 'LIKE', $campo_busqueda);
                                        $query->orWhere("diametroempint", 'LIKE', $campo_busqueda);
                                        $query->orWhere("espesoremp", 'LIKE', $campo_busqueda);
                                    }
                                })
                                ->whereNull('f_c.deleted_at')
                                ->whereNull('e_s.deleted_at')
                                ->where('f_c.id_clase', 6)
                                ->where('t.tipo', $tipo)
                                ->where('e_s.diametroint', $rosca)
                                ->count();

            $datos = FiltroCodificacion::from( "filtro_codificacion as f_c" )
                            ->join('espec_sellado as e_s', 'e_s.id_filtro', '=', 'f_c.id')
                            ->join('tipos as t', 'f_c.id_tipo', '=', 't.id')
                            ->select('f_c.codigo', 'diametroext', 'diametroint', 'altura', 'diametroempext', 'diametroempint', 'altura', 'valvulaal', 'valvulaad')
                            ->where(function ($query) use ($campo, $campo_busqueda) {
                                if( $campo != null ){
                                    $query->where('e_s.codigo', "LIKE", $campo_busqueda);
                                    $query->orWhere("diametroext", 'LIKE', $campo_busqueda);
                                    $query->orWhere("diametroint", 'LIKE', $campo_busqueda);
                                    $query->orWhere("altura", 'LIKE', $campo_busqueda);
                                    $query->orWhere("diametroempext", 'LIKE', $campo_busqueda);
                                    $query->orWhere("diametroempint", 'LIKE', $campo_busqueda);
                                    $query->orWhere("espesoremp", 'LIKE', $campo_busqueda);
                                }
                            })
                            ->whereNull('f_c.deleted_at')
                            ->whereNull('e_s.deleted_at')
                            ->where('f_c.id_clase', 6)
                            ->where('t.tipo', $tipo)
                            ->where('e_s.diametroint', $rosca)
                            ->offset($inicio)
                            ->take($limit)
                            ->get();
            
            $output = [];
            $output['totalRegistros'] = $filas_totales;
            $output['totalFiltro'] = $filas_filtradas;
            $output['data'] = "";


            $output['data'] .= "<table class='busqueda_apli'>";
            $output['data'] .= "<thead class='busqueda_apli about_sel_right'>";
            $output['data'] .= "<tr class='busqueda_apli'>";
            $output['data'] .= "<td class='busqueda_apli' >Código</td> ";
            $output['data'] .= "<td class='busqueda_apli' > ø ext (mm) </td> ";
            $output['data'] .= "<td class='busqueda_apli' > Altura (mm) </td> ";
            $output['data'] .= "<td class='busqueda_apli' > Empacadura (mm) </td> ";
            $output['data'] .= "<td class='busqueda_apli' > Valvulas </td> ";
            $output['data'] .= "</thead>";
            $output['data'] .= "<tbody>";
            foreach( $datos as $dato ){
                $codigo = $dato->codigo;
                $altura = $dato->altura;
                $diametroext = $dato->diametroext;
                $diametroint = $dato->diametroint;
                $diametroempint = $dato->diametroempint;
                $diametroempext = $dato->diametroempext;
                $espesoremp = $dato->espesoremp;
                $valvulaal = $dato->valvulaal;
                $valvulaad = $dato->valvulaad;

                $output['data'] .= "<tr>";
                $output['data'] .= "<td class='busqueda_apli'><a href='/filtro?codigo=$codigo&esp=1' class='a' style='cursor: pointer'>$codigo </a></td>";
                $output['data'] .= "<td class='busqueda_apli'>$diametroext</td>";
                $output['data'] .= "<td class='busqueda_apli'>$altura</td>";
                $output['data'] .= "<td class='busqueda_apli'>ø ext: $diametroempext <br /> ø int: $diametroempint <br /> Espesor: $espesoremp</td>";
                $output['data'] .= "<td class='busqueda_apli'>";
                if( $valvulaal == 1 ){
                    $output['data'] .= "Alivio: SI <br />";
                }
                else {
                    $output['data'] .= "Alivio: NO <br />";
                }
                if( $valvulaad == 1 ){
                    $output['data'] .= "Anti Drain: SI <br />";
                }
                else {
                    $output['data'] .= "Anti Drain: NO <br />";
                }
                $output['data'] .= "</tr>";
                $output['data'] .= "</td>";
            }
            $output['data'] .= "</tbody>";
            $output['data'] .= "</table>";
        }

        $output['paginacion'] = "";

        $numeroInicio = 1;
        if($output['totalFiltro'] > 0){
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
                $output['paginacion'] .= "<a onclick='getTabla(1)'  style='cursor: pointer;'>  <<  </a>"; 
                $output['paginacion'] .= "<a onclick='getTabla($anterior)'  style='cursor: pointer;'>  <  </a>"; 
            }

            for($i = $numeroInicio; $i <= $numeroFinal; $i++){
                if($page == $i){
                    $output['paginacion'] .= "<p>" . $i ." </p>";
                }
            }
            if($page != $totalPaginas){
                $siguiente = $page  + 1;
                $output['paginacion'] .= "<a onclick='getTabla($siguiente)'  style='cursor: pointer;'>  >  </a>"; 
                $output['paginacion'] .= "<a onclick='getTabla($totalPaginas)'  style='cursor: pointer;'> >> </a>"; 
            }
        }

        $output['especificacion'] = $especificacion;

        return response()->json($output);

    }

    public function tablaValida($nombreTabla){
        $listaTabla = array('espec_aireautomotriz', 'espec_aireindustrial', 'espec_combustiblelinea', 'espec_elemento', 'espec_panel', 'espec_sellado');
        return in_array($nombreTabla, $listaTabla);
    }
}
