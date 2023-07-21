<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AireAutomotriz;
use App\Models\FiltroCodificacion;
use App\Http\Requests\JetFilter\AireAutomotriz\AireAutomotrizStoreRequest;
use App\Http\Requests\JetFilter\AireAutomotriz\AireAutomotrizUpdateRequest;
use App\Models\Categoria;

class AireAutomotrizController extends Controller
{
    public function aireautomotriz(){
        $paginas = [10, 25, 50, 100];

        return view('jetfilter.aire_automotriz.espec_aireautomotriz', compact('paginas') );
    }

    public function cargar(Request $request){
        $campo = ( $request->has('campo') ) ? $request->input('campo') : null;
        $campo = '%' . $campo . '%';
        $limit = $request->has( 'num_registros' ) ?  htmlspecialchars( $request->input( 'num_registros' ) ) : 10;
        $page = $request->has( 'pagina' ) ? htmlspecialchars( $request->input( 'pagina' ) ) : 1;
        $inicio = $limit * ($page - 1);

        if($campo != null){
            $filtrado = AireAutomotriz::whereNull('deleted_at')
                    ->where(function ($query) use ($campo) {
                        $query->where('codigo', 'LIKE', $campo)
                            ->orWhere('codigo_buscar', 'LIKE', $campo)
                            ->orWhere('diametroext1', 'LIKE', $campo)
                            ->orWhere('diametroext2', 'LIKE', $campo)
                            ->orWhere('diametroint1', 'LIKE', $campo)
                            ->orWhere('diametroint2', 'LIKE', $campo)
                            ->orWhere('altura', 'LIKE', $campo)
                            ->orWhere('detalle1', 'LIKE', $campo)
                            ->orWhere('detalle2', 'LIKE', $campo);
                    })
                    ->count();

            $datos = AireAutomotriz::select('id', 'id_filtro', 'codigo', 'codigo_buscar', 'diametroext1', 'diametroext2', 'diametroint1', 'diametroint2', 'altura', 'detalle1', 'detalle2')
                ->whereNull('deleted_at')
                ->where(function ($query) use ($campo) {
                    $query->where('codigo', 'LIKE', $campo)
                        ->orWhere('codigo_buscar', 'LIKE', $campo)
                        ->orWhere('diametroext1', 'LIKE', $campo)
                        ->orWhere('diametroext2', 'LIKE', $campo)
                        ->orWhere('diametroint1', 'LIKE', $campo)
                        ->orWhere('diametroint2', 'LIKE', $campo)
                        ->orWhere('altura', 'LIKE', $campo)
                        ->orWhere('detalle1', 'LIKE', $campo)
                        ->orWhere('detalle2', 'LIKE', $campo);
                })
                ->take($limit)
                ->offset($inicio)
                ->get();
        }
        else {
            $filtrado = AireAutomotriz::whereNull('deleted_at')
                    ->get();
        }

        $total = AireAutomotriz::whereNull('deleted_at')
                    ->count();

        $output = [];
        $output['totalRegistros'] = $total;
        $output['totalFiltro'] = $filtrado;
        $output['data'] = "";

        $j = 0;
        if( $filtrado  > 0 ){
            foreach( $datos as $dato ){
                $j += 1;
                $id = $dato->id;
                $id_filtro = $dato->id_filtro;
                $aire_automotriz = AireAutomotriz::find($id);
                $tipo = $aire_automotriz->filtro->tipo->tipo;

                $output['data'] .= "<tr>";
                $output['data'] .= "<td> ". $dato->codigo . " </td>";
                $output['data'] .= "<td> ". $dato->codigo_buscar . " </td>";
                $output['data'] .= "<td> ". $tipo . " </td>";
                $output['data'] .= "<td> ". $dato->diametroext1 . " </td>";
                $output['data'] .= "<td> ". $dato->diametroext2 . " </td>";
                $output['data'] .= "<td> ". $dato->diametroint1 . " </td>";
                $output['data'] .= "<td> ". $dato->diametroint2 . " </td>";
                $output['data'] .= "<td> ". $dato->altura . " </td>";
                $output['data'] .= "<td> ". $dato->detalle1 . " </td>";
                $output['data'] .= "<td> ". $dato->detalle2 . " </td>";

                $output['data'] .= '<td>
                    <section class="about_boton">
                        <div class="tex_tabla">
                            <form action="/jetfilter/catalogo/aireautomotriz/delete/'. $id .'" id="formulario-eliminar-'.$j.'" method="POST" name="formu" class="formulario-eliminar">
                                <input value="'. $id .'" name="id" type="hidden" />
                                <input value="'. $id_filtro .'" name="id_codigo" type="hidden" />
                                <input type="submit" onclick="eliminado(event,'.$j.')" value="" name="btnEliminar" class="del input" />
                            </form>
                        </div>
                        <div class="tex_tablas">
                            <a href="/jetfilter/catalogo/aireautomotriz/show/'. $id .'" class="ver input input_ver"></a>
                        </div>
                        <div class="tex_tablas">
                            <a href="/jetfilter/catalogo/aireautomotriz/edit/'. $id .'" class="edi input input_ver"></a>
                        </div>
                        <div class="tex_tablas">
                            <a href="/jetfilter/catalogo/aireautomotriz/edit_imagenes/'. $id .'" class="foto input input_ver"></a>
                        </div>
                    </section>
                </td>';
                $output['data'] .= "</tr>";
            }
        }

        $output['paginacion'] = "";

        $numeroInicio = 1;
        if( $output['totalFiltro'] > 0 ){
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

    public function crear(Request $request){
        $categorias = Categoria::whereNull('deleted_at')
                        ->where('id_clase', 1)
                        ->get();

        return view('jetfilter.aire_automotriz.crear', compact('categorias') );
    }

    public function store(AireAutomotrizStoreRequest $request){
        $codigo = $request->input('codigo');

        $descripcion = "";
        $fecha = date("d-m-y");  
        $sincronizado = date("Ymd");

        $codigo = $request->input('codigo');
        $tipo = $request->input('tipo');
        $diametro_ext = $request->input('diametro_ext');
        $diametro_ext2 = $request->input('diametro_ext2');
        $diametro_int = $request->input('diametro_int');
        $diametro_int2 = $request->input('diametro_int2');
        $altura = $request->input('altura');
        $detalle1 = ( $request->input('detalle1') == '') ? 'N/D' : $request->input('detalle1');
        $detalle2 = ( $request->input('detalle2') == '') ? 'N/D' : $request->input('detalle2');

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
                    $imagen->move( public_path( $ruta ), $imagenes[$i] . '.jpg' );
                }
                else {
                    $imagenes[$i] = "";
                }
            }

            $max_filtro = FiltroCodificacion::max('id') + 1;
            $clase = 1;
            $filtro_codificacion = FiltroCodificacion::create([
                'id' => $max_filtro,
                'id_clase' => $clase,
                'codigo' => $codigo,
                'codigo_buscar' => $codigo_buscar,
                'descripcion' => $descripcion,
                'precio' => rand(100, 200),
                'fecha_actualiza' => $fecha,
                'sincronizado' => $sincronizado,
                'id_tipo' => $tipo
            ]); 

            $aire_automotriz = AireAutomotriz::create([
                'id_filtro' => $max_filtro,
                'codigo' => $codigo,
                'codigo_buscar' => $codigo_buscar,
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

    public function show($id){
        $filtro_automotriz = AireAutomotriz::find($id);

        $imagenes[0] = $filtro_automotriz->imagen;
        $imagenes[1] = $filtro_automotriz->imagen1;
        $imagenes[2] = $filtro_automotriz->imagen2;
        $imagenes[3] = $filtro_automotriz->imagen3;

        $tipo = $filtro_automotriz->filtro->tipo->tipo;

        return view('jetfilter.aire_automotriz.show', compact( 'filtro_automotriz', 'imagenes', 'tipo' ));
    }

    public function edit($id){
        $filtro_automotriz = AireAutomotriz::find($id);

        $imagenes[0] = $filtro_automotriz->imagen;
        $imagenes[1] = $filtro_automotriz->imagen1;
        $imagenes[2] = $filtro_automotriz->imagen2;
        $imagenes[3] = $filtro_automotriz->imagen3;

        $tipo = $filtro_automotriz->filtro->tipo;

        $categoria_seleccionada = isset($tipo->categoria) ? $tipo->categoria : Categoria::find(9);

        $categorias = Categoria::whereNull('deleted_at')
                        ->where('id_clase', 1)
                        ->get();

        $tipos = "";
        if( isset($categoria_seleccionada->tipo) ){
            $tipos = $categoria_seleccionada->tipo;
        }

        $tipo_seleccionado = $filtro_automotriz->filtro->tipo;

        return view('jetfilter.aire_automotriz.edit', compact( 'filtro_automotriz', 'tipos', 'imagenes', 'tipo_seleccionado', 'categorias', 'categoria_seleccionada' ));
    }

    public function update(AireAutomotriz $filtro_automotriz, AireAutomotrizUpdateRequest $request){
        $id_filtro = $filtro_automotriz->id_filtro;

        $filtro_codificacion = FiltroCodificacion::find($id_filtro);
                
        $codigo = $request->input('codigo');
        $tipo = $request->input('tipo');
        $diametro_ext = $request->input('diametro_ext1');
        $diametro_ext2 = $request->input('diametro_ext2');
        $diametro_int = $request->input('diametro_int1');
        $diametro_int2 = $request->input('diametro_int2');
        $altura = $request->input('altura');
        $detalle1 = ( $request->input('detalle1') == '') ? 'N/D' : $request->input('detalle1');
        $detalle2 = ( $request->input('detalle2') == '') ? 'N/D' : $request->input('detalle2');
        $imagen[0] = $filtro_automotriz->imagen;
        $imagen[1] = $filtro_automotriz->imagen1;
        $imagen[2] = $filtro_automotriz->imagen2;
        $imagen[3] = $filtro_automotriz->imagen3;

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
            'id_tipo' => $tipo,
        ]); 

        $filtro_automotriz->update([
            'codigo' => $codigo,
            'codigo_buscar' => $codigo_buscar,
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

    public function edit_imagenes($id){
        $filtro_automotriz = AireAutomotriz::find($id);

        $imagenes[0] = $filtro_automotriz->imagen;
        $imagenes[1] = $filtro_automotriz->imagen1;
        $imagenes[2] = $filtro_automotriz->imagen2;
        $imagenes[3] = $filtro_automotriz->imagen3;

        return view('jetfilter.aire_automotriz.edit_imagenes', compact( 'id', 'imagenes' ));
    }

    public function delete($id, Request $request){
        if( $request->routeIs('*.aireautomotriz.*') ){
            $aire_automotriz = AireAutomotriz::find($id);
            $id_filtro = $aire_automotriz->id_filtro;
            $codigo = $aire_automotriz->codigo;
        }

        $filtro_codificacion = FiltroCodificacion::find($id_filtro);

        $fecha = date("Y-m-d H:i:s");

        $filtro_codificacion->update([
            'deleted_at' => $fecha,
        ]); 

        if( $request->routeIs('*.aireautomotriz.*') ){
            $aire_automotriz->update([
                'deleted_at' => $fecha,
            ]); 

            $eliminado = $codigo;
            return redirect()->route("jet-filter.catalogo.aireautomotriz")->with('eliminado', $eliminado);
        }
    }
}
