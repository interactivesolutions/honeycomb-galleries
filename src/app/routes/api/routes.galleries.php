<?php

Route::group(['prefix' => 'api', 'middleware' => ['web', 'auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/galleries'], function ()
    {
        Route::get('/', ['as' => 'api.v1.galleries', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@listPage']);
        Route::get('list', ['as' => 'api.v1.galleries.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@list']);
        Route::get('list/{timestamp}', ['as' => 'api.v1.galleries.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@listUpdate']);
        Route::get('search', ['as' => 'api.v1.galleries.search', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@listSearch']);
        Route::get('{id}', ['as' => 'api.v1.galleries.single', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'api.v1.galleries.duplicate', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@duplicate']);
        Route::post('restore', ['as' => 'api.v1.galleries.restore', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@restore']);
        Route::post('merge', ['as' => 'api.v1.galleries.merge', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@merge']);
        Route::post('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_create'], 'uses' => 'HCGalleriesController@create']);

        Route::put('{id}', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@update']);
        Route::put('{id}/strict', ['as' => 'api.v1.galleries.update.strict', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_delete'], 'uses' => 'HCGalleriesController@delete']);
        Route::delete('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_delete'], 'uses' => 'HCGalleriesController@delete']);
        Route::delete('{id}/force', ['as' => 'api.v1.galleries.force', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_force_delete'], 'uses' => 'HCGalleriesController@forceDelete']);
        Route::delete('force', ['as' => 'api.v1.galleries.force.multi', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_galleries_galleries_force_delete'], 'uses' => 'HCGalleriesController@forceDelete']);
    });
});
