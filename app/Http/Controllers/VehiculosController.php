<?php

namespace App\Http\Controllers;

use App\Models\VehiculoAplicacion;
use App\Models\MarcaAplicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiculosController extends Controller
{
    public function vehiculos(){
        $paginas = [10, 25, 50, 100];

        return view('jetfilter.vehiculos.vehiculos', compact('paginas') );
    }

    public function cargar(Request $request){
        $columnas = ['id', 'modelo', 'motor', 'cilindrada', 'ano', 'sincronizado'];
        $campo = ( $request->has('campo') ) ? $request->input('campo') : null;
        $limit = $request->has('num_registros') ? $request->input('num_registros') : 10;
        $page = $request->has('pagina') ? $request->input('pagina') : 1;
        $inicio = $limit * ($page - 1);

        $where = "";
        if($campo != null){
            $where = "(";
            $contador = count( $columnas );
            for($i = 0; $i < $contador; $i++){
                $where .= $columnas[$i] . " " . "LIKE '%" . $campo . "%' OR";
                $where .= " ";
            }
            $where = substr_replace($where, "", -3);
            $where .= ") and (deleted_at is null)";
        }
        else {
            $where = "(deleted_at is null)";
        }

        $total = DB::table('aplicacion_vehiculo')
                    ->selectRaw('count(*) as total')
                    ->whereRaw('deleted_at is null')
                    ->get();

        $filtrado = DB::table('aplicacion_vehiculo')
                    ->selectRaw('count(*) as total')
                    ->whereRaw($where)
                    ->get();

        $output = [];
        $output['totalRegistros'] = $total[0]->total;
        $output['totalFiltro'] = $filtrado[0]->total;
        $output['data'] = "";

        $datos = DB::table('aplicacion_vehiculo')
                    ->selectRaw( implode(',', $columnas) )
                    ->whereRaw($where)
                    ->offset($inicio)
                    ->take($limit)
                    ->get();

        $j = 0;
        if(count ($filtrado ) > 0){
            foreach( $datos as $dato ){
                $j += 1;
                $id = $dato->id;
                $modelo = $dato->modelo;
                $motor = $dato->motor;
                $cilindrada = $dato->cilindrada;
                $ano = $dato->ano;
                $sincronizado = $dato->sincronizado;

                $output['data'] .= "<tr>";
                $output['data'] .= "<td>$id</td>";
                $output['data'] .= "<td>$modelo</td>";
                $output['data'] .= "<td>$motor</td>";
                $output['data'] .= "<td>$cilindrada</td>";
                $output['data'] .= "<td>$ano</td>";
                $output['data'] .= "<td>$sincronizado</td>";
                $output['data'] .= '<td>
                    <section class="about_boton">
                        <div class="tex_tabla">
                            <form action="/jetfilter/catalogo/vehiculos/delete/'. $id .'" id="formulario-eliminar-'.$j.'" method="POST" name="formu" class="formulario-eliminar">
                                <input type="submit" onclick="eliminado(event,'.$j.')" value="" name="btnEliminar" class="del input" />
                            </form>
                        </div>
                        <div class="tex_tablas">
                            <a href="/jetfilter/catalogo/vehiculos/show/'. $id .'" class="ver input input_ver"></a>
                        </div>
                        <div class="tex_tablas">
                            <a href="/jetfilter/catalogo/vehiculos/edit/'. $id .'" class="edi input input_ver"></a>
                        </div>
                    </section>
                </td>';
                $output['data'] .= "</tr>";
            }
        }
        else {
            $output['data'] .= "<tr>";
            $output['data'] .= "<td>Sin resultados</td>";
            $output['data'] .= "</tr>";
        }

        $output['paginacion'] = "";
            $numeroInicio = 1;

            if($output['totalFiltro'] > 0){
                $totalPaginas = ceil($output['totalFiltro'] / $limit);

                if(($page - 4) > 1){
                    $numeroInicio = $page - 3;
                }
                
                $numeroFinal = $numeroInicio + 7;
                
                $numeroFinal = $numeroInicio + 7;
                
                if($numeroFinal > $totalPaginas){
                    $numeroFinal = $totalPaginas;
                }

                $output['paginacion'] .= "";
                if($page != 1){
                    $output['paginacion'] .= "<a onclick='getData(1)'  style='cursor: pointer;'>Primero</a>"; 
                }
                for($i = $numeroInicio; $i <= $numeroFinal; $i++){
                    if($page == $i){
                    $output['paginacion'] .= "<p>" . $i ." </p>";
                    }
                    else{
                        $output['paginacion'] .= "<a onclick='getData($i)'  style='cursor: pointer;'>".$i."</a>";
                    }
                }
                if($page != $totalPaginas){
                    $output['paginacion'] .= "<a onclick='getData($totalPaginas)'  style='cursor: pointer;'>Último</a>"; 
                }
            }

        return json_encode($output);
    }

    public function crear(){
        $aplicacion_marca = DB::table('aplicacion_marca')
                                    ->select('id', 'marca')
                                    ->get();

        return view('jetfilter.vehiculos.crear', compact('aplicacion_marca') );
    }

    public function store(Request $request){
        if( $request->has('vehiculos') ){
 
            $sincronizado = date("Ymd");

            $modelo = $request->input('modelo');
            $motor = $request->input('motor');
            $marca = $request->input('marca');
            $cilindrada = $request->input('cilindrada');
            $ano = $request->input('ano');

            $filtro_codificacion = VehiculoAplicacion::create([
                'id_marca' => $marca,
                'modelo' => $modelo,
                'motor' => $motor,
                'cilindrada' => $cilindrada,
                'ano' => $ano,
                'sincronizado' => $sincronizado,
            ]); 

            session(['creado' => $modelo]);
            return redirect()->route('jet-filter.catalogo.vehiculos');
        }
    }

    public function delete($id, Request $request){
        if( $request->routeIs('*.vehiculos.*') ){
            $vehiculo = VehiculoAplicacion::find($id);

            $fecha = date("Y-m-d H:i:s");
            $modelo = $vehiculo->modelo;
            $motor = $vehiculo->motor;

            $vehiculo->update([
                'deleted_at' => $fecha,
            ]); 

            return redirect()->route("jet-filter.catalogo.vehiculos")->with('eliminado', $modelo)->with('motor', $motor);
        }
    }

    public function show($id){
        $vehiculo_seleccionado = VehiculoAplicacion::find( $id );
        $id_marca = $vehiculo_seleccionado->id_marca;
        $marca_seleccionado = MarcaAplicacion::find( $id_marca );

        return view('jetfilter.vehiculos.show', compact('vehiculo_seleccionado', 'marca_seleccionado') );  
    }

    public function edit($id){
        $vehiculo_seleccionado = VehiculoAplicacion::find( $id );
        $id_marca = $vehiculo_seleccionado->id_marca;
        $marca_seleccionado = MarcaAplicacion::find( $id_marca );
        $aplicacion_marca = DB::table('aplicacion_marca')
                                    ->select('id', 'marca')
                                    ->get();
        

        return view('jetfilter.vehiculos.edit', compact( 'vehiculo_seleccionado', 'marca_seleccionado', 'aplicacion_marca' ) ); 
    }

    public function update($id, Request $request){
        $vehiculo = VehiculoAplicacion::find($id);
        $sincronizado = date("Ymd");
        $fecha_updated = date("Y-m-d H:i:s");  
        
        $modelo = $request->input('modelo');
        $motor = $request->input('motor');
        $marca = $request->input('marca');
        $cilindrada = $request->input('cilindrada');
        $ano = $request->input('ano');

        $vehiculo->update([
            'modelo' => $modelo,
            'motor' => $motor,
            'marca' => $marca,
            'cilindrada' => $cilindrada,
            'ano' => $ano,
            'sincronizado' => $sincronizado,
            'updated_at' => $fecha_updated,
        ]); 

        return redirect()->route('jet-filter.catalogo.vehiculos')->with('actualizado', $modelo);
    }
}
