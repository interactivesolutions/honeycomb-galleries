<?php

Route::group(['prefix' => env('HC_ADMIN_URL'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('galleries', ['as' => 'admin.galleries', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@adminView']);

    Route::group(['prefix' => 'api/galleries'], function ()
    {
        Route::get('/', ['as' => 'admin.api.galleries', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@listPage']);
        Route::get('list', ['as' => 'admin.api.galleries.list', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@list']);
        Route::get('list/{timestamp}', ['as' => 'admin.api.galleries.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@listUpdate']);
        Route::get('search', ['as' => 'admin.api.galleries.search', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@listSearch']);
        Route::get('{id}', ['as' => 'admin.api.galleries.single', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_list'], 'uses' => 'HCGalleriesController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'admin.api.galleries.duplicate', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@duplicate']);
        Route::post('restore', ['as' => 'admin.api.galleries.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@restore']);
        Route::post('merge', ['as' => 'admin.api.galleries.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@merge']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_create'], 'uses' => 'HCGalleriesController@create']);

        Route::put('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@update']);
        Route::put('{id}/strict', ['as' => 'admin.api.galleries.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_update'], 'uses' => 'HCGalleriesController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_delete'], 'uses' => 'HCGalleriesController@delete']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_delete'], 'uses' => 'HCGalleriesController@delete']);
        Route::delete('{id}/force', ['as' => 'admin.api.galleries.force', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_force_delete'], 'uses' => 'HCGalleriesController@forceDelete']);
        Route::delete('force', ['as' => 'admin.api.galleries.force.multi', 'middleware' => ['acl:interactivesolutions_honeycomb_galleries_galleries_force_delete'], 'uses' => 'HCGalleriesController@forceDelete']);
    });
});
