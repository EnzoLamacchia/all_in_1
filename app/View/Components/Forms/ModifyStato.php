<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class ModifyStato extends Component

{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $stato;

    public function __construct($stato)
    {
        //
        $this->stato = $stato;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.modify-stato');
    }
}
