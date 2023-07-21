<?php

namespace App\View\Components;

use App\Models\AplicacionTipo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;


class porAplicacion extends Component
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
        $tipo_aplicaciones = AplicacionTipo::select('id','aplicacion')
                                ->get();

        $paginas = ['10', '25', '50', '100'];

        return view('busqueda_aplicaciones.por-aplicacion', compact( 'tipo_aplicaciones', 'paginas' ));
    }
}
