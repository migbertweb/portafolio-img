<?php

namespace App\Livewire;

use Livewire\Component;

class ProjectCard extends Component
{
    public $title;
    public $description;
    public $images = [];
    public $github;
    public $website;

    public function render()
    {
        return view('livewire.project-card');
    }
}
