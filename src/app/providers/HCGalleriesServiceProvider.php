<?php

namespace interactivesolutions\honeycombgalleries\app\providers;


use InteractiveSolutions\HoneycombCore\Providers\HCBaseServiceProvider;

class HCGalleriesServiceProvider extends HCBaseServiceProvider
{
    protected $homeDirectory = __DIR__;

    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycombgalleries\app\http\controllers';

    public $serviceProviderNameSpace = 'HCGalleries';
}





