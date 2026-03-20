<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class ModifyUser extends Component

{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $user;
    public $stati;

    public function __construct($user, $stati)
    {
        //
        $this->user = $user;
        $this->stati = $stati;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.modify-user');
    }
}
