<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/galleries'], function ()
    {
        Route::get('/', ['as' => 'api.v1.galleries', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_create'], 'uses' => 'HCGalleriesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_delete'], 'uses' => 'HCGalleriesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.galleries.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@apiIndex']);
            Route::get('{timestamp}', ['as' => 'api.v1.galleries.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.galleries.restore', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.galleries.merge', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_create', 'acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.galleries.force.multi', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_force_delete'], 'uses' => 'HCGalleriesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function () {

            Route::get('/', ['as' => 'api.v1.galleries.single', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_delete'], 'uses' => 'HCGalleriesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.galleries.update.strict', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.galleries.duplicate', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_create'], 'uses' => 'HCGalleriesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.galleries.force', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_force_delete'], 'uses' => 'HCGalleriesController@apiForceDelete']);
        });
    });
});
