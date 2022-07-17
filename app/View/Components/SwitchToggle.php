<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SwitchToggle extends Component
{

    /** @var string */
    public $name;

    /** @var string */
    public $label;

    /** @var string */
    public $class;

    /** @var string */
    public $id;

    /** @var string */
    public string $disabled;

    /** @var string */
    public $checked;

    /** @var string */
    public $inlineLabel;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $name = '',
        string $label = '',
        string $class = '',
        string $id = null,
        string $disabled = '',
        string $inlineLabel = '',
        $checked = false
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->class = $class;
        $this->id = $id ?? $name;
        $this->disabled = $disabled;
        $this->inlineLabel = $inlineLabel;
        $this->checked = old($name, $checked);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.switch-toggle');
    }

    public function isDisabled(): bool
    {
        return (isset($this->disabled) && ($this->disabled == 'true' || $this->disabled == '1'));
    }

    public function isInlineLabel(): bool
    {
        return (isset($this->inlineLabel) && ($this->inlineLabel == 'true'));
    }

    public function isChecked(): bool
    {
        return (isset($this->checked) && ($this->checked == 'true' || $this->checked == '1'));
    }
}
