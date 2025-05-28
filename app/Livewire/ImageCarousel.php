<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class ImageCarousel extends Component
{
    /**
     * @return View
     */
    public function render()
    {
        return view('livewire.image-carousel');
    }
}
