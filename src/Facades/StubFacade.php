<?php

namespace LunarExtend\Stub\Facades;

use Illuminate\Support\Facades\Facade;

class StubFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'lunar-extend:stub';
    }

}