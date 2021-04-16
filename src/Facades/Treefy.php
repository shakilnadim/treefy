<?php

namespace ShakilNadim\Treefy\Facades;

use Illuminate\Support\Facades\Facade;

class Treefy extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Treefy';
    }
}
