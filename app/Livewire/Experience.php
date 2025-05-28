<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Experience extends Component
{
    private $name;

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.experience');
    }
}
