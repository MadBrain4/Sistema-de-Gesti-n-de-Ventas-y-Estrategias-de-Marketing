<?php

namespace App\Http\Controllers;

use App\Models\Equivalencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FiltroCodificacion;

class EquivalenciaController extends Controller
{
    public function equivalencias(){
        $paginas = [10, 25, 50, 100, 250, 500, 2500, 10000];

        return view('jetfilter.equivalencias.equivalencias', compact('paginas'));
    }

    public function cargar(Request $request){
        $columnas = ['id', 'id_filtro', 'codigo', 'codigo_buscar', 'marca', 'codigo_marca', 'codigo_marca_buscar'];
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

        $total = DB::table('filtro_equivalencia')
                    ->selectRaw('count(*) as total')
                    ->whereRaw('deleted_at is null')
                    ->get();

        $filtrado = DB::table('filtro_equivalencia')
                    ->selectRaw('count(*) as total')
                    ->whereRaw($where)
                    ->get();

        $output = [];
        $output['totalRegistros'] = $total[0]->total;
        $output['totalFiltro'] = $filtrado[0]->total;
        $output['data'] = "";

        $datos = DB::table('filtro_equivalencia')
                    ->selectRaw( implode(',', $columnas) )
                    ->whereRaw($where)
                    ->offset($inicio)
                    ->take($limit)
                    ->get();

        $j = 0;
        if(count ($filtrado ) > 0){
            foreach( $datos as $dato ){
                $j = $j + 1;
                $id = $dato->id;
                $codigo = $dato->codigo;
                $id_filtro = $dato->id_filtro;
                $output['data'] .= "<tr>";
                $output['data'] .= "<td>" . $id . "</td>";
                $output['data'] .= "<td>" . $id_filtro . "</td>";
                $output['data'] .= "<td>" . $codigo . "</td>";
                $output['data'] .= "<td>" . $dato->codigo_buscar . "</td>";
                $output['data'] .= "<td>" . $dato->marca . "</td>";
                $output['data'] .= "<td>" . $dato->codigo_marca . "</td>";
                $output['data'] .= "<td>" . $dato->codigo_marca_buscar . "</td>";
                $output['data'] .= "</td>";
                $output['data'] .= '<td>
                                <section class="about_boton">
                                    <div class="tex_tabla">
                                        <form action="/jetfilter/catalogo/equivalencias/delete/ ' . $id . '" id="formulario-eliminar-'.$j.'" method="POST" name="formu" class="formulario-eliminar">
                                            <input value="'. $id .'" name="id" type="hidden" />
                                            <input value="' . $id_filtro . '" name="id_codigo" type="hidden" />
                                            <input type="submit" onclick="eliminado(event,'.$j.')" value="" name="btnEliminar" class="del input" />
                                        </form>
                                    </div>
                                    <div class="tex_tablas">
                                        <a href="/jetfilter/catalogo/equivalencias/show/'. $id .'" class="ver input input_ver"></a>
                                    </div>
                                    <div class="tex_tablas">
                                        <a href="/jetfilter/catalogo/equivalencias/edit/'. $id .'" class="edi input input_ver"></a>
                                    </div>
                                </section>
                            </td>';
            }
        }
        else {
            $output['data'] .= "<tr>";
            $output['data'] .= "<td>Sin resultados</td>";
            $output['data'] .= "</tr>";
        }

        $numeroInicio = 1;
        $output['paginacion'] = "";

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

        return json_encode( $output );
    }

    public function crear(){
        $equivalencia_marca = DB::table('equivalencia_marca')
                                    ->select('id', 'marca')
                                    ->whereNull('deleted_at') 
                                    ->get();

        return view('jetfilter.equivalencias.crear', compact('equivalencia_marca') );
    }

    public function store(Request $request){
        if( $request->has('equivalencia_nueva') ){
            $codigo = $request->input('codigo');
            $marca = $request->input('marca');
            $codigo_marca = $request->input('codigo_marca');

            $filtro =  FiltroCodificacion::select('id', 'codigo_buscar')
                                 ->where('codigo', '=', $codigo)
                                 ->get();

            if( count($filtro) > 0 ){
                $id_filtro = $filtro[0]->id;
                $codigo_buscar = $filtro[0]->codigo_buscar;
                $caracteres_a_reemplazar = ['-'," ","_"];
                $codigo_marca_buscar = str_replace($caracteres_a_reemplazar,'',$codigo_marca);

                $marca_datos = DB::table('equivalencia_marca')
                                        ->select('id', 'sincronizado')
                                        ->where('id', $marca)
                                        ->get();

                $id_marca = $marca_datos[0]->id;
                $sincronizado = date("Ymd");

                $filtro_equivalencia = Equivalencia::create([
                    'id_filtro' => $id_filtro,
                    'codigo' => $codigo,
                    'codigo_buscar' => $codigo_buscar,
                    'marca' => $marca,
                    'codigo_marca' => $codigo_marca,
                    'codigo_marca_buscar' => $codigo_marca_buscar,
                    'id_marca' => $id_marca,
                    'sincronizado' => $sincronizado
                ]); 

                return redirect()->route('jet-filter.catalogo.equivalencias')->with('creado', $codigo);
            }
            else {
                return redirect()->route('jet-filter.catalogo.equivalencias.crear')->with('codigo_incorrecto', 'true');
            }
        }
        else {

        }

    }

    public function delete($id, Request $request){
        if( $request->routeIs('*.equivalencias.*') ){
            $equivalencia = Equivalencia::find($id);
            $codigo_marca = $equivalencia->codigo_marca;
        }

        $fecha = date("Y-m-d H:i:s");

        if( $request->routeIs('*.equivalencias.*') ){
            $equivalencia->update([
                'deleted_at' => $fecha,
            ]); 

            $eliminado = $codigo_marca;
            return redirect()->route("jet-filter.catalogo.equivalencias")->with('eliminado', $eliminado);
        }
    }

    public function show($id){
        $equivalencia_seleccionada = Equivalencia::find($id);

        return view('jetfilter.equivalencias.show', compact( 'equivalencia_seleccionada' ) );
    }

    public function edit($id){
        $equivalencia_seleccionada = Equivalencia::find($id);

        $marca_act = DB::table('equivalencia_marca')
                                ->select('id','marca')
                                ->whereNull('deleted_at') 
                                ->get();
        
        return view('jetfilter.equivalencias.edit', compact( 'equivalencia_seleccionada', 'marca_act', 'id' ) );                        
    }

    public function update($id, Request $request){
        if( $request->has('equivalencia_marca') ){

            $codigo = $request->input('codigo');
            $marca = $request->input('marca');
            $codigo_marca = $request->input('codigo_marca');
            $fecha_updated = date('Y-m-d H:i:s');
            $sincronizado = date("Ymd");

            $filtro =  FiltroCodificacion::select('id', 'codigo_buscar')
                                 ->where('codigo', '=', $codigo)
                                 ->get();

            if( count($filtro) > 0 ){
                $equivalencia_seleccionada = Equivalencia::find($id);

                $caracteres_a_reemplazar = ['-'," ","_"];
                $codigo_marca_buscar = str_replace($caracteres_a_reemplazar,'',$codigo_marca);

                $id_marca_seleccionada = DB::table('equivalencia_marca')
                                    ->select('id', 'marca')
                                    ->where('id', $marca)
                                    ->get();

                $id_marca = $id_marca_seleccionada[0]->id;
                $marca = $id_marca_seleccionada[0]->marca;

                $equivalencia_seleccionada->update([
                    'id_filtro' => $filtro[0]->id,
                    'codigo' => $codigo,
                    'codigo_buscar' => $filtro[0]->codigo_buscar,
                    'marca' => $marca,
                    'codigo_marca' => $codigo_marca,
                    'codigo_marca_buscar' => $codigo_marca_buscar,
                    'id_marca' => $id_marca,
                    'sincronizado' => $sincronizado
                ]); 

                return redirect()->route('jet-filter.catalogo.equivalencias')->with('actualizado', $codigo);
            }
            else {
                return redirect()->route('jet-filter.catalogo.equivalencias.edit', $id)->with('codigo_incorrecto', 'true');
            }

        }
    }
}
