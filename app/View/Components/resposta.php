<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class resposta extends Component
{
    public string $capital;

    public function __construct($capital)
    {   
        $this->capital = $capital;
    }

    public function render(): View|Closure|string
    {
        return view('components.resposta');
    }
}
