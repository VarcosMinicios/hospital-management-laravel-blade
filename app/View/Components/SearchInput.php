<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /** @var string */
    public $name;

    /** @var string */
    public $label;

    /** @var string */
    public $placeholder;

    /** @var string */
    public $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name = '',
        string $label = '',
        string $placeholder = '',
        string $id = null,
    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.search-input');
    }
}
