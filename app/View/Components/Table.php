<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{

    /** @var array */
    public $columns;

    /** @var array */
    public $data;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $columns = [], array $data = [])
    {
        $this->columns = $columns;
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table');
    }
}
