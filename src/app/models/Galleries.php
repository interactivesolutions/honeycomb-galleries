<?php

namespace interactivesolutions\honeycombgalleries\app\models;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;
use interactivesolutions\honeycombresources\app\models\HCResources;

class Galleries extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_galleries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'publish_at', 'expires_at'];

    /**
     * List of city parts assigned to the streets
     *
     * @return mixed
     */
    public function images()
    {
        return $this->belongsToMany(HCResources::class, GalleriesResourcesConnections::getTableName(), 'gallery_id', 'resource_id');
    }

}
