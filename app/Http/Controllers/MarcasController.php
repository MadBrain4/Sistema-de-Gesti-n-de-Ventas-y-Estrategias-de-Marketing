<?php

namespace App\Http\Controllers;

use App\Models\MarcaAplicacion;
use Illuminate\Http\Request;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\DB;

class MarcasController extends Controller
{
    public function marcas(){
        $paginas = [10, 25, 50, 100];

        return view('jetfilter.marcas.marcas', compact('paginas') );
    }

    public function cargar(Request $request){
        $columnas = ['id', 'marca', 'sincronizado'];
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

        $total = DB::table('aplicacion_marca')
                    ->selectRaw('count(*) as total')
                    ->whereRaw('deleted_at is null')
                    ->get();

        $filtrado = DB::table('aplicacion_marca')
                    ->selectRaw('count(*) as total')
                    ->whereRaw($where)
                    ->get();

        $output = [];
        $output['totalRegistros'] = $total[0]->total;
        $output['totalFiltro'] = $filtrado[0]->total;
        $output['data'] = "";

        $datos = DB::table('aplicacion_marca')
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
                $marca = $dato->marca;
                $sincronizado = $dato->sincronizado;

                $output['data'] .= "<tr>";
                $output['data'] .= "<td>$id</td>";
                $output['data'] .= "<td>$marca</td>";
                $output['data'] .= "<td>$sincronizado</td>";

                $output['data'] .= '<td>
                    <section class="about_boton">
                        <div class="tex_tabla">
                            <form action="/jetfilter/catalogo/marcas/delete/'. $id .'" id="formulario-eliminar-'.$j.'" method="POST" name="formu" class="formulario-eliminar">
                                <input value="'. $id .'" name="id" type="hidden" />
                                <input type="submit" onclick="eliminado(event,'.$j.')" value="" name="btnEliminar" class="del input" />
                            </form>
                        </div>
                        <div class="tex_tablas">
                            <a href="/jetfilter/catalogo/marcas/show/'. $id .'" class="ver input input_ver"></a>
                        </div>
                        <div class="tex_tablas">
                            <a href="/jetfilter/catalogo/marcas/edit/'. $id .'" class="edi input input_ver"></a>
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
        return view('jetfilter.marcas.crear' );
    }

    public function store(Request $request){
        if( $request->has('marcas') ){
 
            $sincronizado = date("Ymd");
            $marca = $request->input('marca');

            $filtro_codificacion = MarcaAplicacion::create([
                'marca' => $marca,
                'sincronizado' => $sincronizado,
            ]); 

            session(['creado' => $marca]);
            return redirect()->route('jet-filter.catalogo.marcas');
        }
    }

    public function delete($id, Request $request){
        if( $request->routeIs('*.marcas.*') ){
            $marca = MarcaAplicacion::find($id);

            $fecha = date("Y-m-d H:i:s");
            $marca_aplicacion = $marca->marca;

            $marca->update([
                'deleted_at' => $fecha,
            ]); 

            return redirect()->route("jet-filter.catalogo.marcas")->with('eliminado', $marca_aplicacion);
        }
    }

    public function show($id){
        $marca_seleccionado = MarcaAplicacion::find( $id );

        return view('jetfilter.marcas.show', compact( 'marca_seleccionado' ) );  
    }

    public function edit($id){
        $marca_seleccionado = MarcaAplicacion::find( $id );

        return view('jetfilter.marcas.edit', compact( 'marca_seleccionado' ) ); 
    }

    public function update($id, Request $request){
        $marca = MarcaAplicacion::find($id);
        $sincronizado = date("Ymd");
        $fecha_updated = date("Y-m-d H:i:s");   

        $marca_editada = $request->input('marca');

        $marca->update([
            'marca' => $marca_editada,
            'sincronizado' => $sincronizado,
            'updated_at' => $fecha_updated,
        ]); 

        return redirect()->route('jet-filter.catalogo.marcas')->with('actualizado', $marca_editada);
    }
}
