<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class ModifyVoice extends Component

{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $vocabolario, $voice;

    public function __construct($voice)
    {
        //
//        $this->vocabolario = $vocabolario;
        $this->voice = $voice;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.modify-voice');
    }
}
