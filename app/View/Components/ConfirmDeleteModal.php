<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ConfirmDeleteModal extends Component
{
    public $route;
    public $message;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $message)
    {
        $this->route = $route;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.confirm-delete-modal');
    }
}
