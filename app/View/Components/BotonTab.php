<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BotonTab extends Component
{
    /**
     * Create a new component instance.
     */
    public $numero;
    public $texto;

    public function __construct($numero, $texto)
    {
        $this->numero = $numero;
        $this->texto = $texto;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.boton-tab');
    }
}
