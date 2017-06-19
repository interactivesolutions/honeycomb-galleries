<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('galleries', ['as' => 'admin.galleries.index', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@adminIndex']);

    Route::group(['prefix' => 'api/galleries'], function ()
    {
        Route::get('/', ['as' => 'admin.api.galleries', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_create'], 'uses' => 'HCGalleriesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_delete'], 'uses' => 'HCGalleriesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.galleries.list', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.galleries.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@apiRestore']);
        Route::post('merge', ['as' => 'admin.api.galleries.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_create', 'acl:interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.galleries.force.multi', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_force_delete'], 'uses' => 'HCGalleriesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.galleries.single', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_delete'], 'uses' => 'HCGalleriesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.galleries.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_create'], 'uses' => 'HCGalleriesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.galleries.duplicate', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.galleries.force', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_force_delete'], 'uses' => 'HCGalleriesController@apiForceDelete']);
        });
    });
});
