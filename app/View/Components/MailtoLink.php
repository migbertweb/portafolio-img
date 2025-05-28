<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MailtoLink extends Component
{
    /**
     * Create a new component instance.
     *
     * @param mixed $email
     * @param mixed $text
     */
    public $email;
    public $text;
    /**
     * @param mixed $email
     * @param mixed $text
     */
    public function __construct($email, $text)
    {
        $this->email = $email;
        $this->text = $text;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mailto-link');
    }
}
