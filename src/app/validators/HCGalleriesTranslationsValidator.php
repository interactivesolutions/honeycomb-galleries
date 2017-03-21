<?php namespace interactivesolutions\honeycombgalleries\app\validators;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCGalleriesTranslationsValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'translations.*.language_code' => 'required',
            'translations.*.title'         => 'required',
        ];
    }
}