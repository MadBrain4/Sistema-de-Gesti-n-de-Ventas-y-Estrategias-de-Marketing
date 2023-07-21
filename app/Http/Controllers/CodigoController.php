<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FiltroCodificacion;
use App\Models\Equivalencia;

class CodigoController extends Controller
{
    public function codigo (Request $request){
        if( $request->has('codigo') ){
            $codigo = $request->input('codigo');
            return view( 'busqueda_codigos.codigos', compact('codigo') );
        }
        else {
            return view( 'busqueda_codigos.codigos' );
        }
    }

    public function busqueda (Request $request){
        $codigo = $request->input('codigo');
        $codigo_preparado = "%$codigo%";

        $coincidencia_exacta = FiltroCodificacion::whereNull('deleted_at') 
                                        ->where(function ($query) use ($codigo) {
                                            $query->where('codigo', "=", $codigo);
                                            $query->orWhere("codigo_buscar", '=', $codigo);
                                        })
                                        ->whereNull('deleted_at') 
                                        ->get();

        $coincidencias = FiltroCodificacion::whereNull('deleted_at')
                            ->where('codigo', '<>', $codigo) 
                            ->where('codigo_buscar', '<>', $codigo) 
                            ->where(function ($query) use ($codigo_preparado) {
                                $query->where('codigo', "LIKE", $codigo_preparado);
                                $query->orWhere("codigo_buscar", 'LIKE', $codigo_preparado);
                            })
                            ->get();

        $output['coincidencia'] = 0;
        $output['especificaciones'] = "<h3 class='titulo'>Jet-Filter</h3>";
        $output['especificaciones'] .= "<table class='codigos'>";
        $output['especificaciones'] .= "<thead class='codigos'>";
        $output['especificaciones'] .= "<tr><td class='codigos'>Codigos WEB</td></tr>";
        $output['especificaciones'] .= "</thead>";
        $output['especificaciones'] .= "<tbody>";
        for($i = 0; $i < count( $coincidencia_exacta ); $i++){ 
            $codigo = $coincidencia_exacta[$i]->codigo;
            $clase = $coincidencia_exacta[$i]->clase->clase;
            $output['especificaciones'] .= "<tr><td class='codigos'><a href='/filtro?codigo=$codigo&clase=$clase&cod=1' class='link resaltar a'>";
            $output['especificaciones'] .= $coincidencia_exacta[$i]->codigo;
            $output['especificaciones'] .= "[*]</a></td></tr>";
            $output['coincidencia'] = 1;
        }
        for($i = 0; $i < count( $coincidencias ); $i++){ 
            $codigo = $coincidencias[$i]->codigo;
            $clase = $coincidencias[$i]->clase->clase;
            $output['especificaciones'] .= "<tr><td class='codigos'><a href='/filtro?codigo=$codigo&clase=$clase&cod=1' class='link a'>";
            $output['especificaciones'] .= $coincidencias[$i]->codigo;
            $output['especificaciones'] .= "</a></td></tr>";
            $output['coincidencia'] = 1;
        }
        $output['especificaciones'] .= "</tbody>";
        $output['especificaciones'] .= "</table>";

        $codigo = $request->input('codigo');

        $coincidencia_exacta = Equivalencia::select('codigo_marca', 'codigo', 'marca', 'id_filtro')
                                        ->where(function ($query) use ($codigo) {
                                            $query->where('codigo_marca', "=", $codigo);
                                            $query->orWhere("codigo_marca_buscar", '=', $codigo);
                                        })   
                                        ->whereNull('deleted_at') 
                                        ->get();

        $coincidencias_equivalencias = Equivalencia::select('codigo_marca', 'codigo', 'marca', 'id_filtro')
                                ->whereNull('deleted_at') 
                                ->where('codigo_marca', '<>', $codigo) 
                                ->where('codigo_marca_buscar', '<>', $codigo) 
                                ->where(function ($query) use ($codigo_preparado) {
                                    $query->where('codigo_marca', "LIKE", $codigo_preparado);
                                    $query->orWhere("codigo_marca_buscar", 'LIKE', $codigo_preparado);
                                })  
                                ->get();

        $output['equivalencias'] = "";
        $output['equivalencias'] .= "<h3 class='titulo'>Equivalencias</h3>";
        $output['equivalencias'] .= "<table class='equivalencias'>";
        $output['equivalencias'] .= "<thead class='equivalencias'>";
        $output['equivalencias'] .= "<tr><td class='equivalencias' colspan='3'>Codigos de Otros Fabricantes</td>";
        $output['equivalencias'] .= "<td class='codigos'>Codigo WEB</td></tr>";
        $output['equivalencias'] .= "</thead>";
        $output['equivalencias'] .= "<tbody>";

        for($i = 0; $i < count( $coincidencia_exacta ); $i++){ 
            $codigo = $coincidencia_exacta[$i]->codigo;
            $clase = $coincidencia_exacta[$i]->filtro->clase->clase;
            
            $output['equivalencias'] .= "<tr><td class='equivalencias resaltar'>";
            $output['equivalencias'] .= $coincidencia_exacta[$i]->codigo_marca;
            $output['equivalencias'] .= "[*]</td><td class='equivalencias'>";
            $output['equivalencias'] .= $coincidencia_exacta[$i]->marca;
            $output['equivalencias'] .= "</td><td class='equivalencias campo'>";
            $output['equivalencias'] .= "->";
            $output['equivalencias'] .= "</td><td class='equivalencias'><a href='/filtro?codigo=$codigo&clase=$clase&cod=1' class='link a'>";
            $output['equivalencias'] .= $coincidencia_exacta[$i]->codigo;
            $output['equivalencias'] .= "</a></td></tr>";
            $output['coincidencia'] = 1;

        }
        for($i = 0; $i < count( $coincidencias_equivalencias ); $i++){ 
            $codigo = $coincidencias_equivalencias[$i]->codigo;
            $clase = $coincidencias_equivalencias[$i]->filtro->clase->clase;
            
            $output['equivalencias'] .= "<tr><td class='equivalencias'>";
            $output['equivalencias'] .= $coincidencias_equivalencias[$i]->codigo_marca;
            $output['equivalencias'] .= "</td><td class='equivalencias'>";
            $output['equivalencias'] .= $coincidencias_equivalencias[$i]->marca;
            $output['equivalencias'] .= "</td><td class='equivalencias campo'>";
            $output['equivalencias'] .= "->";
            $output['equivalencias'] .= "</td><td class='equivalencias'><a href='/filtro?codigo=$codigo&clase=$clase&cod=1' class='link a'>";
            $output['equivalencias'] .= $coincidencias_equivalencias[$i]->codigo;
            $output['equivalencias'] .= "</a></td></tr>";
            $output['coincidencia'] = 1;
        }
        $output['equivalencias'] .= "</tbody>";
        $output['equivalencias'] .= "</table>";

        return response()->json($output);
    }
}
