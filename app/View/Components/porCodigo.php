<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class porCodigo extends Component
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
        $tipo_aplicaciones = DB::table('aplicacion_tipo')
                                ->select('id','aplicacion')
                                ->get();

        for($i = 0; $i < count($tipo_aplicaciones); $i++){
            $tipo_aplicaciones[$i]->aplicacion = substr($tipo_aplicaciones[$i]->aplicacion, 1);
        }

        $paginas = ['10', '25', '50', '100'];

        return view('busqueda_codigos.por_codigo', compact( 'tipo_aplicaciones', 'paginas' ));
    }
}
