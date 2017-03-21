<?php

namespace interactivesolutions\honeycombgalleries\app\models;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class GalleriesResourcesConnections extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_galleries_resources_connections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['gallery_id', 'resource_id'];
}