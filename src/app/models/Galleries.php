<?php

namespace interactivesolutions\honeycombgalleries\app\models;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;

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

}
