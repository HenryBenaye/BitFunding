<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserProjectInfo extends Component
{
    public $deposit;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($deposit)
    {
        $this->deposit = $deposit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-project-info');
    }
}
