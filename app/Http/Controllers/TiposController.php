<?php

namespace App\Http\Controllers;

use App\Http\Requests\JetFilter\Tipo\StoreTipoRequest;
use App\Http\Requests\JetFilter\Tipo\UpdateTipoRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Tipo;

class TiposController extends Controller
{
    public function index(){
        return view('jetfilter.tipos.index' );
    }

    public function cargar(Request $request){
        $campo = ( $request->has('campo') ) ? $request->input('campo') : null;
        $campo_busqueda = ( $campo != null ) ? "%" . $campo . "%" : null;

        $limit = $request->has( 'num_registros' ) ?  htmlspecialchars( $request->input( 'num_registros' ) ) : 10;
        $page = $request->has( 'pagina' ) ? htmlspecialchars( $request->input( 'pagina' ) ) : 1;
        $inicio = $limit * ($page - 1);

        $total = Tipo::from( "tipos as tip" )
                        ->join('categorias as cat', 'cat.id', '=', 'tip.id_categoria')
                        ->join('productos as p', 'p.id', '=', 'cat.id_producto')
                        ->join('clases as cl', 'cl.id', '=', 'cat.id_clase')
                        ->whereNull('cl.deleted_at')
                        ->whereNull('cat.deleted_at')
                        ->whereNull('p.deleted_at')
                        ->count();

        if($campo != null){          
            $filtrado = Tipo::from( "tipos as tip" )
                                ->join('categorias as cat', 'cat.id', '=', 'tip.id_categoria')
                                ->join('productos as p', 'p.id', '=', 'cat.id_producto')
                                ->join('clases as cl', 'cl.id', '=', 'cat.id_clase')
                                ->where(function ($query) use ($campo_busqueda) {
                                    $query->Where('tip.tipo', 'LIKE', $campo_busqueda);
                                    $query->orWhere('tip.id', 'LIKE', $campo_busqueda);
                                    $query->orWhere('cat.nombre', 'LIKE', $campo_busqueda);
                                    $query->orWhere('p.producto', 'LIKE', $campo_busqueda);
                                    $query->orWhere('cl.clase', 'LIKE', $campo_busqueda);
                                })
                                ->whereNull('cl.deleted_at')
                                ->whereNull('cat.deleted_at')
                                ->whereNull('p.deleted_at')
                                ->whereNull('tip.deleted_at')
                                ->count();
        }
        else {
            $filtrado = Tipo::from( "tipos as tip" )
                                ->join('categorias as cat', 'cat.id', '=', 'tip.id_categoria')
                                ->join('productos as p', 'p.id', '=', 'cat.id_producto')
                                ->join('clases as cl', 'cl.id', '=', 'cat.id_clase')
                                ->whereNull('cl.deleted_at')
                                ->whereNull('cat.deleted_at')
                                ->whereNull('p.deleted_at')
                                ->whereNull('tip.deleted_at')
                                ->count();
        }

        $output = [];
        $output['totalRegistros'] = $total;
        $output['totalFiltro'] = $filtrado;
        $output['data'] = "";

        if($campo != null){     
            $datos = Tipo::from( "tipos as tip" )
                        ->select('tip.id as id', 'tip.tipo as tipo', 'cat.nombre as nombre', 'p.producto as producto', 'cl.clase as clase')
                        ->join('categorias as cat', 'cat.id', '=', 'tip.id_categoria')
                        ->join('productos as p', 'p.id', '=', 'cat.id_producto')
                        ->join('clases as cl', 'cl.id', '=', 'cat.id_clase')
                        ->where(function ($query) use ($campo_busqueda) {
                            $query->Where('tip.tipo', 'LIKE', $campo_busqueda);
                            $query->orwhere('tip.id', 'LIKE', $campo_busqueda);
                            $query->orWhere('cat.nombre', 'LIKE', $campo_busqueda);
                            $query->orWhere('p.producto', 'LIKE', $campo_busqueda);
                            $query->orWhere('cl.clase', 'LIKE', $campo_busqueda);
                        })
                        ->whereNull('cl.deleted_at')
                        ->whereNull('cat.deleted_at')
                        ->whereNull('p.deleted_at')
                        ->whereNull('tip.deleted_at')
                        ->offset($inicio)
                        ->take($limit)
                        ->orderBy('id')
                        ->get();
        }
        else {
            $datos = Tipo::from( "tipos as tip" )
                        ->select('tip.id as id', 'tip.tipo as tipo', 'cat.nombre as nombre', 'p.producto as producto', 'cl.clase as clase')
                        ->join('categorias as cat', 'cat.id', '=', 'tip.id_categoria')
                        ->join('productos as p', 'p.id', '=', 'cat.id_producto')
                        ->join('clases as cl', 'cl.id', '=', 'cat.id_clase')
                        ->whereNull('cl.deleted_at')
                        ->whereNull('cat.deleted_at')
                        ->whereNull('p.deleted_at')
                        ->whereNull('tip.deleted_at')
                        ->offset($inicio)
                        ->take($limit)
                        ->orderBy('id')
                        ->get();
        }

        $j = 0;
        if( $filtrado  > 0){
            foreach( $datos as $dato ){
                $j += 1;
                $id = $dato->id;
                $tipo = $dato->tipo;
                $categoria = $dato->nombre;
                $linea = $dato->clase;

                $output['data'] .= "<tr>";
                $output['data'] .= "<td> ". $id. " </td>";
                $output['data'] .= "<td> ". $tipo . " </td>";
                $output['data'] .= "<td> ". $categoria . " </td>";
                $output['data'] .= "<td> ". $linea . " </td>";
                $output['data'] .= '<td>
                    <section class="about_boton">
                        <div class="tex_tabla">
                            <form action="/jetfilter/catalogo/tipos/delete/'. $id .'" id="formulario-eliminar-'.$j.'" method="POST" name="formu" class="formulario-eliminar">
                                <input value="'. $id .'" name="id" type="hidden" />
                                <input type="submit" onclick="eliminado(event,'.$j.')" value="" name="btnEliminar" class="del input" />
                            </form>
                        </div>
                        <div class="tex_tablas">
                            <a href="/jetfilter/catalogo/tipos/edit/'. $id .'" class="edi input input_ver"></a>
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
        return response()->json($output);
    }

    public function crear(){
        $categorias = Categoria::all()->whereNull('deleted_at');

        return view('jetfilter.tipos.crear', compact('categorias') );
    }

    public function store(StoreTipoRequest $request){
        $tipo = $request->input('tipo');
        $id_categoria = $request->input('categoria');
        $fecha_created = date("Y-m-d H:i:s"); 

        $tipo_creado = Tipo::create([
            'tipo' => $tipo,
            'id_categoria' => $id_categoria,
            'created_at' => $fecha_created
        ]); 

        session(['creado' => true]);
        return redirect()->route('jet-filter.catalogo.tipos.index');
    }

    public function edit(Tipo $tipo){
        $categoria_seleccionada = $tipo->categoria;
        $categorias = Categoria::all()->whereNull('deleted_at');

        return view('jetfilter.tipos.edit', compact('tipo', 'categorias', 'categoria_seleccionada') );
    }

    public function update(Tipo $tipo, UpdateTipoRequest $request){
        $fecha_updated = date("Y-m-d H:i:s"); 
        $tip = $request->input('tipo');
        $id_categoria = $request->input('categoria');
        $tipo->update([
            'tipo' => $tip,
            'id_categoria' => $id_categoria,
            'updated_at' => $fecha_updated,
        ]); 

        session(['actualizado' => true]);
        return redirect()->route('jet-filter.catalogo.tipos.index');
    }

    public function delete($id){
        $tipo = Tipo::find($id);
        $fecha = date("Y-m-d H:i:s");

        $tipo->update([
            'deleted_at' => $fecha,
        ]); 

        return redirect()->route("jet-filter.catalogo.tipos.index")->with('eliminado', $tipo->tipo);
    }
}
