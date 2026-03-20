<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class ModifyUserRoles extends Component

{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $user;
    public $ruoli;
    public $userroles;

    public function __construct($user, $ruoli, $userroles)
    {
        //
        $this->user = $user;
        $this->ruoli = $ruoli;
        $this->userroles = $userroles;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.modify-user-roles');
    }
}
