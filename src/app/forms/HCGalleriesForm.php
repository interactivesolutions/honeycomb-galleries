<?php

namespace interactivesolutions\honeycombgalleries\app\forms;

class HCGalleriesForm
{
    // name of the form
    protected $formID = 'galleries';

    // is form multi language
    protected $multiLanguage = 1;

    /**
     * Creating form
     *
     * @param bool $edit
     * @return array
     */
    public function createForm(bool $edit = false)
    {
        $form = [
            'storageURL' => route('admin.api.galleries'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans('HCCoreUI::core.button.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "singleLine",
                    "fieldID"         => "title",
                    "tabID"           => trans("Translations"),
                    "label"           => trans("HCGalleries::galleries.title"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "multiLanguage"   => 1,
                ],
                [
                    "type"            => "richTextArea",
                    "fieldID"         => "content",
                    "tabID"           => trans("Translations"),
                    "label"           => trans("HCGalleries::galleries.content"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "location",
                    "tabID"           => trans("General"),
                    "label"           => trans("HCGalleries::galleries.location"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ],
                [
                    "type"            => "dateTimePicker",
                    "properties"      => [
                        "format" => "Y-M-D HH:mm:ss",
                    ],
                    "fieldID"         => "publish_at",
                    "tabID"           => trans("General"),
                    "label"           => trans("HCGalleries::galleries.publish_at"),
                    "required"        => 0,
                    "requiredVisible" => 1,
                ], [
                    "type"            => "dateTimePicker",
                    "properties"      => [
                        "format" => "Y-M-D HH:mm:ss",
                    ],
                    "fieldID"         => "expires_at",
                    "tabID"           => trans("General"),
                    "label"           => trans("HCGalleries::galleries.expires_at"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "resource",
                    "fieldID"         => "images",
                    "tabID"           => trans("Resources"),
                    "uploadURL"       => route("admin.api.resources"),
                    "viewURL"         => route("resource.get", ['/']),
                    "sortable"        => 1,
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
            ],
        ];

        if ($this->multiLanguage)
            $form['availableLanguages'] = getHCContentLanguages();

        if (!$edit)
            return $form;

        //Make changes to edit form if needed
        $form['structure'][] =
            [
                "type"          => "singleLine",
                "fieldID"       => "slug",
                "tabID"         => trans("Translations"),
                "label"         => trans("HCGalleries::galleries.slug"),
                "readonly"      => 1,
                "multiLanguage" => 1,
            ];

        return $form;
    }
}