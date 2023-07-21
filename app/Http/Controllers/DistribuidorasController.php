<?php

namespace App\Http\Controllers;

use App\Models\Distribuidora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistribuidorasController extends Controller
{
    public function distribuidoras(){
        return view('jetfilter.distribuidores');
    }

    public function distribuidoras_venezuela(){
        return view('jetfilter.distribuidoras.venezuela.index');
    }

    public function cargar(Request $request){
        $columnas = ['nombre', 'email', 'direccion', 'pais', 'estado', 'ciudad', 'telefono', 'telefono2'];
        $campo = ( $request->has('campo') ) ? $request->input('campo') : null;
        $limit = $request->has('num_registros') ? $request->input('num_registros') : 10;
        $page = $request->has('pagina') ? $request->input('pagina') : 1;
        $inicio = $limit * ($page - 1);
        $pais = $request->input('pais');

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

        $numFilasTotales = DB::table('distribuidoras')
                    ->whereNull('deleted_at') 
                    ->where('pais', $pais)
                    ->count();

        $numFilasFiltrado = DB::table('distribuidoras')
                    ->whereRaw($where)
                    ->where('pais', $pais)
                    ->count();

        $output = [];
        $output['totalRegistros'] = $numFilasTotales;
        $output['totalFiltro'] = $numFilasFiltrado;
        $output['data'] = "";

        $datos = DB::table('distribuidoras')
                    ->select('id', 'nombre', 'email', 'direccion', 'pais', 'estado', 'ciudad', 'telefono', 'telefono2')
                    ->whereRaw($where)
                    ->where('pais', $pais)
                    ->offset($inicio)
                    ->take($limit)
                    ->get();
            
        $j = 0;
        if( $numFilasFiltrado > 0){
            foreach( $datos as $dato ){
                $j += 1;
                $id = $dato->id;
                $nombre = $dato->nombre;
                $email = $dato->email;
                $direccion = $dato->direccion;
                $pais = $dato->pais;
                $estado = $dato->estado;
                $ciudad = $dato->ciudad;
                $telefono = $dato->telefono;
                $telefono2 = isset( $dato->telefono2 ) ? $dato->telefono2 : 'No tiene';

                $output['data'] .= "<tr>";
                $output['data'] .= "<td>$id</td>";
                $output['data'] .= "<td>$nombre</td>";
                $output['data'] .= "<td>$email</td>";
                $output['data'] .= "<td>$direccion</td>";
                $output['data'] .= "<td>$estado</td>";
                $output['data'] .= "<td>$ciudad</td>";
                $output['data'] .= "<td>$telefono</td>";
                $output['data'] .= "<td>$telefono2</td>";
                if( $pais == "Republica Dominicana"){
                    $pais = "Dominicana";
                }
                $pais = strtolower($pais);
                $output['data'] .= '<td>
                    <section class="about_boton">
                        <div class="tex_tabla">
                            <form action="/jetfilter/distribuidoras/delete/'. $id .'" id="formulario-eliminar-'.$j.'" method="POST" name="formu" class="formulario-eliminar">
                                <input value="'. $id .'" name="id" type="hidden" />
                                <input type="submit" onclick="eliminado(event,'.$j.')" value="" name="btnEliminar" class="del input" />
                            </form>
                        </div>
                        <div class="tex_tablas">
                            <a href="/jetfilter/distribuidoras/'. $pais .'/edit/'. $id .'" class="edi input input_ver"></a>
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

        return response()->json($output);
    }

    public function store(Request $request){
        $nombre = $request->input('nombre');
        $direccion = $request->input('direccion');
        $email = $request->input('email');
        $estado = $request->input('estado');
        $ciudad = $request->input('ciudad');
        $telefono = $request->input('telefono');
        $telefono2 = $request->input('telefono_2');
        $pais = $request->input('pais');

        $distribuidora = Distribuidora::create([
            'nombre' => $nombre,
            'email' => $email,
            'direccion' => $direccion,
            'pais' => $pais,
            'estado' => $estado,
            'ciudad' => $ciudad,
            'telefono' => $telefono,
            'telefono2' => $telefono2,
        ]);

        if( $pais == "Venezuela" ){
            return redirect()->route('jet-filter.distribuidoras.venezuela')->with('creado', $nombre);
        }
        else if( $pais == "Ecuador" ){
            return redirect()->route('jet-filter.distribuidoras.ecuador')->with('creado', $nombre);
        }
        if( $pais == "Republica Dominicana" ){
            return redirect()->route('jet-filter.distribuidoras.dominicana')->with('creado', $nombre);
        }
    }

    public function delete($id){
        $distribuidora = Distribuidora::find($id);
        $pais = $distribuidora->pais;
        $fecha = date("Y-m-d H:i:s");

        $distribuidora->update([
            'deleted_at' => $fecha,
        ]); 

        if( $pais == "Venezuela"){
            return redirect()->route("jet-filter.distribuidoras.venezuela")->with('eliminado', $distribuidora->nombre);
        }
        else if( $pais == "Ecuador" ){
            return redirect()->route("jet-filter.distribuidoras.ecuador")->with('eliminado', $distribuidora->nombre);
        }
        else if( $pais == "Republica Dominicana" ){
            return redirect()->route("jet-filter.distribuidoras.dominicana")->with('eliminado', $distribuidora->nombre);
        }
    }

    public function edit($id){
        $distribuidora = Distribuidora::find($id);

        return view('jetfilter.distribuidoras.venezuela.edit', compact('distribuidora') );
    }

    public function edit_ecuador($id){
        $distribuidora = Distribuidora::find($id);

        return view('jetfilter.distribuidoras.ecuador.edit', compact('distribuidora') );
    }

    public function edit_dominicana($id){
        $distribuidora = Distribuidora::find($id);

        return view('jetfilter.distribuidoras.dominicana.edit', compact('distribuidora') );
    }

    public function update(Request $request, $id){
        if( $request->has('btnimg') ){
            $distribuidora = Distribuidora::find($id);

            $nombre = $request->input('nombre');
            $email = $request->input('email');
            $estado = $request->input('estado');
            $ciudad = $request->input('ciudad');
            $telefono = $request->input('telefono');
            $telefono2 = ( $request->has('telefono_2') ) ? $request->input('telefono_2') : null;

            $distribuidora->update([
                'nombre' => $nombre,
                'email' => $email,
                'estado' => $estado,
                'ciudad' => $ciudad,
                'telefono' => $telefono,
                'telefono2' => $telefono2,
            ]); 

            if( $request->input('pais') == "Venezuela" ){
                return redirect()->route('jet-filter.distribuidoras.venezuela')->with('actualizado', $nombre);
            }
            else if ( $request->input('pais') == "Ecuador" ){
                return redirect()->route('jet-filter.distribuidoras.ecuador')->with('actualizado', $nombre);
            }
            else if ( $request->input('pais') == "Republica Dominicana" ){
                return redirect()->route('jet-filter.distribuidoras.dominicana')->with('actualizado', $nombre);
            }
            
        }
        else {

        }
    }
}
