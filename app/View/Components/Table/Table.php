<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $idTable;
    public array $intestazioni;

//    public array $larghezze;

    public function __construct($idTable, array $intestazioni)
    {
        //
        $this->intestazioni = $intestazioni;
        $this->idTable = $idTable;
//        $this->larghezze = $larghezze;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table.table');
    }
}
