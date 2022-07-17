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
    public $class;

    /** @var string */
    public $classDiv;

    /** @var string */
    public $classPrimary;

    /** @var string */
    public $placeholder;

    /** @var string */
    public $icon;

    /** @var string */
    public $id;

    /** @var string */
    public $type;

    /** @var string */
    public string $disabled;

    /** @var string */
    public string $readonly;

    /** @var string|mixed */
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name = '',
        string $label = '',
        string $class = '',
        string $placeholder = '',
        string $icon = 'bi bi-tag',
        string $id = null,
        string $type = 'text',
        string $disabled = '',
        string $readonly = '',
        string $classDiv = '',
        $value = null
    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->class = $class;
        $this->classPrimary = explode(' ', $class)[0];
        $this->placeholder = $placeholder;
        $this->icon = $icon;
        $this->id = $id ?? $name;
        $this->type = $type;
        $this->disabled = $disabled;
        $this->readonly = $readonly;
        $this->classDiv = $classDiv;
        $this->value = old() ? old($name) : $value ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }

    public function isDisabled(): bool
    {
        return (isset($this->disabled) && ($this->disabled == 'true' || $this->disabled == '1'));
    }

    public function isReadonly(): bool
    {
        return (isset($this->readonly) && ($this->readonly == 'true' || $this->readonly == '1'));
    }
}
