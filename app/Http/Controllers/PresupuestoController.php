<?php

namespace App\Http\Controllers;

use App\Models\Estrategia;
use App\Models\Presupuesto;
use App\Models\TareaPresupuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresupuestoController extends Controller
{
    public function presupuesto_cantidades() {
        $estrategias = Estrategia::all();

        return $estrategias;
    }

    public function actividades($id){
        $presupuesto_id = TareaPresupuesto::where('id_padre', 0)
                                    ->where('id_estrategia', $id)
                                    ->with('children')->get();

        $hijos = [];
        foreach($presupuesto_id as $presupuesto){
            $hijos2 = $this->descubrirHijos(0, [], $presupuesto);
            $hijos = array_merge($hijos, $hijos2);
        }

        return response()->json($hijos);
    }

    public function descubrirHijos(int $nivel, array $arreglo, TareaPresupuesto $tareaBuscar){
        if( count( $tareaBuscar->children ) == 0 ){
            $tarea = new Tarea($tareaBuscar->id, $tareaBuscar->tarea, $tareaBuscar->valor, $tareaBuscar->id_padre, $nivel);
            array_push($arreglo, $tarea);
            return $arreglo;
        }
        else {
            $tarea = new Tarea($tareaBuscar->id, $tareaBuscar->tarea, $tareaBuscar->valor, $tareaBuscar->id_padre, $nivel);
            array_push($arreglo, $tarea);
            for($i = 0; $i < count( $tareaBuscar->children ); $i++){
                $j = $nivel + ($i + 1);
                $arreglo = $this->descubrirHijos($j, $arreglo, $tareaBuscar->children[$i]);
                $nivel = $nivel - 1;
            }
            return $arreglo;
        }
    }

    public function store(Request $request){
        $tarea = $request->input('tarea');
        $valor = $request->input('presupuesto');
        $id_padre = $request->input('id_padre');
        $id_estrategia = $request->input('id_estrategia');

        if( $id_padre == 0 ){
            $estrategia = Estrategia::find($id_estrategia);

            $presupuesto_estrategia = $estrategia->presupuesto;

            $tareas_padres = TareaPresupuesto::select('valor')
                                                ->where('id_padre', 0)
                                                ->where('id_estrategia', $id_estrategia)
                                                ->get();

            $tarea_mas_nueva = $valor;
            foreach( $tareas_padres as $tarea_padre ){
                $tarea_mas_nueva += $tarea_padre->valor;
            } 

            if( $tarea_mas_nueva > $presupuesto_estrategia){
                return redirect()->route('jet-filter.marketing.presupuesto.edit', [ 'id' => $id_estrategia ])->with('rebasa_presupuesto', true)->with('presupuesto_estrategia', $presupuesto_estrategia)->with('tarea_mas_nueva', $tarea_mas_nueva);
            }                                   
        }
        else {
            $padre = TareaPresupuesto::find($id_padre);

            $presupuesto_padre = $padre->valor;

            $childrens = $padre->children_sin_children;
            
            $tarea_mas_nueva = $valor;
            foreach( $childrens as $children ){
                $tarea_mas_nueva += $children->valor;
            } 

            if( $tarea_mas_nueva > $presupuesto_padre){
                return redirect()->route('jet-filter.marketing.presupuesto.edit', [ 'id' => $id_estrategia ])->with('rebasa_presupuesto_tareas', true)->with('presupuesto_padre', $presupuesto_padre)->with('tarea_mas_nueva', $tarea_mas_nueva);
            }     
        }

        $presupuesto = TareaPresupuesto::create([
            'tarea' => $tarea,
            'valor' => $valor,
            'id_padre' => $id_padre,
            'id_estrategia' => $id_estrategia,
        ]); 

        session(['creado' => true]);
        return redirect()->route('jet-filter.marketing.presupuesto.edit', [ 'id' => $id_estrategia ]);
    }

    public function edit($id){
        return view('marketing.presupuesto.editar');
    }

    public function edit_datos(Estrategia $estrategia){
        return $estrategia;
    }

    public function delete($id_estrategia, $id_tarea){
        $tarea = TareaPresupuesto::find($id_tarea);
        $tarea->delete();
        session(['eliminado' => true]);
        return redirect()->route('jet-filter.marketing.presupuesto.edit', [ 'id' => $id_estrategia ]);
    }
    
}

class Tarea {
    public string $tarea;
    public string $valor;
    public string $id;
    public string $id_padre;
    public string $nivel;

    function __construct($id, $tarea, $valor, int $id_padre = null, int $nivel)
    {
        $this->tarea = $tarea;
        $this->valor = $valor;
        $this->id = $id;
        $this->id_padre = $id_padre;
        $this->nivel = $nivel;
    }
}