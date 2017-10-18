<?php

namespace interactivesolutions\honeycombgalleries\app\forms;


use InteractiveSolutions\HoneycombCore\Http\Controllers\Interfaces\HCForm;

class HCGalleriesForm implements HCForm
{
    // name of the form
    protected $formID = 'galleries';

    // is form multi language
    protected $multiLanguage = 1;

    // prefix for field id's
    private $prefix = 'gallery.';

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * Creating form
     *
     * @param bool $edit
     * @return array
     */
    public function createForm(bool $edit = false)
    {
        $this->prefix = '';

        $form = [
            'storageURL' => route('admin.api.galleries'),
            'buttons' => [
                [
                    "class" => "col-centered",
                    "label" => trans('HCTranslations::core.buttons.submit'),
                    "type" => "submit",
                ],
            ],
            'structure' => $this->getNewStructure(),
        ];

        if ($this->multiLanguage) {
            $form['availableLanguages'] = getHCContentLanguages();
        }

        if (!$edit) {
            return $form;
        }

        //Make changes to edit form if needed
        $form['structure'] = array_merge($form['structure'], $this->getEditStructure(true));

        return $form;
    }

    /**
     * New form structure
     *
     * @return array
     */
    public function getNewStructure()
    {
        return [
            [
                "type" => "singleLine",
                "fieldID" => $this->prefix . "title",
                "tabID" => trans("Translations"),
                "label" => trans("HCGalleries::galleries.title"),
                "required" => 1,
                "requiredVisible" => 1,
                "multiLanguage" => 1,
            ],
            [
                "type" => "richTextArea",
                "fieldID" => $this->prefix . "content",
                "tabID" => trans("Translations"),
                "label" => trans("HCGalleries::galleries.content"),
                "multiLanguage" => 1,
            ],
            [
                "type" => "singleLine",
                "fieldID" => $this->prefix . "location",
                "tabID" => trans("General"),
                "label" => trans("HCGalleries::galleries.location"),
                "multiLanguage" => 1,
            ],
            [
                "type" => "dateTimePicker",
                "properties" => [
                    "format" => "YYYY-MM-DD HH:mm:ss",
                ],
                "fieldID" => $this->prefix . "publish_at",
                "tabID" => trans("General"),
                "label" => trans("HCGalleries::galleries.publish_at"),
                "requiredVisible" => 1,
            ],
            [
                "type" => "dateTimePicker",
                "properties" => [
                    "format" => "YYYY-MM-DD HH:mm:ss",
                ],
                "fieldID" => $this->prefix . "expires_at",
                "tabID" => trans("General"),
                "label" => trans("HCGalleries::galleries.expires_at"),


            ],
            [
                "type" => "resource",
                "fieldID" => $this->prefix . "images",
                "tabID" => trans("Resources"),
                "uploadURL" => route("admin.api.resources"),
                "viewURL" => route("resource.get", ['/']),
                "sortable" => 1,
            ],
        ];
    }

    public function getEditStructure(bool $append = false)
    {
        $fields = [];
        $fields[] = [
            "type" => "singleLine",
            "fieldID" => $this->prefix . "slug",
            "tabID" => trans("Translations"),
            "label" => trans("HCGalleries::galleries.slug"),
            "readonly" => 1,
            "multiLanguage" => 1,
        ];

        if ($append) {
            return $fields;
        } else {
            return array_merge($this->getNewStructure(), $fields);
        }

    }


}