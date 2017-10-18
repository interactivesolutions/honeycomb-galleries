<?php

namespace interactivesolutions\honeycombgalleries\app\models;


use InteractiveSolutions\HoneycombCore\Models\HCUuidModel;

class GalleriesTranslations extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_galleries_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'record_id', 'language_code', 'title', 'slug', 'content', 'location'];
}