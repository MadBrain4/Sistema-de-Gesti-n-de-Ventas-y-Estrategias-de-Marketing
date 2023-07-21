<?php

namespace App\Http\Controllers;

use App\Http\Requests\JetFilter\Categoria\StoreCategoria;
use App\Http\Requests\JetFilter\Categoria\UpdateCategoria;
use App\Models\Categoria;
use App\Models\Clase;
use App\Models\Producto;
use Illuminate\Http\Request;

use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    public function index(){
        return view('jetfilter.categorias.index');
    }

    public function cargar(Request $request){
        $campo = ( $request->has('campo') ) ? $request->input('campo') : null;
        $campo_busqueda = ( $campo != null ) ? "%" . $campo . "%" : null;

        $limit = $request->has( 'num_registros' ) ?  htmlspecialchars( $request->input( 'num_registros' ) ) : 10;
        $page = $request->has( 'pagina' ) ? htmlspecialchars( $request->input( 'pagina' ) ) : 1;
        $inicio = $limit * ($page - 1);

        $total = Categoria::from( "categorias as cat" )
                        ->join('productos as p', 'p.id', '=', 'cat.id_producto')
                        ->join('clases as cl', 'cl.id', '=', 'cat.id_clase')
                        ->whereNull('cl.deleted_at')
                        ->whereNull('cat.deleted_at')
                        ->whereNull('p.deleted_at')
                        ->count();

        if($campo != null){          
            $filtrado = Categoria::from( "categorias as cat" )
                        ->join('productos as p', 'p.id', '=', 'cat.id_producto')
                        ->join('clases as cl', 'cl.id', '=', 'cat.id_clase')
                        ->where(function ($query) use ($campo_busqueda) {
                            $query->where('cat.id', 'LIKE', $campo_busqueda);
                            $query->orWhere('cat.nombre', 'LIKE', $campo_busqueda);
                            $query->orWhere('p.producto', 'LIKE', $campo_busqueda);
                            $query->orWhere('cl.clase', 'LIKE', $campo_busqueda);
                        })
                        ->whereNull('cl.deleted_at')
                        ->whereNull('cat.deleted_at')
                        ->whereNull('p.deleted_at')
                        ->count();
        }
        else {
            $filtrado = Categoria::from( "categorias as cat" )
                    ->join('productos as p', 'p.id', '=', 'cat.id_producto')
                    ->join('clases as cl', 'cl.id', '=', 'cat.id_clase')
                    ->whereNull('cl.deleted_at')
                    ->whereNull('cat.deleted_at')
                    ->whereNull('p.deleted_at')
                    ->count();
        }

        $output = [];
        $output['totalRegistros'] = $total;
        $output['totalFiltro'] = $filtrado;
        $output['data'] = "";

        if($campo != null){     
            $datos = Categoria::from( "categorias as cat" )
                        ->select('p.producto as producto', 'cat.nombre as nombre', 'cl.clase as clase', 'cat.id as id')
                        ->join('productos as p', 'p.id', '=', 'cat.id_producto')
                        ->join('clases as cl', 'cl.id', '=', 'cat.id_clase')
                        ->where(function ($query) use ($campo_busqueda) {
                            $query->where('cat.id', 'LIKE', $campo_busqueda);
                            $query->orWhere('cat.nombre', 'LIKE', $campo_busqueda);
                            $query->orWhere('p.producto', 'LIKE', $campo_busqueda);
                            $query->orWhere('cl.clase', 'LIKE', $campo_busqueda);
                        })
                        ->whereNull('cl.deleted_at')
                        ->whereNull('cat.deleted_at')
                        ->whereNull('p.deleted_at')
                        ->offset($inicio)
                        ->take($limit)
                        ->orderBy('id')
                        ->get();
        }
        else {
            $datos = Categoria::from( "categorias as cat" )
                        ->select('p.producto as producto', 'cat.nombre as nombre', 'cl.clase as clase', 'cat.id as id')
                        ->join('productos as p', 'p.id', '=', 'cat.id_producto')
                        ->join('clases as cl', 'cl.id', '=', 'cat.id_clase')
                        ->whereNull('cl.deleted_at')
                        ->whereNull('cat.deleted_at')
                        ->whereNull('p.deleted_at')
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
                $nombre = $dato->nombre;
                $producto = $dato->producto;
                $clase = $dato->clase;
                $output['data'] .= "<tr>";
                $output['data'] .= "<td> ". $id . " </td>";
                $output['data'] .= "<td> ". $nombre . " </td>";
                $output['data'] .= "<td> ". $producto . " </td>";
                $output['data'] .= "<td> ". $clase . " </td>";
                $output['data'] .= '<td>
                    <section class="about_boton">
                        <div class="tex_tabla">
                            <form action="/jetfilter/catalogo/categorias/delete/'. $id .'" id="formulario-eliminar-'.$j.'" method="POST" name="formu" class="formulario-eliminar">
                                <input value="'. $id .'" name="id" type="hidden" />
                                <input type="submit" onclick="eliminado(event,'.$j.')" value="" name="btnEliminar" class="del input" />
                            </form>
                        </div>
                        <div class="tex_tablas">
                            <a href="/jetfilter/catalogo/categorias/edit/'. $id .'" class="edi input input_ver"></a>
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
        $clases = Clase::all();
        $productos = Producto::all();

        return view('jetfilter.categorias.crear', compact('productos', 'clases') );
    }

    public function store(StoreCategoria $request){
        $categoria = $request->input('categoria');
        $id_producto = $request->input('producto');
        $id_clase = $request->input('clase');
        $fecha_created = date("Y-m-d H:i:s"); 

        $producto_creado = Categoria::create([
            'nombre' => $categoria,
            'id_producto' => $id_producto,
            'id_clase' => $id_clase,
            'created_at' => $fecha_created
        ]); 

        return redirect()->route('jet-filter.catalogo.categorias.index')->with('creado', $categoria);
    }

    public function edit(Categoria $categoria){
        $clase_seleccionada = $categoria->clase;
        $producto_seleccionado = $categoria->producto;
        $clases = Clase::all();
        $productos = Producto::all();

        return view('jetfilter.categorias.edit', compact('categoria', 'clase_seleccionada', 'producto_seleccionado', 'clases', 'productos') );
    }

    public function update(Categoria $categoria, UpdateCategoria $request){
        $fecha_updated = date("Y-m-d H:i:s"); 
        $cate = $request->input('categoria');
        $clase = $request->input('clase');
        $producto = $request->input('producto');
        $categoria->update([
            'nombre' => $cate,
            'id_clase' => $clase,
            'id_producto' => $producto,
            'updated_at' => $fecha_updated,
        ]); 

        return redirect()->route('jet-filter.catalogo.categorias.index')->with('actualizado', $cate);
    }

    public function delete($id){
        $categoria = Categoria::find($id);
        $fecha = date("Y-m-d H:i:s");

        $categoria->update([
            'deleted_at' => $fecha,
        ]); 

        return redirect()->route("jet-filter.catalogo.categorias.index")->with('eliminado', $categoria->nombre);
    }
}
