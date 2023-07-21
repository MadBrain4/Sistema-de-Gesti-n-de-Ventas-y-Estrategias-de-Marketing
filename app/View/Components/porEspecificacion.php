<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class porEspecificacion extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $aplicacion_tipo = DB::table('aplicacion_tipo')
                                ->select('aplicacion', 'id')
                                ->get();

        for($i = 0; $i < count($aplicacion_tipo); $i++){
            $aplicacion_tipo[$i]->aplicacion = substr($aplicacion_tipo[$i]->aplicacion, 1);
        }

        $paginas = [10, 25, 50, 100];
        return view('busqueda_especificaciones.por_especificacion', compact( 'paginas', 'aplicacion_tipo' ));
    }
}
