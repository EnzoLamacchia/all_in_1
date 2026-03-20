<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class SetUser2Permission extends Component

{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $permesso;
    public $usersWithoutActualPermission;
    public $usersWithActualPermission;

    public function __construct($permesso, $usersWithoutActualPermission, $usersWithActualPermission)
    {
        //
        $this->usersWithActualPermission = $usersWithActualPermission;
        $this->permesso = $permesso;
        $this->usersWithoutActualPermission = $usersWithoutActualPermission;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.setuser2permission');
    }
}
