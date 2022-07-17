<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
      /** @var string */
      public $name;

      /** @var string */
      public $multiple;

      /** @var string */
      public $label;

      /** @var string */
      public $class;

      /** @var string */
      public $classDiv;

      /** @var string */
      public $icon;

      /** @var string */
      public $id;

      /** @var string */
      public string $disabled;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name = '',
        string $multiple = '',
        string $label = '',
        string $class = '',
        string $icon = 'bi bi-tag',
        string $id = null,
        string $disabled = '',
        string $classDiv = '',
    )
    {
        $this->name = $name;
        $this->multiple = $multiple;
        $this->label = $label;
        $this->class = $class;
        $this->icon = $icon;
        $this->id = $id ?? $name;
        $this->disabled = $disabled;
        $this->classDiv = $classDiv;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select');
    }

    public function isDisabled(): bool
    {
        return (isset($this->disabled) && ($this->disabled == 'true' || $this->disabled == '1'));
    }

    public function isMultiple(): bool
    {
        return (isset($this->multiple) && ($this->multiple == 'true' || $this->multiple == '1'));
    }
}
