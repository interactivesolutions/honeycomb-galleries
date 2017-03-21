<?php

namespace interactivesolutions\honeycombgalleries\app\providers;

use interactivesolutions\honeycombcore\providers\HCBaseServiceProvider;

class HCGalleriesServiceProvider extends HCBaseServiceProvider
{
    protected $homeDirectory = __DIR__;

    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycombgalleries\app\http\controllers';

    public $serviceProviderNameSpace = 'HCGalleries';
}





