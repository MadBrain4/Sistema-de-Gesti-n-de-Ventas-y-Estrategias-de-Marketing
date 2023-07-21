<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\FiltroCodificacion;
use Illuminate\Http\Request;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;

class GraficaController extends Controller
{
    public function graficas(Request $request){
        date_default_timezone_set('America/Caracas');

            $tipo = $request->input('tipo_cliente');
            $fecha = $request->input('fecha');
            $codigo = $request->input('codigo');

            $categoria = [];
            $k = 0;
            foreach($request->categoria as $cate){
                $categoria[$k] = $cate;
                $k++;
            }

            $estado = [];
            $k = 0;
            foreach($request->estado as $est){
                $estado[$k] = $est;
                $k++;
            }

            //Codigo
            if( $codigo != ""){
                $whereCodigo = "(detalle_Venta.codigo = '$codigo')";
            }
            else {
                $whereCodigo = '(2 = 2)';
            }

            //Tipo de Cliente
            if( $tipo == 1){
                $tipo_cliente = "(2 = 2) ";
            }
            else if( $tipo == 2){
                $tipo_cliente = "(tipo_cliente = 'Cliente') ";
            }
            else if( $tipo == 3 ) {
                $tipo_cliente = "(tipo_cliente = 'Distribuidora') ";
            }

            //Fechas
            if( $fecha == 1 ){
                $fecha_min = date('Y-m-d');
                $fecha_minima = strtotime ('-1 year', strtotime($fecha_min));
                $fecha_minima = date ('Y-m-d',$fecha_minima);
                $fecha_maxima = date('Y-m-d');
            }
            if( $fecha == 2 ){
                $fecha_min = date('Y-m-d');
                $fecha_minima = strtotime ('-3 year', strtotime($fecha_min));
                $fecha_minima = date ('Y-m-d',$fecha_minima);
                $fecha_maxima = date('Y-m-d');
            }
            if( $fecha == 3 ){
                $fecha_min = date('Y-m-d');
                $fecha_minima = strtotime ('-5 year', strtotime($fecha_min));
                $fecha_minima = date ('Y-m-d',$fecha_minima);
                $fecha_maxima = date('Y-m-d');
            }
            if( $fecha == 4 ){
                $fecha_min = date('Y-m-d');
                $fecha_minima = strtotime ('-10 year', strtotime($fecha_min));
                $fecha_minima = date ('Y-m-d',$fecha_minima);
                $fecha_maxima = date('Y-m-d');
            }

            $whereCategoria = "(";
            if( !in_array('aireautomotriz', $categoria) ){
                $whereCategoria .= "filtro_codificacion.id_clase != '1' and ";
            }
            if( !in_array('aireindustrial', $categoria) ){
                $whereCategoria .= "filtro_codificacion.id_clase != '2' and ";
            }
            if( !in_array('combustiblelinea', $categoria) ){
                $whereCategoria .= "filtro_codificacion.id_clase != '3' and ";
            }
            if( !in_array('elemento', $categoria) ){
                $whereCategoria .= "filtro_codificacion.id_clase != '4' and ";
            }
            if( !in_array('panel', $categoria) ){
                $whereCategoria .= "filtro_codificacion.id_clase != '5' and ";
            }
            if( !in_array('sellado', $categoria) ){
                $whereCategoria .= "filtro_codificacion.id_clase != '6' and ";
            }
            if( $whereCategoria != "(" ){
                $whereCategoria = substr($whereCategoria, 0, -4);
                $whereCategoria .= ")";
            }
            else {
                $whereCategoria = "(2=2)";
            }

            $whereEstado = "(";
            if( !in_array('amazonas', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Amazonas' and ";
            }
            if( !in_array('anzoategui', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Anzoategui' and ";
            }
            if( !in_array('apure', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Apure' and ";
            }
            if( !in_array('aragua', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Aragua' and ";
            }
            if( !in_array('barinas', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Barinas' and ";
            }
            if( !in_array('bolivar', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Bolivar' and ";
            }
            if( !in_array('carabobo', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Carabobo' and ";
            }
            if( !in_array('cojedes', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Cojedes' and ";
            }
            if( !in_array('delta_amacuro', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Delta Amacuro' and ";
            }
            if( !in_array('distrito_capital', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Distrito Capital' and ";
            }
            if( !in_array('falcon', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Falcon' and ";
            }
            if( !in_array('guarico', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Guarico' and ";
            }
            if( !in_array('lara', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Lara' and ";
            }
            if( !in_array('merida', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Merida' and ";
            }
            if( !in_array('miranda', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Miranda' and ";
            }
            if( !in_array('monagas', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Monagas' and ";
            }
            if( !in_array('nueva_esparta', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Nueva Esparta' and ";
            }
            if( !in_array('portuguesa', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Portuguesa' and ";
            }
            if( !in_array('sucre', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Sucre' and ";
            }
            if( !in_array('tachira', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Tachira' and ";
            }
            if( !in_array('trujillo', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Trujillo' and ";
            }
            if( !in_array('vargas', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Vargas' and ";
            }
            if( !in_array('yaracuy', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Yaracuy' and ";
            }
            if( !in_array('zulia', $estado) ){
                $whereEstado .= "users_webfiltros.estado != 'Zulia' and ";
            }
            if( $whereEstado != "(" ){
                $whereEstado = substr($whereEstado, 0, -4);
                $whereEstado .= ")";
            }
            else {
                $whereEstado = "(2=2)";
            }

            //Ventas Realizadas Totales en la fecha
            $ventas_realizadas = Venta::select(DB::raw("COUNT(*) as ventas_realizadas, SUM(precio_bruto) as dinero_generado"))
                                ->whereBetween('fecha', [$fecha_minima, $fecha_maxima])
                                ->get();
            
            //Ventas Realizadas Bajo Parametros
            $ventas_realizadas_filtros = Venta::select(DB::raw("COUNT(DISTINCT(venta.id)) as ventas_realizadas, COUNT(DISTINCT(detalle_venta.id)) as filtros_vendidos, SUM(detalle_venta.precio_total) as dinero_generado"))
                                ->join('detalle_venta', 'venta.id', '=', 'detalle_venta.id_Venta')
                                ->join('filtro_codificacion', 'filtro_codificacion.id', '=', 'detalle_venta.id_filtro')
                                ->join('users_webfiltros', 'venta.id_users', '=', 'users_webfiltros.id')
                                ->whereRaw($tipo_cliente)
                                ->whereRaw($whereCodigo)
                                ->whereRaw($whereCategoria)
                                ->whereRaw($whereEstado)
                                ->whereBetween('fecha', [$fecha_minima, $fecha_maxima])
                                ->get();

            //Ventas y ganancias por mes
            $cantidad_total = Venta::select(DB::raw("MONTHNAME(fecha) as nombre_mes, month(fecha) as mes, SUM(precio_bruto) as precio"))
                                ->whereBetween('fecha', [$fecha_minima, $fecha_maxima])
                                ->groupBy(DB::raw("nombre_mes, mes"))
                                ->orderBy(DB::raw("mes"))
                                ->get();
            
            //Ventas y Ganancias por Mes Bajo Parametros                    
            $cantidad_venta = Venta::select(DB::raw("MONTHNAME(fecha) as nombre_mes, month(fecha) as mes, SUM(detalle_venta.precio_total) as precio"))
                                ->join('detalle_venta', 'venta.id', '=', 'detalle_venta.id_Venta')
                                ->join('filtro_codificacion', 'filtro_codificacion.id', '=', 'detalle_venta.id_filtro')
                                ->join('users_webfiltros', 'venta.id_users', '=', 'users_webfiltros.id')
                                ->whereBetween('fecha', [$fecha_minima, $fecha_maxima])
                                ->whereRaw($tipo_cliente)
                                ->whereRaw($whereCategoria)
                                ->whereRaw($whereCodigo)
                                ->whereRaw($whereEstado)
                                ->groupBy(DB::raw("nombre_mes, mes"))
                                ->orderBy(DB::raw("mes"))
                                ->get();  
            //                    
            $venta_categoria = Venta::select(DB::raw("SUM(detalle_venta.precio_total) as precio_total, clases.clase"))
                                ->join('detalle_venta', 'venta.id', '=', 'detalle_venta.id_Venta')
                                ->join('filtro_codificacion', 'filtro_codificacion.id', '=', 'detalle_venta.id_filtro')
                                ->join('clases', 'clases.id', '=', 'filtro_codificacion.id_clase')
                                ->join('users_webfiltros', 'venta.id_users', '=', 'users_webfiltros.id')
                                ->whereBetween('fecha', [$fecha_minima, $fecha_maxima])
                                ->whereRaw($tipo_cliente)
                                ->whereRaw($whereCategoria)
                                ->whereRaw($whereCodigo)
                                ->whereRaw($whereEstado)
                                ->groupBy("clase")
                                ->orderBy("clase")
                                ->get();  
                        
            $venta_estado = Venta::select(DB::raw("users_webfiltros.estado as estado, SUM(detalle_venta.precio_total) as precio"))
                                ->join('detalle_venta', 'venta.id', '=', 'detalle_venta.id_Venta')
                                ->join('filtro_codificacion', 'filtro_codificacion.id', '=', 'detalle_venta.id_filtro')
                                ->join('users_webfiltros', 'venta.id_users', '=', 'users_webfiltros.id')
                                ->whereBetween('fecha', [$fecha_minima, $fecha_maxima])
                                ->whereRaw($tipo_cliente)
                                ->whereRaw($whereCategoria)
                                ->whereRaw($whereCodigo)
                                ->whereRaw($whereEstado)
                                ->groupBy(DB::raw("estado"))
                                ->orderBy(DB::raw("estado"))
                                ->get();  

                $max_productos = Venta::selectRaw('count(*) as productos_vendidos, filtro_codificacion.codigo')
                                    ->join('detalle_venta', 'venta.id', '=', 'detalle_venta.id_Venta')
                                    ->join('filtro_codificacion', 'filtro_codificacion.id', '=', 'detalle_venta.id_filtro')
                                    ->join('users_webfiltros', 'venta.id_users', '=', 'users_webfiltros.id')
                                    ->whereBetween('fecha', [$fecha_minima, $fecha_maxima])
                                    ->whereRaw($tipo_cliente)
                                    ->whereRaw($whereCategoria)
                                    ->whereRaw($whereCodigo)
                                    ->whereRaw($whereEstado)
                                    ->groupBy('detalle_venta.id_filtro')
                                    ->orderBy('productos_vendidos','DESC')
                                    ->take(5)
                                    ->get();

                $min_productos = Venta::selectRaw('count(*) as productos_vendidos, filtro_codificacion.codigo')
                                    ->join('detalle_venta', 'venta.id', '=', 'detalle_venta.id_Venta')
                                    ->join('filtro_codificacion', 'filtro_codificacion.id', '=', 'detalle_venta.id_filtro')
                                    ->join('users_webfiltros', 'venta.id_users', '=', 'users_webfiltros.id')
                                    ->whereBetween('fecha', [$fecha_minima, $fecha_maxima])
                                    ->whereRaw($tipo_cliente)
                                    ->whereRaw($whereCategoria)
                                    ->whereRaw($whereCodigo)
                                    ->whereRaw($whereEstado)
                                    ->groupBy('detalle_venta.id_filtro')
                                    ->orderBy('productos_vendidos','ASC')
                                    ->take(5)
                                    ->get();   
                                
            $clientes_totales = Venta::whereBetween('fecha', [$fecha_minima, $fecha_maxima])
                                    ->whereRaw($tipo_cliente)
                                    ->count(); 
                                    
            $clientes_unicos = Venta::distinct('id_users')
                                    ->whereBetween('fecha', [$fecha_minima, $fecha_maxima])
                                    ->whereRaw($tipo_cliente)
                                    ->count();  
                                        
            $filtros_vendidos = DetalleVenta::join('venta', 'venta.id', '=', 'detalle_venta.id_Venta')
                                    ->whereBetween('fecha', [$fecha_minima, $fecha_maxima])
                                    ->sum('cantidad');
            
        return response()->json([$cantidad_venta, $cantidad_total, $ventas_realizadas, $ventas_realizadas_filtros, $venta_categoria, $venta_estado, $max_productos, $min_productos, $clientes_totales, $clientes_unicos, $filtros_vendidos]);  
    }
}
