<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImagenesCatalogo extends Component
{
    public $imagenes;
    public $rann;
    /**
     * Create a new component instance.
     */
    public function __construct($imagenes, $rann)
    {
        $this->imagenes = $imagenes;
        $this->rann = $rann;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('jetfilter.components.imagenes_catalogo');
    }
}
