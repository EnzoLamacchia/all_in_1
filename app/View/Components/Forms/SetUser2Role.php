<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class SetUser2Role extends Component

{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $ruolo;
    public $usersWithoutActualRole;
    public $usersWithActualRole;

    public function __construct($ruolo, $usersWithoutActualRole, $usersWithActualRole)
    {
        //
        $this->usersWithActualRole = $usersWithActualRole;
        $this->ruolo = $ruolo;
        $this->usersWithoutActualRole = $usersWithoutActualRole;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.setuser2role');
    }
}
