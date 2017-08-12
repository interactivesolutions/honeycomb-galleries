<?php namespace interactivesolutions\honeycombgalleries\app\http\controllers;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombgalleries\app\models\Galleries;
use interactivesolutions\honeycombgalleries\app\models\GalleriesTranslations;
use interactivesolutions\honeycombgalleries\app\validators\HCGalleriesValidator;
use interactivesolutions\honeycombgalleries\app\validators\HCGalleriesTranslationsValidator;

class HCGalleriesController extends HCBaseController
{

    //TODO recordsPerPage setting

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminIndex()
    {
        $config = [
            'title'       => trans('HCGalleries::galleries.page_title'),
            'listURL'     => route('admin.api.galleries'),
            'newFormUrl'  => route('admin.api.form-manager', ['galleries-new']),
            'editFormUrl' => route('admin.api.form-manager', ['galleries-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if (auth()->user()->can('interactivesolutions_honeycomb_galleries_galleries_create'))
            $config['actions'][] = 'new';

        if (auth()->user()->can('interactivesolutions_honeycomb_galleries_galleries_update')) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if (auth()->user()->can('interactivesolutions_honeycomb_galleries_galleries_delete'))
            $config['actions'][] = 'delete';

        $config['actions'][] = 'search';
        $config['filters'] = $this->getFilters();

        return hcview('HCCoreUI::admin.content.list', ['config' => $config]);
    }

    /**
     * Creating Admin List Header based on Main Table
     *
     * @return array
     */
    public function getAdminListHeader()
    {
        return [
            'translations.{lang}.title'    => [
                "type"  => "text",
                "label" => trans('HCGalleries::galleries.title'),
            ],
            'translations.{lang}.content'  => [
                "type"  => "text",
                "label" => trans('HCGalleries::galleries.content'),
            ],
            'translations.{lang}.slug'     => [
                "type"  => "text",
                "label" => trans('HCGalleries::galleries.slug'),
            ],
            'translations.{lang}.location' => [
                "type"  => "text",
                "label" => trans('HCGalleries::galleries.location'),
            ],
            'publish_at'                   => [
                "type"  => "text",
                "label" => trans('HCGalleries::galleries.publish_at'),
            ],
            'expires_at'                   => [
                "type"  => "text",
                "label" => trans('HCGalleries::galleries.expires_at'),
            ],
        ];
    }

    /**
     * Create item
     *
     * @param array|null $data
     * @return mixed
     */
    protected function __apiStore(array $data = null)
    {
        if (is_null($data))
            $data = $this->getInputData();

        $record = Galleries::create(array_get($data, 'record'));
        $record->updateTranslations(array_get($data, 'translations'));
        $record->images()->sync(array_get($data, 'images'));

        return $this->apiShow($record->id);
    }

    /**
     * Updates existing item based on ID
     *
     * @param $id
     * @return mixed
     */
    protected function __apiUpdate(string $id)
    {
        $record = Galleries::findOrFail($id);

        $data = $this->getInputData();

        $record->update(array_get($data, 'record'));
        $record->updateTranslations(array_get($data, 'translations'));
        $record->images()->sync(array_get($data, 'images'));


        return $this->apiShow($record->id);
    }

    /**
     * Updates existing specific items based on ID
     *
     * @param string $id
     * @return mixed
     */
    protected function __apiUpdateStrict(string $id)
    {
        Galleries::where('id', $id)->update(request()->all());

        return $this->apiShow($id);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiDestroy(array $list)
    {
        Galleries::destroy($list);

        return hcSuccess();
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiForceDelete(array $list)
    {
        Galleries::onlyTrashed()->whereIn('id', $list)->forceDelete();

        return hcSuccess();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed
     */
    protected function __apiRestore(array $list)
    {
        Galleries::whereIn('id', $list)->restore();

        return hcSuccess();
    }

    /**
     * Creating data query
     *
     * @param array $select
     * @return mixed
     */
    protected function createQuery(array $select = null)
    {
        $with = ['translations'];

        if ($select == null)
            $select = Galleries::getFillableFields();

        $list = Galleries::with($with)->select($select)
            // add filters
            ->where(function ($query) use ($select) {
                $query = $this->getRequestParameters($query, $select);
            });

        // enabling check for deleted
        $list = $this->checkForDeleted($list);

        // add search items
        $list = $this->search($list);

        // ordering data
        $list = $this->orderData($list, $select);

        return $list;
    }

    /**
     * List search elements
     * @param Builder $query
     * @param string $phrase
     * @return Builder
     */
    protected function searchQuery(Builder $query, string $phrase)
    {
        return $query->where (function (Builder $query) use ($phrase) {
                $query->where('publish_at', 'LIKE', '%' . $phrase . '%')
                    ->orWhere('expires_at', 'LIKE', '%' . $phrase . '%');
            });
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        (new HCGalleriesValidator())->validateForm();
        (new HCGalleriesTranslationsValidator())->validateForm();

        $_data = request()->all();

        array_set($data, 'record.publish_at', array_get($_data, 'publish_at'));
        array_set($data, 'record.expires_at', array_get($_data, 'expires_at'));

        array_set($data, 'translations', array_get($_data, 'translations'));
        array_set($data, 'images', array_get($_data, 'images', []));

        foreach ($data['translations'] as &$value)
            $value['slug'] = generateHCSlug(GalleriesTranslations::getTableName() . '_' . $value['language_code'], $value['title']);

        return makeEmptyNullable($data);
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */
    public function apiShow(string $id)
    {
        $with = ['translations', 'images'];

        $select = Galleries::getFillableFields();

        $record = Galleries::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        return $record;
    }

    /**
     * Generating filters required for admin view
     *
     * @return array
     */
    public function getFilters()
    {
        $filters = [];

        return $filters;
    }
}
