<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LinkForm extends Component
{
    private $action;
    /**
     * @var string
     */
    private $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action, $class = "")
    {
        $this->action = $action;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.link-form', [
            'action' => $this->action,
            'class' => $this->class,
        ]);
    }
}
