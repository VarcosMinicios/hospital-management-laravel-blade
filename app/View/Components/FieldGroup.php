<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FieldGroup extends Component
{   
        
    /** @var string */
    public $colSize;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $colSize = '')
    {
        $this->colSize = $colSize ? '-'.$colSize : '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.field-group');
    }
}
