<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AireAutomotriz;
use App\Models\AireIndustrial;
use App\Models\CombustibleLinea;
use App\Models\Elemento;
use App\Models\Panel; 
use App\Models\Sellado;
use App\Models\FiltroCodificacion;
use App\Models\Tipo;

class CatalogoController extends Controller
{
    public function index(){
        return view('jetfilter.especificaciones');
    }

    public function cargarTabla(Request $request){
        $columnas = json_decode( $request->input('columnas') );
        $tabla = $this->listaTablas( $request->input('tabla') ) ? $request->input('tabla') : null;
        $campo = ( $request->has('campo') ) ? $request->input('campo') : null;

        if( $request->input('tabla') == 'espec_aireautomotriz' ){
            $enlace = 'aireautomotriz';
        }
        else if( $request->input('tabla') == 'espec_aireindustrial' ){
            $enlace = 'aireindustrial';
        }
        else if( $request->input('tabla') == 'espec_combustiblelinea' ){
            $enlace = 'combustiblelinea';
        }
        else if( $request->input('tabla') == 'espec_elemento' ){
            $enlace = 'elemento';
        }
        else if( $request->input('tabla') == 'espec_panel' ){
            $enlace = 'panel';
        }
        else if( $request->input('tabla') == 'espec_sellado' ){
            $enlace = 'sellado';
        }

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

        $limit = $request->has( 'num_registros' ) ?  htmlspecialchars( $request->input( 'num_registros' ) ) : 10;
        $page = $request->has( 'pagina' ) ? htmlspecialchars( $request->input( 'pagina' ) ) : 1;
        $inicio = $limit * ($page - 1);

        $total = DB::table($tabla)
                    ->selectRaw('count(*) as total')
                    ->whereRaw('deleted_at is null')
                    ->get();

        $filtrado = DB::table($tabla)
                    ->selectRaw('count(*) as total')
                    ->whereRaw($where)
                    ->get();

        $output = [];
        $output['totalRegistros'] = $total[0]->total;
        $output['totalFiltro'] = $filtrado[0]->total;
        $output['data'] = "";

        $datos = DB::table($tabla)
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
                $codigo = $dato->codigo;
                $id_filtro = $dato->id_filtro;
                $output['data'] .= "<tr>";
                foreach($columnas as $key => $value) {
                    if( $value == "valvulaal" && $dato->$value == 1){
                        $output['data'] .= "<td>Si</td>";
                    }
                    else if( $value == "valvulaal" && $dato->$value == 0){
                        $output['data'] .= "<td>No</td>";
                    }
                    else if( $value == "valvulaad" && $dato->$value == 1){
                        $output['data'] .= "<td>Si</td>";
                    }
                    else if( $value == "valvulaad" && $dato->$value == 0){
                        $output['data'] .= "<td>No</td>";
                    }
                    else{
                        $output['data'] .= "<td> ". $dato->$value . " </td>";
                    }
                }
                $output['data'] .= '<td>
                    <section class="about_boton">
                        <div class="tex_tabla">
                            <form action="/jetfilter/catalogo/' . $enlace . '/delete/'. $id .'" id="formulario-eliminar-'.$j.'" method="POST" name="formu" class="formulario-eliminar">
                                <input value="'. $id .'" name="id" type="hidden" />
                                <input value="'. $id_filtro .'" name="id_codigo" type="hidden" />
                                <input type="submit" onclick="eliminado(event,'.$j.')" value="" name="btnEliminar" class="del input" />
                            </form>
                        </div>
                        <div class="tex_tablas">
                            <a href="/jetfilter/catalogo/' . $enlace . '/show/'. $id .'" class="ver input input_ver"></a>
                        </div>
                        <div class="tex_tablas">
                            <a href="/jetfilter/catalogo/' . $enlace . '/edit/'. $id .'" class="edi input input_ver"></a>
                        </div>
                        <div class="tex_tablas">
                            <a href="/jetfilter/catalogo/' . $enlace . '/edit_imagenes/'. $id .'" class="foto input input_ver"></a>
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

    public function cargarAplicacionTabla(Request $request){
        $columnas = ['a.id', 'a.id_tipo', 'a_m.marca', 'a_v.modelo', 'a_v.motor','a.aplicacion','a.codigo','a.id_filtro','a.detalle'];
        $campo = ( $request->has('campo') ) ? $request->input('campo') : null;
        $where = '';
        $tipo = $request->input('tipo') ? $request->input('tipo') : 4;

        if( $request->input('tipo') == 1 ){
            $enlace = 'aplicacion_liviano';
        }
        else if( $request->input('tipo') == 2 ){
            $enlace = 'aplicacion_comercial'; 
        }
        else if( $request->input('tipo') == 3 ){
            $enlace = 'aplicacion_carretera'; 
        }
        else if( $request->input('tipo') == 4 ){
            $enlace = 'aplicacion_agricola'; 
        }

        if($campo != null){
            $where = "(a.id_tipo = $tipo) and ( ";
            $contador = count( $columnas );
            for($i = 0; $i < $contador; $i++){
                $where .= $columnas[$i] . " " . "LIKE '%" . $campo . "%' OR";
                $where .= " ";
            }
            $where = substr_replace($where, "", -3);
            $where .= ") and (a.deleted_at is null)";
        }
        else{
            $where = "(a.id_tipo = $tipo) and (a.deleted_at is null)";
        }


        $limit = $request->has('num_registros') ? $request->input('num_registros') : 10;
        $page = $request->has('pagina') ? $request->input('pagina') : 1;
        $inicio = $limit * ($page - 1);

        $registros_totales = DB::table('aplicacion as a')
                                ->selectRaw('count(*) as total')
                                ->join('aplicacion_marca as a_m', 'a_m.id', '=', 'a.id_marca')
                                ->join('aplicacion_vehiculo as a_v', 'a_v.id', '=', 'a.id_vehiculo')
                                ->where('a.id_tipo', '=', $tipo)
                                ->whereRaw('a.deleted_at is null')
                                ->get();
        $num_registros_totales = $registros_totales[0]->total;
    
        $registros_filtros = DB::table('aplicacion as a')
                                ->selectRaw('count(*) as filtrado')
                                ->join('aplicacion_marca as a_m', 'a_m.id', '=', 'a.id_marca')
                                ->join('aplicacion_vehiculo as a_v', 'a_v.id', '=', 'a.id_vehiculo')
                                ->whereRaw($where)
                                ->get();
        $num_registros_filtros = $registros_filtros[0]->filtrado;

        $aplicaciones = DB::table('aplicacion as a')
                                ->select('a.id as id', 'a.id_tipo as id_tipo', 'a_v.modelo as modelo', 'a_v.motor as motor', 'a_m.marca as marca', 'a.aplicacion as aplicacion', 'a.codigo as codigo', 'a.id_filtro as id_filtro', 'a.detalle as detalle')
                                ->join('aplicacion_marca as a_m', 'a_m.id', '=', 'a.id_marca')
                                ->join('aplicacion_vehiculo as a_v', 'a_v.id', '=', 'a.id_vehiculo')
                                ->whereRaw($where)
                                ->orderBy('a.id')
                                ->offset($inicio)
                                ->take($limit)
                                ->get();
        
        $output = [];
        $output['data'] = "";
        $output['totalRegistros'] = $num_registros_totales;
        $output['totalFiltro'] = $num_registros_filtros;
        $j = 0;

        if( $num_registros_filtros > 0){
            foreach( $aplicaciones as $dato ){
                $j += 1;
                $id = $dato->id;
                $codigo = $dato->codigo;
                $id_filtro = $dato->id_filtro;
                $output['data'] .= "<tr>";
                $output['data'] .= "<td> ". $dato->id . " </td>";
                if( $dato->id_tipo == 1 ){
                    $output['data'] .= "<td> Liviano </td>";
                }
                if( $dato->id_tipo == 2 ){
                    $output['data'] .= "<td> Comercial </td>";
                }
                if( $dato->id_tipo == 3 ){
                    $output['data'] .= "<td> Carretera </td>";
                }
                if( $dato->id_tipo == 4 ){
                    $output['data'] .= "<td> Agrícola </td>";
                }
                $output['data'] .= "<td> ". $dato->marca . " </td>";
                $output['data'] .= "<td> ". $dato->modelo . " </td>";
                $output['data'] .= "<td> ". $dato->motor . " </td>";
                $output['data'] .= "<td> ". $dato->aplicacion . " </td>";
                $output['data'] .= "<td> ". $dato->codigo . " </td>";
                $output['data'] .= "<td> ". $dato->id_filtro . " </td>";
                $output['data'] .= "<td> ". $dato->detalle . " </td>";
                $output['data'] .= '<td>
                    <section class="about_boton">
                        <div class="tex_tabla">
                            <form action="/jetfilter/catalogo/' . $enlace . '/delete/'. $id .'" id="formulario-eliminar-'.$j.'" method="POST" name="formu" class="formulario-eliminar">
                                <input value="'. $id .'" name="id" type="hidden" />
                                <input value="'. $id_filtro .'" name="id_codigo" type="hidden" />
                                <input type="submit" onclick="eliminado(event,'.$j.')" value="" name="btnEliminar" class="del input" />
                            </form>
                        </div>
                        <div class="tex_tablas">
                            <a href="/jetfilter/catalogo/' . $enlace . '/show/'. $id .'" class="ver input input_ver"></a>
                        </div>
                        <div class="tex_tablas">
                            <a href="/jetfilter/catalogo/' . $enlace . '/edit/'. $id .'" class="edi input input_ver"></a>
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
        $output['data'] .= "</tr>";

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

        return $output;
    }

    public function seleccionar_tipo(Request $request){
        $id_categoria = $request->input('id_categoria');

        $tipos = Tipo::where('id_categoria', $id_categoria)->get();

        $output = "";
        foreach($tipos as $tipo){
            $output .= '<option value="'.$tipo->id.'">';
            $output .= $tipo->tipo;
            $output .= '</option>';
        }

        return response()->json($output);
    }

    public function store(Request $request){
        if( $request->has('aire_automotriz') || $request->has('aire_industrial') || $request->has('combustible_linea') || $request->has('elemento') || $request->has('panel') || $request->has('sellado') ){
            $descripcion = "";
            $fecha = date("d-m-y");  
            $sincronizado = date("Ymd");

            if( $request->input('categoria') == 'aireautomotriz' || $request->input('categoria') == 'aireindustrial' ){
                $codigo = $request->input('codigo');
                $tipo = $request->input('tipo');
                $diametro_ext = $request->input('diametro_ext');
                $diametro_ext2 = $request->input('diametro_ext2');
                $diametro_int = $request->input('diametro_int');
                $diametro_int2 = $request->input('diametro_int2');
                $altura = $request->input('altura');
                $detalle1 = $request->input('detalle1');
                $detalle2 = $request->input('detalle2');
            }
            else if( $request->input('categoria') == 'combustiblelinea' ){
                $codigo = $request->input('codigo');
                $tipo = $request->input('tipo');
                $diametro_ext = $request->input('diametro_ext');
                $entrada = $request->input('entrada');
                $salida = $request->input('salida');
                $altura = $request->input('altura');
                $detalle1 = $request->input('detalle1');
                $detalle2 = $request->input('detalle2');
            }
            else if( $request->input('categoria') == 'elemento' ){
                $codigo = $request->input('codigo');
                $tipo = $request->input('tipo');
                $diametro_ext1 = $request->input('diametro_ext1');
                $diametro_int1 = $request->input('diametro_int1');
                $diametro_int2 = $request->input('diametro_int2');
                $altura = $request->input('altura');
                $detalle1 = $request->input('detalle1');
                $detalle2 = $request->input('detalle2');
            }
            else if( $request->input('categoria') == 'panel' ){
                $codigo = $request->input('codigo');
                $tipo = $request->input('tipo');
                $largo = $request->input('largo');
                $ancho = $request->input('ancho');
                $altura = $request->input('altura');
                $detalle1 = $request->input('detalle1');
                $detalle2 = $request->input('detalle2');
            }
            else if( $request->input('categoria') == 'sellado' ){
                $codigo = $request->input('codigo');
                $tipo = $request->input('tipo');
                $diametro_ext = $request->input('diametro_ext');
                $diametro_int = $request->input('diametro_int');
                $altura = $request->input('altura');
                $diametroempext = $request->input('diametroempext');
                $diametroempint = $request->input('diametroempint');
                $espesoremp = $request->input('espesoremp');
                $valvulaal = $request->input('valvulaal');
                $valvulaad = $request->input('valvulaad');
                $detalle1 = $request->input('detalle1');
                $detalle2 = $request->input('detalle2');
            }

            $caracteres_a_reemplazar = ['-'," ","_"];
            $codigo_buscar = str_replace($caracteres_a_reemplazar,'',$codigo);

            for ( $i = 0; $i < 4; $i++){
                $variable = "imagen" . ($i + 1);
                if( $request->hasFile( $variable ) && $request->file( $variable )->getClientOriginalExtension() == 'jpg' ){
                    if($i == 0){
                        $imagenes[$i] = $codigo;
                    }
                    else {
                        $imagenes[$i] = $codigo."-".($i);
                    }
                    $imagen = $request->file( $variable );
                    
                    $filename = $imagen->getClientOriginalName();
                    $ruta = "/images/fichas-filtros/web";

                    $variables = getimagesize ( $imagen );

                    if($variables[0] >= 1400 && $variables[0] <= 1600 && $variables[1] >= 1200 && $variables[1] <= 1300){
                        $imagen->move( public_path( $ruta ), $imagenes[$i] . '.jpg' );
                    }
                    else {
                        echo "No cumple con las dimensionmes";
                        echo "Ancho: ".$variables[0];
                        echo "Largo:".$variables[1];
                        $imagenes[$i] = "";

                    }
                }
                else {
                    $imagenes[$i] = "";
                }
            }

            $max_id_filtro = DB::table('filtro_codificacion')
                                ->selectRaw('MAX(id + 1) as mayor_id')
                                ->get();

            $max_filtro = $max_id_filtro[0]->mayor_id;

            $filtro_codificacion = FiltroCodificacion::create([
                'id' => $max_filtro,
                'clase' => 'aireautomotriz',
                'codigo' => $codigo,
                'codigo_buscar' => $codigo_buscar,
                'descripcion' => $descripcion,
                'precio' => rand(100, 100),
                'fecha_actualiza' => $fecha,
                'sincronizado' => $sincronizado,
            ]); 
            
            if ( $request->input('categoria') == 'aireautomotriz' ) {

                $aire_automotriz = AireAutomotriz::create([
                    'id_filtro' => $max_filtro,
                    'codigo' => $codigo,
                    'codigo_buscar' => $codigo_buscar,
                    'tipo' => $tipo,
                    'diametroext1' => $diametro_ext,
                    'diametroext2' => $diametro_ext2,
                    'diametroint1' => $diametro_int,
                    'diametroint2' => $diametro_int2,
                    'altura' => $altura,
                    'detalle1' => $detalle1,
                    'detalle2' => $detalle2,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                    'sincronizado' => $sincronizado,
                ]);
                $creado = $codigo;
                return redirect()->route("jet-filter.catalogo.aireautomotriz")->with('creado', $creado);
            }
            else if( $request->input('categoria') == 'aireindustrial' ) {
                $aire_industrial = AireIndustrial::create([
                    'id_filtro' => $max_filtro,
                    'codigo' => $codigo,
                    'codigo_buscar' => $codigo_buscar,
                    'tipo' => $tipo,
                    'diametroext1' => $diametro_ext,
                    'diametroext2' => $diametro_ext2,
                    'diametroint1' => $diametro_int,
                    'diametroint2' => $diametro_int2,
                    'altura' => $altura,
                    'detalle1' => $detalle1,
                    'detalle2' => $detalle2,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                    'sincronizado' => $sincronizado,
                ]);
                $creado = $codigo;
                return redirect()->route("jet-filter.catalogo.aireindustrial")->with('creado', $creado);
            }
            else if( $request->input('categoria') == 'combustiblelinea' ){
                $combustible_linea = CombustibleLinea::create([
                    'id_filtro' => $max_filtro,
                    'codigo' => $codigo,
                    'codigo_buscar' => $codigo_buscar,
                    'tipo' => $tipo,
                    'diametroext' => $diametro_ext,
                    'altura' => $altura,
                    'entrada' => $entrada,
                    'salida' => $salida,
                    'detalle1' => $detalle1,
                    'detalle2' => $detalle2,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                    'sincronizado' => $sincronizado,
                ]);
                $creado = $codigo;
                return redirect()->route("jet-filter.catalogo.combustiblelinea")->with('creado', $creado);
            }
            else if( $request->input('categoria') == 'elemento' ){
                $elemento = Elemento::create([
                    'id_filtro' => $max_filtro,
                    'codigo' => $codigo,
                    'codigo_buscar' => $codigo_buscar,
                    'tipo' => $tipo,
                    'diametroext1' => $diametro_ext1,
                    'diametroint1' => $diametro_int1,
                    'diametroint2' => $diametro_int2,
                    'altura' => $altura,
                    'detalle1' => $detalle1,
                    'detalle2' => $detalle2,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                    'sincronizado' => $sincronizado,
                ]);
                $creado = $codigo;
                return redirect()->route("jet-filter.catalogo.elemento")->with('creado', $creado);
            }
            else if( $request->input('categoria') == 'panel' ){
                $panel = Panel::create([
                    'id_filtro' => $max_filtro,
                    'codigo' => $codigo,
                    'codigo_buscar' => $codigo_buscar,
                    'tipo' => $tipo,
                    'largo' => $largo,
                    'ancho' => $ancho,
                    'altura' => $altura,
                    'detalle1' => $detalle1,
                    'detalle2' => $detalle2,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                    'sincronizado' => $sincronizado,
                ]);
                $creado = $codigo;
                return redirect()->route("jet-filter.catalogo.panel")->with('creado', $creado);
            }
            else if( $request->input('categoria') == 'sellado' ){
                $sellado = Sellado::create([
                    'id_filtro' => $max_filtro,
                    'codigo' => $codigo,
                    'codigo_buscar' => $codigo_buscar,
                    'tipo' => $tipo,
                    'diametroext' => $diametro_ext,
                    'diametroint' => $diametro_int,
                    'diametroempext' => $diametroempext,
                    'diametroempint' => $diametroempint,
                    'altura' => $altura,
                    'espesoremp' => $espesoremp,
                    'valvulaal' => $valvulaal,
                    'valvulaad' => $valvulaad,
                    'detalle1' => $detalle1,
                    'detalle2' => $detalle2,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                    'sincronizado' => $sincronizado,
                ]);
                $creado = $codigo;
                return redirect()->route("jet-filter.catalogo.sellado")->with('creado', $creado);
            }
        }
        else {
            return redirect()->route('jet-filter.catalogo.aireautomotriz.crear');
        }
    }

    public function update($id, Request $request){
        if( $request->has('btn_automotriz') || $request->has('btn_industrial') || $request->has('btn_combustible') || $request->has('btn_elemento') || $request->has('btn_panel') || $request->has('btn_sellado') ){
            if( $request->input('categoria') == 'aireautomotriz' ){
                $filtro_automotriz = AireAutomotriz::find($id);

                $id_filtro = $filtro_automotriz->id_filtro;

                $filtro_codificacion = FiltroCodificacion::find($id_filtro);
                
                $codigo = $request->input('codigo');
                $tipo = $request->input('tipo');
                $diametro_ext = $request->input('diametro_ext1');
                $diametro_ext2 = $request->input('diametro_ext2');
                $diametro_int = $request->input('diametro_int1');
                $diametro_int2 = $request->input('diametro_int2');
                $altura = $request->input('altura');
                $detalle1 = $request->input('detalle1');
                $detalle2 = $request->input('detalle2');
                $imagen[0] = $filtro_automotriz->imagen;
                $imagen[1] = $filtro_automotriz->imagen1;
                $imagen[2] = $filtro_automotriz->imagen2;
                $imagen[3] = $filtro_automotriz->imagen3;
            }
            else if( $request->input('categoria') == 'aireindustrial' ){
                $filtro_industrial = AireIndustrial::find($id);

                $id_filtro = $filtro_industrial->id_filtro;

                $filtro_codificacion = FiltroCodificacion::find($id_filtro);
                
                $codigo = $request->input('codigo');
                $tipo = $request->input('tipo');
                $diametro_ext = $request->input('diametro_ext1');
                $diametro_ext2 = $request->input('diametro_ext2');
                $diametro_int = $request->input('diametro_int1');
                $diametro_int2 = $request->input('diametro_int2');
                $altura = $request->input('altura');
                $detalle1 = $request->input('detalle1');
                $detalle2 = $request->input('detalle2');
                $imagen[0] = $filtro_industrial->imagen;
                $imagen[1] = $filtro_industrial->imagen1;
                $imagen[2] = $filtro_industrial->imagen2;
                $imagen[3] = $filtro_industrial->imagen3;
            }
            else if( $request->input('categoria') == 'combustiblelinea' ){
                $filtro_combustible = CombustibleLinea::find($id);

                $id_filtro = $filtro_combustible->id_filtro;

                $filtro_codificacion = FiltroCodificacion::find($id_filtro);
                
                $codigo = $request->input('codigo');
                $tipo = $request->input('tipo');
                $diametro_ext = $request->input('diametro_ext');
                $altura = $request->input('altura');
                $entrada = $request->input('entrada');
                $salida = $request->input('salida');
                $detalle1 = $request->input('detalle1');
                $detalle2 = $request->input('detalle2');
                $imagen[0] = $filtro_combustible->imagen;
                $imagen[1] = $filtro_combustible->imagen1;
                $imagen[2] = $filtro_combustible->imagen2;
                $imagen[3] = $filtro_combustible->imagen3;
            }
            else if( $request->input('categoria') == 'elemento' ){
                $filtro_elemento = Elemento::find($id);

                $id_filtro = $filtro_elemento->id_filtro;

                $filtro_codificacion = FiltroCodificacion::find($id_filtro);
                
                $codigo = $request->input('codigo');
                $tipo = $request->input('tipo');
                $diametro_ext = $request->input('diametro_ext');
                $diametroint1 = $request->input('diametroint1');
                $diametroint2 = $request->input('diametroint2');
                $altura = $request->input('altura');
                $detalle1 = $request->input('detalle1');
                $detalle2 = $request->input('detalle2');
                $imagen[0] = $filtro_elemento->imagen;
                $imagen[1] = $filtro_elemento->imagen1;
                $imagen[2] = $filtro_elemento->imagen2;
                $imagen[3] = $filtro_elemento->imagen3;
            }
            else if( $request->input('categoria') == 'panel' ){
                $filtro_panel = Panel::find($id);

                $id_filtro = $filtro_panel->id_filtro;

                $filtro_codificacion = FiltroCodificacion::find($id_filtro);
                
                $codigo = $request->input('codigo');
                $tipo = $request->input('tipo');
                $largo = $request->input('largo');
                $ancho = $request->input('ancho');
                $altura = $request->input('altura');
                $detalle1 = $request->input('detalle1');
                $detalle2 = $request->input('detalle2');
                $imagen[0] = $filtro_panel->imagen;
                $imagen[1] = $filtro_panel->imagen1;
                $imagen[2] = $filtro_panel->imagen2;
                $imagen[3] = $filtro_panel->imagen3;
            }
            else if( $request->input('categoria') == 'sellado' ){
                $filtro_sellado = Sellado::find($id);

                $id_filtro = $filtro_sellado->id_filtro;

                $filtro_codificacion = FiltroCodificacion::find($id_filtro);
                
                $codigo = $request->input('codigo');
                $tipo = $request->input('tipo');
                $diametroext = $request->input('diametroext');
                $diametroint = $request->input('diametroint');
                $diametroempext = $request->input('diametroempext');
                $diametroempint = $request->input('diametroempint');
                $altura = $request->input('altura');
                $espesoremp = $request->input('espesoremp');
                $valvulaal = $request->input('valvulaal');
                $valvulaad = $request->input('valvulaad');
                $detalle1 = $request->input('detalle1');
                $detalle2 = $request->input('detalle2');
                $imagen[0] = $filtro_sellado->imagen;
                $imagen[1] = $filtro_sellado->imagen1;
                $imagen[2] = $filtro_sellado->imagen2;
                $imagen[3] = $filtro_sellado->imagen3;
            }

            $caracteres_a_reemplazar = ['-'," ","_"];
            $codigo_buscar = str_replace($caracteres_a_reemplazar,'',$codigo);

            for ( $i = 0; $i < 4; $i++){
                $variable = "imagen" . ($i + 1);
                if( $request->hasFile( $variable ) && $request->file( $variable )->getClientOriginalExtension() == 'jpg' ){
                    if($i == 0){
                        $imagenes[$i] = $codigo;
                    }
                    else {
                        $imagenes[$i] = $codigo . "-" . ($i);
                    }
                    $archivo_imagen = $request->file( $variable );
                    
                    $ruta = "/images/fichas-filtros/web";

                    $variables = getimagesize ( $archivo_imagen );

                    if($variables[0] >= 1400 && $variables[0] <= 1600 && $variables[1] >= 1200 && $variables[1] <= 1300){
                        $archivo_imagen->move( public_path( $ruta ), $imagenes[$i] . '.jpg' );
                    }
                    else {
                        echo "No cumple con las dimensionmes";
                        echo "Ancho: ".$variables[0];
                        echo "Largo:".$variables[1];
                        $imagenes[$i] = $imagen[$i];
                    }
                }
                else {
                    $imagenes[$i] = $imagen[$i];
                }
            }

            date_default_timezone_set('America/Caracas');
            $sincronizado = date("Ymd");
            $fecha_updated = date("Y-m-d H:i:s"); 
            $fecha_actualiza = date("d-m-y");

            $filtro_codificacion->update([
                'codigo' => $codigo,
                'codigo_buscar' => $codigo_buscar,
                'fecha_actualiza' => $fecha_actualiza,
                'sincronizado' => $sincronizado,
                'updated_at' => $fecha_updated,
            ]); 

            if ( $request->input('categoria') == 'aireautomotriz' ) {
                $filtro_automotriz->update([
                    'codigo' => $codigo,
                    'codigo_buscar' => $codigo_buscar,
                    'tipo' => $tipo,
                    'diametroext1' => $diametro_ext,
                    'diametroext2' => $diametro_ext2,
                    'diametroint1' => $diametro_int,
                    'diametroint2' => $diametro_int2,
                    'altura' => $altura,
                    'detalle1' => $detalle1,
                    'detalle2' => $detalle2,
                    'sincronizado' => $sincronizado,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                ]);

                $actualizado = $codigo;
                return redirect()->route("jet-filter.catalogo.aireautomotriz")->with('actualizado', $actualizado);
            }
            else if ( $request->input('categoria') == 'aireindustrial' ) {

                $filtro_industrial->update([
                    'codigo' => $codigo,
                    'codigo_buscar' => $codigo_buscar,
                    'tipo' => $tipo,
                    'diametroext1' => $diametro_ext,
                    'diametroext2' => $diametro_ext2,
                    'diametroint1' => $diametro_int,
                    'diametroint2' => $diametro_int2,
                    'altura' => $altura,
                    'detalle1' => $detalle1,
                    'detalle2' => $detalle2,
                    'sincronizado' => $sincronizado,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                ]);

                $actualizado = $codigo;
                return redirect()->route("jet-filter.catalogo.aireindustrial")->with('actualizado', $actualizado);
            }
            else if ( $request->input('categoria') == 'combustiblelinea' ) {

                $filtro_combustible->update([
                    'codigo' => $codigo,
                    'codigo_buscar' => $codigo_buscar,
                    'tipo' => $tipo,
                    'diametroext' => $diametro_ext,
                    'altura' => $altura,
                    'entrada' => $entrada,
                    'salida' => $salida,
                    'detalle1' => $detalle1,
                    'detalle2' => $detalle2,
                    'sincronizado' => $sincronizado,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                ]);

                $actualizado = $codigo;
                return redirect()->route("jet-filter.catalogo.combustiblelinea")->with('actualizado', $actualizado);
            }
            else if ( $request->input('categoria') == 'elemento' ) {

                $filtro_elemento->update([
                    'codigo' => $codigo,
                    'codigo_buscar' => $codigo_buscar,
                    'tipo' => $tipo,
                    'diametroext' => $diametro_ext,
                    'diametroint1' => $diametroint1,
                    'diametroint2' => $diametroint2,
                    'altura' => $altura,
                    'detalle1' => $detalle1,
                    'detalle2' => $detalle2,
                    'sincronizado' => $sincronizado,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                ]);

                $actualizado = $codigo;
                return redirect()->route("jet-filter.catalogo.elemento")->with('actualizado', $actualizado);
            }
            else if ( $request->input('categoria') == 'panel' ) {

                $filtro_panel->update([
                    'codigo' => $codigo,
                    'codigo_buscar' => $codigo_buscar,
                    'tipo' => $tipo,
                    'largo' => $largo,
                    'ancho' => $ancho,
                    'altura' => $altura,
                    'detalle1' => $detalle1,
                    'detalle2' => $detalle2,
                    'sincronizado' => $sincronizado,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                ]);

                $actualizado = $codigo;
                return redirect()->route("jet-filter.catalogo.panel")->with('actualizado', $actualizado);
            }
            else if ( $request->input('categoria') == 'sellado' ) {

                $filtro_sellado->update([
                    'codigo' => $codigo,
                    'codigo_buscar' => $codigo_buscar,
                    'diametroext' => $diametroext,
                    'diametroint' => $diametroint,
                    'diametroempext' => $diametroempext,
                    'diametroempint' => $diametroempint,
                    'altura' => $altura,
                    'espesoremp' => $espesoremp,
                    'valvulaal' => $valvulaal,
                    'valvulaad' => $valvulaad,
                    'detalle1' => $detalle1,
                    'detalle2' => $detalle2,
                    'sincronizado' => $sincronizado,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                ]);

                $actualizado = $codigo;
                return redirect()->route("jet-filter.catalogo.sellado")->with('actualizado', $actualizado);
            }
        }
    }

    public function update_imagenes($id, Request $request){
        if( $request->has('btnimg') ){

            date_default_timezone_set('America/Caracas');
            $sincronizado = date("Ymd");
            $fecha_updated = date("Y-m-d H:i:s"); 
            $fecha_actualiza = date("d-m-y");  

            if( $request->input('categoria') == 'aireautomotriz' ){
                $filtro_automotriz = AireAutomotriz::find($id);                     
                
                $codigo = $filtro_automotriz->codigo;
                $id_filtro = $filtro_automotriz->id_filtro;                                     
                $imagen[0] = $filtro_automotriz->imagen;        
                $imagen[1] = $filtro_automotriz->imagen1; 
                $imagen[2] = $filtro_automotriz->imagen2; 
                $imagen[3] = $filtro_automotriz->imagen3;
            }
            else if( $request->input('categoria') == 'aireindustrial' ){
                $filtro_industrial = AireIndustrial::find($id);                     
                
                $codigo = $filtro_industrial->codigo;
                $id_filtro = $filtro_industrial->id_filtro;                                     
                $imagen[0] = $filtro_industrial->imagen;        
                $imagen[1] = $filtro_industrial->imagen1; 
                $imagen[2] = $filtro_industrial->imagen2; 
                $imagen[3] = $filtro_industrial->imagen3;
            }
            else if( $request->input('categoria') == 'combustiblelinea' ){
                $filtro_combustible = CombustibleLinea::find($id);                     
                
                $codigo = $filtro_combustible->codigo;
                $id_filtro = $filtro_combustible->id_filtro;                                     
                $imagen[0] = $filtro_combustible->imagen;        
                $imagen[1] = $filtro_combustible->imagen1; 
                $imagen[2] = $filtro_combustible->imagen2; 
                $imagen[3] = $filtro_combustible->imagen3;
            }
            else if( $request->input('categoria') == 'elemento' ){
                $filtro_elemento = Elemento::find($id);                     
                
                $codigo = $filtro_elemento->codigo;
                $id_filtro = $filtro_elemento->id_filtro;                                     
                $imagen[0] = $filtro_elemento->imagen;        
                $imagen[1] = $filtro_elemento->imagen1; 
                $imagen[2] = $filtro_elemento->imagen2; 
                $imagen[3] = $filtro_elemento->imagen3;
            }
            else if( $request->input('categoria') == 'panel' ){
                $filtro_panel = Panel::find($id);                     
                
                $codigo = $filtro_panel->codigo;
                $id_filtro = $filtro_panel->id_filtro;                                     
                $imagen[0] = $filtro_panel->imagen;        
                $imagen[1] = $filtro_panel->imagen1; 
                $imagen[2] = $filtro_panel->imagen2; 
                $imagen[3] = $filtro_panel->imagen3;
            }
            else if( $request->input('categoria') == 'sellado' ){
                $filtro_sellado = Sellado::find($id);                     
                
                $codigo = $filtro_sellado->codigo;
                $id_filtro = $filtro_sellado->id_filtro;                                     
                $imagen[0] = $filtro_sellado->imagen;        
                $imagen[1] = $filtro_sellado->imagen1; 
                $imagen[2] = $filtro_sellado->imagen2; 
                $imagen[3] = $filtro_sellado->imagen3;
            }

            $filtro_codificacion = FiltroCodificacion::find($id_filtro);
                
            for ( $i = 0; $i < 4; $i++){
                $variable = "imagen" . ($i + 1);
                if( $request->hasFile( $variable ) && $request->file( $variable )->getClientOriginalExtension() == 'jpg' ){
                    if($i == 0){
                        $imagenes[$i] = $codigo;
                    }
                    else {
                        $imagenes[$i] = $codigo . "-" . ($i);
                    }
                    $archivo_imagen = $request->file( $variable );
                    
                    $ruta = "/images/fichas-filtros/web";
    
                    $variables = getimagesize ( $archivo_imagen );
    
                    if($variables[0] >= 1400 && $variables[0] <= 1600 && $variables[1] >= 1200 && $variables[1] <= 1300){
                        $archivo_imagen->move( public_path( $ruta ), $imagenes[$i] . '.jpg' );
                    }
                    else {
                        echo "No cumple con las dimensionmes";
                        echo "Ancho: ".$variables[0];
                        echo "Largo:".$variables[1];
                        $imagenes[$i] = $imagen[$i];
                    }
                }
                else {
                    $imagenes[$i] = $imagen[$i];
                }
            }

            $filtro_codificacion->update([
                'fecha_actualiza' => $fecha_actualiza,
                'sincronizado' => $sincronizado,
                'updated_at' => $fecha_updated,
            ]); 

            if ( $request->input('categoria') == 'aireautomotriz' ) {
                $filtro_automotriz->update([
                    'sincronizado' => $sincronizado,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                    'updated_at' => $fecha_updated,
                ]);

                $actualizado_imagenes = $codigo;
                return redirect()->route("jet-filter.catalogo.aireautomotriz")->with('actualizado_imagenes', $actualizado_imagenes);
            }
            else if ( $request->input('categoria') == 'aireindustrial' ) {
                $filtro_industrial->update([
                    'sincronizado' => $sincronizado,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                    'updated_at' => $fecha_updated,
                ]);

                $actualizado_imagenes = $codigo;
                return redirect()->route("jet-filter.catalogo.aireindustrial")->with('actualizado_imagenes', $actualizado_imagenes);
            }
            else if ( $request->input('categoria') == 'combustiblelinea' ) {
                $filtro_combustible->update([
                    'sincronizado' => $sincronizado,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                    'updated_at' => $fecha_updated,
                ]);

                $actualizado_imagenes = $codigo;
                return redirect()->route("jet-filter.catalogo.combustiblelinea")->with('actualizado_imagenes', $actualizado_imagenes);
            }
            else if ( $request->input('categoria') == 'elemento' ) {
                $filtro_elemento->update([
                    'sincronizado' => $sincronizado,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                    'updated_at' => $fecha_updated,
                ]);

                $actualizado_imagenes = $codigo;
                return redirect()->route("jet-filter.catalogo.elemento")->with('actualizado_imagenes', $actualizado_imagenes);
            }
            else if ( $request->input('categoria') == 'panel' ) {
                $filtro_panel->update([
                    'sincronizado' => $sincronizado,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                    'updated_at' => $fecha_updated,
                ]);

                $actualizado_imagenes = $codigo;
                return redirect()->route("jet-filter.catalogo.panel")->with('actualizado_imagenes', $actualizado_imagenes);
            }
            else if ( $request->input('categoria') == 'sellado' ) {
                $filtro_sellado->update([
                    'sincronizado' => $sincronizado,
                    'imagen' => $imagenes[0],
                    'imagen1' => $imagenes[1],
                    'imagen2' => $imagenes[2],
                    'imagen3' => $imagenes[3],
                    'updated_at' => $fecha_updated,
                ]);

                $actualizado_imagenes = $codigo;
                return redirect()->route("jet-filter.catalogo.sellado")->with('actualizado_imagenes', $actualizado_imagenes);
            }
        }
    }

    public function listaTablas($nombreTabla){
        $tablasPermitidas = array('espec_aireautomotriz','espec_aireindustrial','espec_combustiblelinea','espec_elemento','espec_panel','espec_sellado');
        $estado = in_array($nombreTabla, $tablasPermitidas);
        return $estado;
    }

    function listaTipos($numeroTipo){
        $tiposPermitidos = array(1,2,3,4);
        $estado = in_array($numeroTipo, $tiposPermitidos);
        return $estado;
    }
}
