<?php

namespace App\View\Components\Shared;

use Illuminate\View\Component;

class EmptyBox extends Component
{
    public $text;
    public $subtext;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $text = "sin información", string $subtext = null)
    {
        $this->text = $text;
        $this->subtext = $subtext;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.shared.empty-box');
    }
}
