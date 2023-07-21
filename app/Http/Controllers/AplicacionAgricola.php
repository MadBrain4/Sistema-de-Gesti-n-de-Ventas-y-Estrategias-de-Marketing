<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Aplicacion;

class AplicacionAgricola extends Controller
{
    public function aplicacion_agricola(){
        return view('jetfilter.aplicacion_agricola.aplicacion_agricola');
    }

    public function nuevo(){
        $resultado_marca = DB::table('aplicacion_marca')
                                ->select('id', 'marca')
                                ->whereNull('deleted_at') 
                                ->get();

        $resultado_vehiculo = DB::table('aplicacion_vehiculo')
                                ->select('id', 'modelo', 'motor')
                                ->whereNull('deleted_at') 
                                ->get();

        return view('jetfilter.aplicacion_agricola.nuevo', compact('resultado_marca', 'resultado_vehiculo'));
    }

    public function store(Request $request){
        if( $request->has('aplicacion_agricola') ){
            $codigo = $request->input('codigo_filtro');
            $marca = $request->input('marca');
            $vehiculo = $request->input('vehiculo');
            $aplicacion = $request->input('aplicacion');
            $detalle = $request->input('detalle');
            $tipo = 4;
        }

        $sincronizado = date("Ymd");

        $codigo_filtro = DB::table('filtro_codificacion')
                                    ->select('id')
                                    ->where('codigo', '=', $codigo)
                                    ->get();

        if( count($codigo_filtro) > 0 ){
            $aplicacion = Aplicacion::create([
                'id_tipo' => $tipo,
                'id_marca' => $marca,
                'id_vehiculo' => $vehiculo,
                'id_filtro' => $codigo_filtro[0]->id,
                'codigo' => $codigo,
                'aplicacion' => $aplicacion,
                'detalle' => $detalle,
                'sincronizado' => $sincronizado,
            ]); 
        }
        else {
            return redirect()->route('jet-filter.catalogo.aplicacion_agricola.nuevo')->with('codigo_incorrecto', 'true');
        }
        if($tipo == 4){
            return redirect()->route('jet-filter.catalogo.aplicacion_agricola')->with('creado', $codigo);
        }

    }

    public function show($id){
        $aplicacion_seleccionada = Aplicacion::select('id_marca', 'id_vehiculo', 'aplicacion', 'codigo', 'id_filtro', 'detalle', 'sincronizado')
                                    ->where('id', $id)
                                    ->where('id_tipo', 4)
                                    ->get();

        $vehiculo = DB::table('aplicacion_vehiculo')
                        ->select('modelo', 'motor')
                        ->where('id', $aplicacion_seleccionada[0]->id_vehiculo)
                        ->get();

        $modelo_seleccionado = $vehiculo[0]->modelo;
        $motor_seleccionado = $vehiculo[0]->motor;
            
        $marca = DB::table('aplicacion_marca')
                        ->select('marca')
                        ->where('id', $aplicacion_seleccionada[0]->id_marca)
                        ->get();

        $marca_seleccionada = $marca[0]->marca;

        return view('jetfilter.aplicacion_agricola.show', compact('aplicacion_seleccionada', 'marca_seleccionada', 'modelo_seleccionado', 'motor_seleccionado') );
    }

    public function delete($id, Request $request){
        if( $request->routeIs('*.aplicacion_agricola.*') ){
            $aplicacion = Aplicacion::find($id);
            $id_filtro = $aplicacion->id_filtro;
            $codigo = $aplicacion->codigo;
        }

        $fecha = date("Y-m-d H:i:s");

        if( $request->routeIs('*.aplicacion_agricola.*') ){
            $aplicacion->update([
                'deleted_at' => $fecha,
            ]); 

            $eliminado = $codigo;
            return redirect()->route("jet-filter.catalogo.aplicacion_agricola")->with('eliminado', $eliminado);
        }
    }

    public function edit($id){
        $aplicacion_agricola = Aplicacion::find($id);

        $resultado_marca = DB::table('aplicacion_marca')
                                ->select('id', 'marca')
                                ->whereNull('deleted_at') 
                                ->get();

        $resultado_vehiculo = DB::table('aplicacion_vehiculo')
                                ->select('id', 'modelo', 'motor')
                                ->whereNull('deleted_at') 
                                ->get();

        $resultado_aplicacion = DB::table('aplicacion')
                                ->select('aplicacion')
                                ->where('id_tipo', 4)
                                ->groupBy('aplicacion')
                                ->orderBy('aplicacion')
                                ->get();

        return view('jetfilter.aplicacion_agricola.edit', compact('aplicacion_agricola', 'resultado_marca', 'resultado_vehiculo', 'resultado_aplicacion') );
    }

    public function update($id, Request $request){
        if( $request->has('aplicacion_agricola') ){
            $aplicacion_seleccionada = Aplicacion::find($id);
            $codigo = $request->input('codigo');
            $marca = $request->input('marca');
            $vehiculo = $request->input('vehiculo');
            $aplicacion = $request->input('aplicacion');
            $detalle = ( $request->input('detalle') != '' ) ? $request->input('detalle') : 'N/D';
            $sincronizado = date("Ymd");
            $fecha_updated = date('Y-m-d H:i:s');
            $tipo = 4;

            $codigo_filtro = DB::table('filtro_codificacion')
                                    ->select('id')
                                    ->where('codigo', '=', $codigo)
                                    ->get();

            if( count($codigo_filtro) > 0 ){
                $aplicacion_seleccionada->update([
                    'id_tipo' => $tipo,
                    'id_marca' => $marca,
                    'id_vehiculo' => $vehiculo,
                    'id_filtro' => $codigo_filtro[0]->id,
                    'codigo' => $codigo,
                    'aplicacion' => $aplicacion,
                    'detalle' => $detalle,
                    'sincronizado' => $sincronizado,
                    'updated_at' => $fecha_updated,
                ]); 
            }
            else {
                return redirect()->route('jet-filter.catalogo.aplicacion_agricola.edit', [ 'id' => $id ])->with('codigo_incorrecto', 'true');
            }
            if($tipo == 4){
                return redirect()->route('jet-filter.catalogo.aplicacion_agricola')->with('creado', $codigo);
            }
        }
    }
}
