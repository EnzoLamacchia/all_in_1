<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class ShowVocabolario extends Component

{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $vocabolario;

    public function __construct($vocabolario)
    {
        //
        $this->vocabolario = $vocabolario;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.show-vocabolario');
    }
}
