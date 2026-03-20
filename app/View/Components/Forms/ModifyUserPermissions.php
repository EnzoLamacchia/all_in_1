<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class ModifyUserPermissions extends Component

{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $user;
    public $permessiNO;
    public $permessiSI;

    public function __construct($user, $permessiSI, $permessiNO)
    {
        //
        $this->user = $user;
        $this->permessiSI = $permessiSI;
        $this->permessiNO = $permessiNO;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.modify-user-permissions');
    }
}
