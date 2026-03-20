<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class SetPermission2Role extends Component

{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $ruolo;
    public $permissionAssigned2ActualRole;
    public $permissionNOTAssigned2ActualRole;

    public function __construct($ruolo, $permissionNOTAssigned2ActualRole, $permissionAssigned2ActualRole)
    {
        //
        $this->permissionAssigned2ActualRole = $permissionAssigned2ActualRole;
        $this->ruolo = $ruolo;
        $this->permissionNOTAssigned2ActualRole = $permissionNOTAssigned2ActualRole;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.setpermission2role');
    }
}
