<?php

namespace App\View\Components\Header;

use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $urlCerca;
    public $nomeBtnNuovo;
    public $urlNuovo;
//    public $clk;


    public function __construct($title='',$urlCerca='',$nomeBtnNuovo='', $urlNuovo='')
    {
        //
        $this->title = $title;
        $this->urlCerca = $urlCerca;
        $this->nomeBtnNuovo = $nomeBtnNuovo;
        $this->urlNuovo = $urlNuovo;
//        $this->clk = $clk;
//        $this->larghezze = $larghezze;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header.header');
    }
}
