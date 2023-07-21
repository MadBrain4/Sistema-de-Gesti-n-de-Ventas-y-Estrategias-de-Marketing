<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AireAutomotriz;
use App\Models\Aplicacion;
use App\Models\Equivalencia;
use App\Models\FiltroCodificacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PDF;
use setasign\Fpdi\Fpdi;

class PDFController extends Controller
{
    public function generarVehiculosAgricolas(){
        $fechaActual = date('d/m/Y');
        $aplicacion = Aplicacion::select('aplicacion.id_tipo', 'aplicacion.aplicacion', 'aplicacion.codigo', 'aplicacion.id_marca', 'aplicacion.id_vehiculo', 'aplicacion_vehiculo.modelo', 'aplicacion_vehiculo.motor', 'aplicacion_vehiculo.ano', 'aplicacion_marca.marca')
                        ->join('aplicacion_marca', 'aplicacion.id_marca', '=', 'aplicacion_marca.id')
                        ->join('aplicacion_vehiculo', 'aplicacion.id_vehiculo', '=', 'aplicacion_vehiculo.id')
                        ->where('aplicacion.id_tipo', 4)
                        ->orderBy('aplicacion_marca.marca')
                        ->orderBy('aplicacion_vehiculo.modelo')
                        ->get();

        $numero_aplicacion = Aplicacion::distinct('aplicacion.aplicacion')
                                ->where('aplicacion.id_tipo', 4)
                                ->count();

        $nombres_aplicaciones = Aplicacion::select('aplicacion')
                                            ->where('id_tipo', 4)
                                            ->groupBy('aplicacion')
                                            ->orderBy('aplicacion')
                                            ->get();

        $data = [
            'nombres_aplicaciones' => $nombres_aplicaciones,
            'numero_aplicaciones' => $numero_aplicacion,
            'aplicacion' => $aplicacion,
            'fechaActual' => $fechaActual,
        ];

        $pdf = PDF::loadView('jetfilter.creacion_PDF.agricolaPDF', $data);

        $pdf->save('PDF/vehiculos_agricolas.pdf');            
    }

    public function generarVehiculosLivianos(){
        $fechaActual = date('d/m/Y');
        $aplicacion = Aplicacion::select('aplicacion.id_tipo', 'aplicacion.aplicacion', 'aplicacion.codigo', 'aplicacion.id_marca', 'aplicacion.id_vehiculo', 'aplicacion_vehiculo.modelo', 'aplicacion_vehiculo.motor', 'aplicacion_vehiculo.ano', 'aplicacion_marca.marca')
                        ->join('aplicacion_marca', 'aplicacion.id_marca', '=', 'aplicacion_marca.id')
                        ->join('aplicacion_vehiculo', 'aplicacion.id_vehiculo', '=', 'aplicacion_vehiculo.id')
                        ->where('aplicacion.id_tipo', 1)
                        ->orderBy('aplicacion_marca.marca')
                        ->orderBy('aplicacion_vehiculo.modelo')
                        ->get();

        $numero_aplicacion = Aplicacion::distinct('aplicacion.aplicacion')
                                ->where('aplicacion.id_tipo', 1)
                                ->count();

        $nombres_aplicaciones = Aplicacion::select('aplicacion')
                                            ->where('id_tipo', 1)
                                            ->groupBy('aplicacion')
                                            ->orderBy('aplicacion')
                                            ->get();

        $data = [
            'nombres_aplicaciones' => $nombres_aplicaciones,
            'numero_aplicaciones' => $numero_aplicacion,
            'aplicacion' => $aplicacion,
            'fechaActual' => $fechaActual,
        ];

        $pdf = PDF::loadView('jetfilter.creacion_PDF.livianoPDF', $data);

        $pdf->save('PDF/vehiculos_livianos.pdf');            
    }

    public function generarVehiculosComerciales1(){
        $fechaActual = date('d/m/Y');
        $aplicacion = Aplicacion::select('aplicacion.id_tipo', 'aplicacion.aplicacion', 'aplicacion.codigo', 'aplicacion.id_marca', 'aplicacion.id_vehiculo', 'aplicacion_vehiculo.modelo', 'aplicacion_vehiculo.motor', 'aplicacion_vehiculo.ano', 'aplicacion_marca.marca')
                        ->join('aplicacion_marca', 'aplicacion.id_marca', '=', 'aplicacion_marca.id')
                        ->join('aplicacion_vehiculo', 'aplicacion.id_vehiculo', '=', 'aplicacion_vehiculo.id')
                        ->where('aplicacion.id_tipo', 2)
                        ->orderBy('aplicacion_marca.marca')
                        ->orderBy('aplicacion_vehiculo.modelo')
                        ->take(650)
                        ->offset(0)
                        ->get();

        $numero_aplicacion = Aplicacion::distinct('aplicacion.aplicacion')
                                ->where('aplicacion.id_tipo', 2)
                                ->count();

        $nombres_aplicaciones = Aplicacion::select('aplicacion')
                                            ->where('id_tipo', 2)
                                            ->groupBy('aplicacion')
                                            ->orderBy('aplicacion')
                                            ->get();

        $data = [
            'nombres_aplicaciones' => $nombres_aplicaciones,
            'numero_aplicaciones' => $numero_aplicacion,
            'aplicacion' => $aplicacion,
            'fechaActual' => $fechaActual,
        ];

        $pdf = PDF::loadView('jetfilter.creacion_PDF.ComercialPDF', $data);

        $pdf->save('PDF/vehiculos_comerciales1.pdf');            
    }

    public function generarVehiculosComerciales2(){
        $fechaActual = date('d/m/Y');
        $aplicacion = Aplicacion::select('aplicacion.id_tipo', 'aplicacion.aplicacion', 'aplicacion.codigo', 'aplicacion.id_marca', 'aplicacion.id_vehiculo', 'aplicacion_vehiculo.modelo', 'aplicacion_vehiculo.motor', 'aplicacion_vehiculo.ano', 'aplicacion_marca.marca')
                        ->join('aplicacion_marca', 'aplicacion.id_marca', '=', 'aplicacion_marca.id')
                        ->join('aplicacion_vehiculo', 'aplicacion.id_vehiculo', '=', 'aplicacion_vehiculo.id')
                        ->where('aplicacion.id_tipo', 2)
                        ->orderBy('aplicacion_marca.marca')
                        ->orderBy('aplicacion_vehiculo.modelo')
                        ->take(650)
                        ->offset(650)
                        ->get();

        $numero_aplicacion = Aplicacion::distinct('aplicacion.aplicacion')
                                ->where('aplicacion.id_tipo', 2)
                                ->count();

        $nombres_aplicaciones = Aplicacion::select('aplicacion')
                                            ->where('id_tipo', 2)
                                            ->groupBy('aplicacion')
                                            ->orderBy('aplicacion')
                                            ->get();

        $data = [
            'nombres_aplicaciones' => $nombres_aplicaciones,
            'numero_aplicaciones' => $numero_aplicacion,
            'aplicacion' => $aplicacion,
            'fechaActual' => $fechaActual,
        ];

        $pdf = PDF::loadView('jetfilter.creacion_PDF.ComercialPDF', $data);

        $pdf->save('PDF/vehiculos_comerciales2.pdf');            
    }

    public function generarVehiculosComerciales3(){
        $fechaActual = date('d/m/Y');
        $aplicacion = Aplicacion::select('aplicacion.id_tipo', 'aplicacion.aplicacion', 'aplicacion.codigo', 'aplicacion.id_marca', 'aplicacion.id_vehiculo', 'aplicacion_vehiculo.modelo', 'aplicacion_vehiculo.motor', 'aplicacion_vehiculo.ano', 'aplicacion_marca.marca')
                        ->join('aplicacion_marca', 'aplicacion.id_marca', '=', 'aplicacion_marca.id')
                        ->join('aplicacion_vehiculo', 'aplicacion.id_vehiculo', '=', 'aplicacion_vehiculo.id')
                        ->where('aplicacion.id_tipo', 2)
                        ->orderBy('aplicacion_marca.marca')
                        ->orderBy('aplicacion_vehiculo.modelo')
                        ->take(650)
                        ->offset(1300)
                        ->get();

        $numero_aplicacion = Aplicacion::distinct('aplicacion.aplicacion')
                                ->where('aplicacion.id_tipo', 2)
                                ->count();

        $nombres_aplicaciones = Aplicacion::select('aplicacion')
                                            ->where('id_tipo', 2)
                                            ->groupBy('aplicacion')
                                            ->orderBy('aplicacion')
                                            ->get();

        $data = [
            'nombres_aplicaciones' => $nombres_aplicaciones,
            'numero_aplicaciones' => $numero_aplicacion,
            'aplicacion' => $aplicacion,
            'fechaActual' => $fechaActual,
        ];

        $pdf = PDF::loadView('jetfilter.creacion_PDF.ComercialPDF', $data);

        $pdf->save('PDF/vehiculos_comerciales3.pdf');            
    }

    public function generarVehiculosComerciales(){
        $files = array("PDF/vehiculos_comerciales1.pdf", "PDF/vehiculos_comerciales2.pdf", "PDF/vehiculos_comerciales3.pdf");

        $pdf = new Fpdi();

        foreach($files as $file){
            $pageCount = $pdf->setSourceFile($file);
            for($i = 1; $i <= $pageCount; $i++){
                $template = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($template);
                $pdf->AddPage($size,$size);
                $pdf->useTemplate($template);
            }
        }           
        $pdf->Output("F","PDF/vehiculos_comerciales.pdf");
    }

    public function generarVehiculosCarretera(){
        $files = array("PDF/vehiculos_fuera_de_carretera_1.pdf", "PDF/vehiculos_fuera_de_carretera_2.pdf", "PDF/vehiculos_fuera_de_carretera_3.pdf", "PDF/vehiculos_fuera_de_carretera_4.pdf");

        $pdf = new Fpdi();

        foreach($files as $file){
            $pageCount = $pdf->setSourceFile($file);
            for($i = 1; $i <= $pageCount; $i++){
                $template = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($template);
                $pdf->AddPage($size,$size);
                $pdf->useTemplate($template);
            }
        }           
        $pdf->Output("F","PDF/vehiculos_carretera.pdf");            
    }

    public function generarVehiculosCarretera1(){
        $fechaActual = date('d/m/Y');
        $aplicacion = Aplicacion::select('aplicacion.id_tipo', 'aplicacion.aplicacion', 'aplicacion.codigo', 'aplicacion.id_marca', 'aplicacion.id_vehiculo', 'aplicacion_vehiculo.modelo', 'aplicacion_vehiculo.motor', 'aplicacion_vehiculo.ano', 'aplicacion_marca.marca')
                        ->join('aplicacion_marca', 'aplicacion.id_marca', '=', 'aplicacion_marca.id')
                        ->join('aplicacion_vehiculo', 'aplicacion.id_vehiculo', '=', 'aplicacion_vehiculo.id')
                        ->where('aplicacion.id_tipo', 3)
                        ->where('aplicacion.aplicacion', '!=', 'Aire')
                        ->orderBy('aplicacion_marca.marca')
                        ->orderBy('aplicacion_vehiculo.modelo')
                        ->limit(650)
                        ->offset(0)
                        ->get();

        $numero_aplicacion = Aplicacion::distinct('aplicacion.aplicacion')
                                ->where('aplicacion.id_tipo', 3)
                                ->count();

        $nombres_aplicaciones = Aplicacion::select('aplicacion')
                                            ->where('id_tipo', 3)
                                            ->groupBy('aplicacion')
                                            ->orderBy('aplicacion')
                                            ->get();

        $data = [
            'nombres_aplicaciones' => $nombres_aplicaciones,
            'numero_aplicaciones' => $numero_aplicacion,
            'aplicacion' => $aplicacion,
            'fechaActual' => $fechaActual,
        ];

        $pdf = PDF::loadView('jetfilter.creacion_PDF.carreteraPDF', $data);

        $pdf->save('PDF/vehiculos_fuera_de_carretera_1.pdf');            
    }

    public function generarVehiculosCarretera2(){
        $fechaActual = date('d/m/Y');
        $aplicacion = Aplicacion::select('aplicacion.id_tipo', 'aplicacion.aplicacion', 'aplicacion.codigo', 'aplicacion.id_marca', 'aplicacion.id_vehiculo', 'aplicacion_vehiculo.modelo', 'aplicacion_vehiculo.motor', 'aplicacion_vehiculo.ano', 'aplicacion_marca.marca')
                        ->join('aplicacion_marca', 'aplicacion.id_marca', '=', 'aplicacion_marca.id')
                        ->join('aplicacion_vehiculo', 'aplicacion.id_vehiculo', '=', 'aplicacion_vehiculo.id')
                        ->where('aplicacion.id_tipo', 3)
                        ->where('aplicacion.aplicacion', '!=', 'Aire')
                        ->orderBy('aplicacion_marca.marca')
                        ->orderBy('aplicacion_vehiculo.modelo')
                        ->limit(650)
                        ->offset(650)
                        ->get();

        $numero_aplicacion = Aplicacion::distinct('aplicacion.aplicacion')
                                ->where('aplicacion.id_tipo', 3)
                                ->count();

        $nombres_aplicaciones = Aplicacion::select('aplicacion')
                                            ->where('id_tipo', 3)
                                            ->groupBy('aplicacion')
                                            ->orderBy('aplicacion')
                                            ->get();

        $data = [
            'nombres_aplicaciones' => $nombres_aplicaciones,
            'numero_aplicaciones' => $numero_aplicacion,
            'aplicacion' => $aplicacion,
            'fechaActual' => $fechaActual,
        ];

        $pdf = PDF::loadView('jetfilter.creacion_PDF.carreteraPDF', $data);

        $pdf->save('PDF/vehiculos_fuera_de_carretera_2.pdf');            
    }

    public function generarVehiculosCarretera3(){
        $fechaActual = date('d/m/Y');
        $aplicacion = Aplicacion::select('aplicacion.id_tipo', 'aplicacion.aplicacion', 'aplicacion.codigo', 'aplicacion.id_marca', 'aplicacion.id_vehiculo', 'aplicacion_vehiculo.modelo', 'aplicacion_vehiculo.motor', 'aplicacion_vehiculo.ano', 'aplicacion_marca.marca')
                        ->join('aplicacion_marca', 'aplicacion.id_marca', '=', 'aplicacion_marca.id')
                        ->join('aplicacion_vehiculo', 'aplicacion.id_vehiculo', '=', 'aplicacion_vehiculo.id')
                        ->where('aplicacion.id_tipo', 3)
                        ->where('aplicacion.aplicacion', '!=', 'Aire')
                        ->orderBy('aplicacion_marca.marca')
                        ->orderBy('aplicacion_vehiculo.modelo')
                        ->limit(650)
                        ->offset(1300)
                        ->get();

        $numero_aplicacion = Aplicacion::distinct('aplicacion.aplicacion')
                                ->where('aplicacion.id_tipo', 3)
                                ->count();

        $nombres_aplicaciones = Aplicacion::select('aplicacion')
                                            ->where('id_tipo', 3)
                                            ->groupBy('aplicacion')
                                            ->orderBy('aplicacion')
                                            ->get();

        $data = [
            'nombres_aplicaciones' => $nombres_aplicaciones,
            'numero_aplicaciones' => $numero_aplicacion,
            'aplicacion' => $aplicacion,
            'fechaActual' => $fechaActual,
        ];

        $pdf = PDF::loadView('jetfilter.creacion_PDF.carreteraPDF', $data);

        $pdf->save('PDF/vehiculos_fuera_de_carretera_3.pdf');            
    }

    public function generarVehiculosCarretera4(){
        $fechaActual = date('d/m/Y');
        $aplicacion = Aplicacion::select('aplicacion.id_tipo', 'aplicacion.aplicacion', 'aplicacion.codigo', 'aplicacion.id_marca', 'aplicacion.id_vehiculo', 'aplicacion_vehiculo.modelo', 'aplicacion_vehiculo.motor', 'aplicacion_vehiculo.ano', 'aplicacion_marca.marca')
                        ->join('aplicacion_marca', 'aplicacion.id_marca', '=', 'aplicacion_marca.id')
                        ->join('aplicacion_vehiculo', 'aplicacion.id_vehiculo', '=', 'aplicacion_vehiculo.id')
                        ->where('aplicacion.id_tipo', 3)
                        ->where('aplicacion.aplicacion', '!=', 'Aire')
                        ->orderBy('aplicacion_marca.marca')
                        ->orderBy('aplicacion_vehiculo.modelo')
                        ->limit(650)
                        ->offset(1950)
                        ->get();

        $numero_aplicacion = Aplicacion::distinct('aplicacion.aplicacion')
                                ->where('aplicacion.id_tipo', 3)
                                ->count();

        $nombres_aplicaciones = Aplicacion::select('aplicacion')
                                            ->where('id_tipo', 3)
                                            ->groupBy('aplicacion')
                                            ->orderBy('aplicacion')
                                            ->get();

        $data = [
            'nombres_aplicaciones' => $nombres_aplicaciones,
            'numero_aplicaciones' => $numero_aplicacion,
            'aplicacion' => $aplicacion,
            'fechaActual' => $fechaActual,
        ];

        $pdf = PDF::loadView('jetfilter.creacion_PDF.carreteraPDF', $data);

        $pdf->save('PDF/vehiculos_fuera_de_carretera_4.pdf');            
    }

    public function generarEspecificaciones(){
        $fechaActual = date('d/m/Y');
        //Sellado
        $sellado = FiltroCodificacion::from( 'filtro_codificacion as f_c' )
                    ->whereNull("f_c.deleted_at")
                    ->join("espec_sellado as e_s", "e_s.id_filtro", "=", "f_c.id")
                    ->where("f_c.id_clase", 6)
                    ->get();

        //Aire Automotriz
        $aireautomotriz = FiltroCodificacion::from( 'filtro_codificacion as f_c' )
                    ->whereNull("f_c.deleted_at")
                    ->join("espec_aireautomotriz as e_a", "e_a.id_filtro", "=", "f_c.id")
                    ->where("f_c.id_clase", 1)
                    ->get();

        //Combustible
        $combustiblelinea = FiltroCodificacion::from( 'filtro_codificacion as f_c' )
                    ->whereNull("f_c.deleted_at")
                    ->join("espec_combustiblelinea as e_c", "e_c.id_filtro", "=", "f_c.id")
                    ->where("f_c.id_clase", 3)
                    ->get();

        //Aire Industrial
        $aireindustrial = FiltroCodificacion::from( 'filtro_codificacion as f_c' )
                    ->whereNull("f_c.deleted_at")
                    ->join("espec_aireindustrial as e_a", "e_a.id_filtro", "=", "f_c.id")
                    ->where("f_c.id_clase", 2)
                    ->get();

        //Elemento
        $elemento = FiltroCodificacion::from( 'filtro_codificacion as f_c' )
                    ->whereNull("f_c.deleted_at")
                    ->join("espec_elemento as e_e", "e_e.id_filtro", "=", "f_c.id")
                    ->where("f_c.id_clase", 4)
                    ->get();

        //Panel
        $panel = FiltroCodificacion::from( 'filtro_codificacion as f_c' )
                    ->whereNull("f_c.deleted_at")
                    ->join("espec_panel as e_p", "e_p.id_filtro", "=", "f_c.id")
                    ->where("f_c.id_clase", 5)
                    ->get();

        $data = [
            'sellado' => $sellado,
            'panel' => $panel,
            'elemento' => $elemento,
            'combustible_linea' => $combustiblelinea,
            'aire_industrial' => $aireindustrial,
            'aire_automotriz' => $aireautomotriz,
            'fechaActual' => $fechaActual,
        ];

        $pdf = PDF::loadView('jetfilter.creacion_PDF.especificacionesPDF', $data);

        $pdf->save('PDF/especificaciones.pdf');
    }

    public function generarEquivalencias(){
        $fechaActual = date('d/m/Y');
        //Marca
        $marca = DB::table("equivalencia_marca")
                    ->select("id", "marca")
                    ->whereNull("deleted_at")
                    ->orderBy("marca")
                    ->get();

        $equivalencias = Equivalencia::select("codigo", "id_marca", "codigo_marca")    
                        ->whereNull("deleted_at") 
                        ->orderBy('marca') 
                        ->orderBy("codigo_marca")
                        ->take(500)
                        ->get();         

        $data = [
            'marca' => $marca,
            'equivalencias' => $equivalencias,
            'fechaActual' => $fechaActual,
        ];

        $pdf = PDF::loadView('jetfilter.creacion_PDF.equivalenciaPDF', $data);

        $pdf->save('PDF/equivalencias.pdf');
    }

    public function generarCatalogoCompleto(){
        $files = array("PDF/vehiculos_agricolas.pdf", "PDF/vehiculos_livianos.pdf", "PDF/vehiculos_comerciales.pdf", "PDF/vehiculos_carretera.pdf", "PDF/equivalencias.pdf", "PDF/especificaciones.pdf");

        $pdf = new Fpdi();

        foreach($files as $file){
            $pageCount = $pdf->setSourceFile($file);
            for($i = 1; $i <= $pageCount; $i++){
                $template = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($template);
                $pdf->AddPage($size,$size);
                $pdf->useTemplate($template);
            }
        }           
        $pdf->Output("F","PDF/completo.pdf");
    }
}
