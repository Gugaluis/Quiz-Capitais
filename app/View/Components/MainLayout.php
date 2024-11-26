<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainLayout extends Component
{

    public string $pageTitle;

    public function __construct(string $pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }


    public function render(): View|Closure|string
    {
        return view('components.main-layout');
    }
}
