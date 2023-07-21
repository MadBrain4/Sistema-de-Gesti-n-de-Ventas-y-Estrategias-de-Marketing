<?php

namespace App\Http\Controllers;

use App\Models\AireAutomotriz;
use App\Models\Objetivo;
use App\Models\Recurso;
use App\Models\Responsable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EstrategiasRequest;
use App\Models\BuyerPersona;
use App\Models\BuyerPersonaEstrategia;
use App\Models\Estrategia;
use App\Models\FaseEstrategia;
use App\Models\KPI;
use App\Models\KpiEstrategia;
use App\Models\Objetivo_Estrategia;
use App\Models\RecursoEstrategia;
use App\Models\ResponsableEstrategia;

class EstrategiasController extends Controller
{
    public function index(){
        return view ("marketing.estrategias");
    }

    public function nuevo(){
        return view('marketing.estrategias.nuevo');
    }

    public function store(Request $request){
        date_default_timezone_set('America/Caracas');
        $fecha = date("Y-m-d H:i:s"); 
        $titulo = $request->input('titulo'); 
        $fecha_inicio = $request->input('fecha_inicio'); 
        $fecha_final = $request->input('fecha_final'); 
        $buyer_persona = $request->input('buyerPersona');
        $descripcion = $request->input('descripcion_estrategia');
        $objetivo = $request->input('objetivo');
        $kpi = $request->input('kpi');
        $valor_referencial = $request->input('valor_referencial');
        $tipo_valor_referencial = $request->input('tipo_valor_referencial');
        $presupuesto = $request->input('presupuesto');

        try {
            DB::beginTransaction();
            $estrategia = Estrategia::create([
                'titulo' => $titulo,
                'fecha_inicio' => $fecha_inicio,
                'fecha_final' => $fecha_final,
                'buyer_persona' => $buyer_persona,
                'descripcion' => $descripcion,
                'objetivo' => $objetivo,
                'presupuesto' => $presupuesto,
                'kpi' => $kpi,
                'valor_referencial' => $valor_referencial,
                'tipo_valor_referencial' => $tipo_valor_referencial,
            ]);

            $k = 0;
            foreach($request->responsable as $resp){
                $responsables[$k] = $resp;
                $k++;
            }
            $responsables = Arr::whereNotNull($responsables);
            foreach( $responsables as $responsable ){
                $respon = Responsable::create([
                    'responsable' => $responsable,
                    'created_at' => $fecha,
                ]);
                $responsable = ResponsableEstrategia::create([
                    'id_estrategia' => $estrategia->id,
                    'id_responsable' => $respon->id,
                ]);
            }

            $k = 0;
            foreach($request->recurso as $rec){
                $recursos[$k] = $rec;
                $k++;
            }
            $k = 0;
            foreach($request->tipo_recurso as $tipo_rec){
                $tipo_recursos[$k] = $tipo_rec;
                $k++;
            }
            $k = 0;
            $recursos = Arr::whereNotNull($recursos);
            foreach( $recursos as $recurso ){
                $rec = Recurso::create([
                    'recurso' => $recurso,
                    'tipo_recurso' => $tipo_recursos[$k],
                    'created_at' => $fecha,
                ]);
                RecursoEstrategia::create([
                    'id_estrategia' => $estrategia->id,
                    'id_recurso' => $rec->id,
                ]);
                $k++;
            }

            $k = 0;
            foreach($request->fase as $fas){
                $fase[$k] = $fas;
                $k++;
            }
            $k = 0;
            foreach($request->fases_fecha_inicio as $fecha_inicializar){
                $fecha_inicial[$k] = $fecha_inicializar;
                $k++;
            }
            $k = 0;
            foreach($request->fases_fecha_final as $fecha_finalizar){
                $fecha_finaliza[$k] = $fecha_finalizar;
                $k++;
            }
            $fases = Arr::whereNotNull($fase);
            $k = 0;
            foreach( $fases as $fase ){
                $fas = FaseEstrategia::create([
                    'fase' => $fase,
                    'num_fase' => $k + 1,
                    'fecha_inicio' => $fecha_inicial[$k],
                    'fecha_final' => $fecha_finaliza[$k],
                    'id_estrategia' => $estrategia->id,
                    'created_at' => $fecha,
                ]);
                $k++;
            }

            $k = 0;
            foreach($request->demografico as $demografico){
                $demograficos[$k] = $demografico;
                $k++;
            }
            $demograficos = Arr::whereNotNull($demograficos);
            foreach( $demograficos as $demografic ){
                $demografico = BuyerPersona::create([
                    'tipo' => 'demografico',
                    'descripcion' => $demografic,
                    'created_at' => $fecha,
                ]);
                BuyerPersonaEstrategia::create([
                    'id_estrategia' => $estrategia->id,
                    'id_buyer_persona' => $demografico->id,
                ]);
            }

            $k = 0;
            foreach($request->psicologico as $psicologico){
                $psicologicos[$k] = $psicologico;
                $k++;
            }
            $psicologicos = Arr::whereNotNull($psicologicos);
            foreach( $psicologicos as $psicologic ){
                $psicologico = BuyerPersona::create([
                    'tipo' => 'psicologico',
                    'descripcion' => $psicologic,
                    'created_at' => $fecha,
                ]);
                BuyerPersonaEstrategia::create([
                    'id_estrategia' => $estrategia->id,
                    'id_buyer_persona' => $psicologico->id,
                ]);
            }

            $k = 0;
            foreach($request->meta as $meta){
                $metas[$k] = $meta;
                $k++;
            }
            $metas = Arr::whereNotNull($metas);
            foreach( $metas as $met ){
                $meta = BuyerPersona::create([
                    'tipo' => 'meta',
                    'descripcion' => $met,
                    'created_at' => $fecha,
                ]);
                BuyerPersonaEstrategia::create([
                    'id_estrategia' => $estrategia->id,
                    'id_buyer_persona' => $meta->id,
                ]);
            }

            $k = 0;
            foreach($request->miedo as $miedo){
                $miedos[$k] = $miedo;
                $k++;
            }
            $miedos = Arr::whereNotNull($miedos);
            foreach( $miedos as $mied ){
                $miedo = BuyerPersona::create([
                    'tipo' => 'miedo',
                    'descripcion' => $mied,
                    'created_at' => $fecha,
                ]);
                BuyerPersonaEstrategia::create([
                    'id_estrategia' => $estrategia->id,
                    'id_buyer_persona' => $miedo->id,
                ]);
            }

            DB::commit();

            return redirect()->route('jet-filter.marketing.estrategias')->with('creado', true);
        }
        catch(Exception $exception){
            DB::rollBack();
            return $exception;
        }
    }

    public function edit(Estrategia $estrategia){
        return view('marketing.estrategias.edit', compact( 'estrategia' ));
    }

    public function edit_info(Estrategia $estrategia){
        return $estrategia;
    }
    
    public function update($id, Request $request){
        date_default_timezone_set('America/Caracas');
        $fecha = date("Y-m-d H:i:s"); 
        $fecha_inicio = $request->input('fecha_inicio'); 
        $fecha_final = $request->input('fecha_final'); 
        $buyer_persona = $request->input('buyerPersona');
        $descripcion = $request->input('descripcion_estrategia');
        $objetivo = $request->input('objetivos');
        $kpi = $request->input('kpi');
        $valor_referencial = $request->input('valor_referencial');
        $tipo_valor_referencial = $request->input('tipo_valor_referencial');
        $presupuesto = $request->input('presupuesto');
        $resultado = $request->input('resultado');
        $analisis = $request->input('analisis');
        $estrategia = Estrategia::find($id);

        try {
            DB::beginTransaction();

            $estrategia->update([
                'fecha_inicio' => $fecha_inicio,
                'fecha_final' => $fecha_final,
                'buyer_persona' => $buyer_persona,
                'descripcion' => $descripcion,
                'objetivo' => $objetivo,
                'kpi' => $kpi,
                'valor_referencial' => $valor_referencial,
                'tipo_valor_referencial' => $tipo_valor_referencial,
                'presupuesto' => $presupuesto,
                'resultado' => $resultado,
                'analisis' => $analisis,
                'updated_at' => $fecha,
            ]);

            $k = 0;

            if( $request->demografico != null ){
                foreach($request->demografico as $demografico){
                    $demograficos[$k] = $demografico;
                    $k++;
                }
                $k = 0;
            }

            if( $request->demografico_id != null ){
                foreach($request->demografico_id as $demografico_id){
                    if( $demograficos[$k] == null && $demografico_id != 0 ){
                        $democ = BuyerPersonaEstrategia::select('id', 'id_buyer_persona')
                                                    ->where('id_buyer_persona', $demografico_id)
                                                    ->where('id_estrategia', $estrategia->id)
                                                    ->get();
                        $demografic = BuyerPersonaEstrategia::find($democ[0]->id);
                        $demografic->delete();
                    }
                    else if( $demografico_id != 0 ){
                        $democ = BuyerPersonaEstrategia::select('id_buyer_persona')
                                                    ->where('id_buyer_persona', $demografico_id)
                                                    ->where('id_estrategia', $estrategia->id)
                                                    ->get();
                        $demografic = BuyerPersona::find($democ[0]->id_buyer_persona);
                        $demografic->update([
                            'descripcion' => $demograficos[$k],
                            'updated_at' => $fecha,
                        ]);
                    }
                    else if ( $demograficos[$k] != null && $demografico_id == 0 ) {
                        $demografic = BuyerPersona::create([
                            'descripcion' => $demograficos[$k],
                            'tipo' => 'demografico',
                            'created_at' => $fecha,
                        ]);
                        $demografico2 = BuyerPersonaEstrategia::create([
                            'id_estrategia' => $estrategia->id,
                            'id_buyer_persona' => $demografic->id,
                        ]);
                    }
                    $k++;
                }
            }

            if( $request->psicologico != null ){
                $k = 0;
                foreach($request->psicologico as $psicologico){
                    $psicologicos[$k] = $psicologico;
                    $k++;
                }
                $k = 0;
            }

            if( $request->psicologico_id != null ){
                foreach($request->psicologico_id as $psicologico_id){
                    if( $psicologicos[$k] == null && $psicologico_id != 0 ){
                        $psico = BuyerPersonaEstrategia::select('id', 'id_buyer_persona')
                                                    ->where('id_buyer_persona', $psicologico_id)
                                                    ->where('id_estrategia', $estrategia->id)
                                                    ->get();
                        $psicolo = BuyerPersonaEstrategia::find($psico[0]->id);
                        $psicolo->delete();
                    }
                    else if( $psicologico_id != 0 ){
                        $psico = BuyerPersonaEstrategia::select('id_buyer_persona')
                                                    ->where('id_buyer_persona', $psicologico_id)
                                                    ->where('id_estrategia', $estrategia->id)
                                                    ->get();
                        $psicolo = BuyerPersona::find($psico[0]->id_buyer_persona);
                        $psicolo->update([
                            'descripcion' => $psicologicos[$k],
                            'updated_at' => $fecha,
                        ]);
                    }
                    else if ( $psicologicos[$k] != null && $psicologico_id == 0 ) {
                        $psicolo = BuyerPersona::create([
                            'descripcion' => $psicologicos[$k],
                            'tipo' => 'psicologico',
                            'created_at' => $fecha,
                        ]);
                        $psicologico2 = BuyerPersonaEstrategia::create([
                            'id_estrategia' => $estrategia->id,
                            'id_buyer_persona' => $psicolo->id,
                        ]);
                    }
                    $k++;
                }
            }

            if( $request->meta != null ){
                $k = 0;
                foreach($request->meta as $meta){
                    $metas[$k] = $meta;
                    $k++;
                }
            }
            $k = 0;

            if( $request->meta_id != null ){
                foreach($request->meta_id as $meta_id){
                    if( $metas[$k] == null && $meta_id != 0 ){
                        $me = BuyerPersonaEstrategia::select('id', 'id_buyer_persona')
                                                    ->where('id_buyer_persona', $meta_id)
                                                    ->where('id_estrategia', $estrategia->id)
                                                    ->get();
                        $me = BuyerPersonaEstrategia::find($me[0]->id);
                        $me->delete();
                    }
                    else if( $meta_id != 0 ){
                        $me = BuyerPersonaEstrategia::select('id_buyer_persona')
                                                    ->where('id_buyer_persona', $meta_id)
                                                    ->where('id_estrategia', $estrategia->id)
                                                    ->get();
                        $me = BuyerPersona::find($me[0]->id_buyer_persona);
                        $me->update([
                            'descripcion' => $metas[$k],
                            'updated_at' => $fecha,
                        ]);
                    }
                    else if ( $metas[$k] != null && $meta_id == 0 ) {
                        $met = BuyerPersona::create([
                            'descripcion' => $metas[$k],
                            'tipo' => 'meta',
                            'created_at' => $fecha,
                        ]);
                        $met2 = BuyerPersonaEstrategia::create([
                            'id_estrategia' => $estrategia->id,
                            'id_buyer_persona' => $met->id,
                        ]);
                    }
                    $k++;
                }
            }

            if( $request->miedo != null ){
                $k = 0;
                foreach($request->miedo as $miedo){
                    $miedos[$k] = $miedo;
                    $k++;
                }
            }
            $k = 0;

            if( $request->miedo != null ){
                foreach($request->miedo_id as $miedo_id){
                    if( $miedos[$k] == null && $miedo_id != 0 ){
                        $mie = BuyerPersonaEstrategia::select('id', 'id_buyer_persona')
                                                    ->where('id_buyer_persona', $miedo_id)
                                                    ->where('id_estrategia', $estrategia->id)
                                                    ->get();
                        $mie = BuyerPersonaEstrategia::find($mie[0]->id);
                        $mie->delete();
                    }
                    else if( $miedo_id != 0 ){
                        $mie = BuyerPersonaEstrategia::select('id_buyer_persona')
                                                    ->where('id_buyer_persona', $miedo_id)
                                                    ->where('id_estrategia', $estrategia->id)
                                                    ->get();
                        $mie = BuyerPersona::find($mie[0]->id_buyer_persona);
                        $mie->update([
                            'descripcion' => $miedos[$k],
                            'updated_at' => $fecha,
                        ]);
                    }
                    else if ( $miedos[$k] != null && $miedo_id == 0 ) {
                        $mied = BuyerPersona::create([
                            'descripcion' => $miedos[$k],
                            'tipo' => 'miedo',
                            'created_at' => $fecha,
                        ]);
                        $miedo2 = BuyerPersonaEstrategia::create([
                            'id_estrategia' => $estrategia->id,
                            'id_buyer_persona' => $mied->id,
                        ]);
                    }
                    $k++;
                }
            }

            $k = 0;
            foreach($request->responsable as $responsables){
                $responsable[$k] = $responsables;
                $k++;
            }
            $k = 0;
            foreach($request->responsable_id as $responsables_id){
                if( $responsable[$k] == null && $responsables_id != 0 ){
                    $respon = ResponsableEstrategia::select('id', 'id_responsable')
                                                ->where('id_responsable', $responsables_id)
                                                ->where('id_estrategia', $estrategia->id)
                                                ->get();
                    $responsa = ResponsableEstrategia::find($respon[0]->id);
                    $responsa->delete();
                }
                else if( $responsables_id != 0 ){
                    $respon = ResponsableEstrategia::select('id_responsable')
                                                ->where('id_responsable', $responsables_id)
                                                ->where('id_estrategia', $estrategia->id)
                                                ->get();
                    $responsa = Responsable::find($respon[0]->id_responsable);
                    $responsa->update([
                        'responsable' => $responsable[$k],
                        'updated_at' => $fecha,
                    ]);
                }
                else if ( $responsable[$k] != null && $responsables_id == 0 ) {
                    $respon = Responsable::create([
                        'responsable' => $responsable[$k],
                        'created_at' => $fecha,
                    ]);
                    $responsable2 = ResponsableEstrategia::create([
                        'id_estrategia' => $estrategia->id,
                        'id_responsable' => $respon->id,
                    ]);
                }
                $k++;
            }

            $k = 0;
            foreach($request->recurso as $recurso){
                $recursos[$k] = $recurso;
                $k++;
            }
            $k = 0;
            foreach($request->tipo_recurso as $tipo_recurso){
                $tipo_recursos[$k] = $tipo_recurso;
                $k++;
            }
            $k = 0;
            foreach($request->recurso_id as $recurso_id){
                if( $recursos[$k] == null && $recurso_id != 0 ){
                    $recur = RecursoEstrategia::select('id', 'id_recurso')
                                                ->where('id_recurso', $recurso_id)
                                                ->where('id_estrategia', $estrategia->id)
                                                ->get();
                    $recur = RecursoEstrategia::find($recur[0]->id);
                    $recur->delete();
                }
                else if( $recurso_id != 0 ){
                    $recur = RecursoEstrategia::select('id_recurso')
                                                ->where('id_recurso', $recurso_id)
                                                ->where('id_estrategia', $estrategia->id)
                                                ->get();
                    $recur = Recurso::find($recur[0]->id_recurso);
                    $recur->update([
                        'recurso' => $recursos[$k],
                        'tipo_recurso' => $tipo_recursos[$k],
                        'updated_at' => $fecha,
                    ]);
                }
                else if ( $recursos[$k] != null && $recurso_id == 0 ) {
                    $recur = Recurso::create([
                        'recurso' => $recursos[$k],
                        'tipo_recurso' => $tipo_recursos[$k],
                        'created_at' => $fecha,
                    ]);
                    $recurso2 = RecursoEstrategia::create([
                        'id_estrategia' => $estrategia->id,
                        'id_recurso' => $recur->id,
                    ]);
                }
                $k++;
            }

            $k = 0;
            foreach($request->fase as $fase){
                $fases[$k] = $fase;
                $k++;
            }
            $k = 0;
            foreach($request->fases_fecha_inicio as $fases_fecha_inicio){
                $fases_inicio[$k] = $fases_fecha_inicio;
                $k++;
            }
            $k = 0;
            foreach($request->fases_fecha_final as $fases_fecha_final){
                $fases_final[$k] = $fases_fecha_final;
                $k++;
            }
            $k = 0;
            foreach($request->fases_id as $fase_id){
                if( $fases[$k] == null && $fase_id != null ){
                    $fas = FaseEstrategia::find($fase_id);
                    $fas->delete();
                }
                else if( $fase_id != null ){
                    $fas = FaseEstrategia::find($fase_id);
                    $recur->update([
                        'fase' => $fases[$k],
                        'fecha_inicio' => $fases_inicio[$k],
                        'fecha_final' => $fases_final[$k],
                        'updated_at' => $fecha,
                    ]);
                }
                else if ( $fases[$k] != null && $fase_id == null ) {
                    $fas = FaseEstrategia::create([
                        'fase' => $fases[$k],
                        'fecha_inicio' => $fases_inicio[$k],
                        'fecha_final' => $fases_final[$k],
                        'num_fase' => $k + 1,
                        'id_estrategia' => $estrategia->id,
                        'created_at' => $fecha,
                    ]);
                }
                $k++;
            } 
            
            DB::commit();
        }
        catch(Exception $exception){
            DB::rollBack();
            session(['error' => true]);
            return redirect()->back();
        }

        return redirect()->route('jet-filter.marketing.estrategias')->with('actualizado', true);
    }

    public function datos(){
        $estrategia = Estrategia::all();

        return response()->json($estrategia);
    }

    public function objetivos($id){
        $objetivos = Estrategia::find($id);

        $objetivos = $objetivos->objetivo;

        return response()->json($objetivos);
    }

    public function recursos($id){
        $id_recurso = RecursoEstrategia::where('id_estrategia', $id)->get();

        $k = 0;
        foreach($id_recurso as $id){
            $recursos[$k] = Recurso::find($id->id_recurso);
            $recursos[$k] = $recursos[$k];
            $k++;
        }

        return response()->json($recursos);
    }

    public function fases($id){
        $id_fases = FaseEstrategia::where('id_estrategia', $id)->get();

        return response()->json($id_fases);
    }

    public function recursos_edit($id){
        $id_recurso = RecursoEstrategia::where('id_estrategia', $id)->get();

        $recursos = [];
        foreach($id_recurso as $id){
            $id = Recurso::find($id->id_recurso);
            array_push($recursos, $id);
        }

        return response()->json($recursos);
    }

    public function buyer_persona($id){
        $id_buyer = BuyerPersonaEstrategia::where('id_estrategia', $id)->get();

        $demograficos = [];
        $psicologicos = [];
        $metas = [];
        $miedos = [];
        foreach($id_buyer as $id){
            $id = BuyerPersona::find($id->id_buyer_persona);
            if( $id->tipo == 'demografico' ){
                array_push($demograficos, $id);
            }
            else if( $id->tipo == 'psicologico' ){
                array_push($psicologicos, $id);
            }
            else if( $id->tipo == 'meta' ){
                array_push($metas, $id);
            }
            else if( $id->tipo == 'miedo' ){
                array_push($miedos, $id);
            }
        }

        $contador_demograficos = count( $demograficos );
        $contador_psicologicos = count( $psicologicos );
        $contador_metas = count( $metas );
        $contador_miedos = count( $miedos );

        return response()->json( [ $demograficos, $psicologicos, $metas, $miedos, $contador_demograficos, $contador_psicologicos, $contador_metas, $contador_miedos ] );
    }

    public function responsables($id){
        $id_responsable = ResponsableEstrategia::where('id_estrategia', $id)->get();

        $responsable = [];
        foreach($id_responsable as $id){
            $id = Responsable::find($id->id_responsable);
            array_push($responsable, $id);
        }

        return response()->json($responsable);
    }

    public function kpi($id){
        $estrategia = Estrategia::find($id);

        $kpi = $estrategia->kpi;
        $valor_referencial = $estrategia->valor_referencial;
        $tipo_valor_referencial = $estrategia->tipo_valor_referencial;
        $resultado = $estrategia->resultado;

        return response()->json( [$kpi, $valor_referencial, $resultado, $tipo_valor_referencial] );
    }

    public function kpi_store($id, Request $request){
        $estrategia = Estrategia::find($id);

        $estrategia->update([
            'kpi' => $request->input('kpi'),
            'valor_referencial' => $request->input('valor_referencia'),
            'tipo_valor_referencial' => $request->input('tipo_valor_referencia'),
            'resultado' => $request->input('valor_referencia_resultado'),
        ]); 

        $actualizado_kpi = true;

        return $actualizado_kpi;
    }

    public function analisis($id){
        $estrategia = Estrategia::find($id);

        $analisis = $estrategia->analisis;

        return response()->json( [$analisis] );
    }

    public function analisis_store($id, Request $request){
        $estrategia = Estrategia::find($id);

        $estrategia->update([
            'analisis' => $request->input('analisis'),
        ]);

        return true;
    }
}
