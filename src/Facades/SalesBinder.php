<?php 
namespace Achieversaim\Larasalesbinder\Facades;

use Illuminate\Support\Facades\Facade;

class SalesBinder extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return \Achieversaim\Larasalesbinder\SalesBinder::class; }

}