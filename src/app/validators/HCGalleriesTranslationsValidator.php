<?php namespace interactivesolutions\honeycombgalleries\app\validators;


use InteractiveSolutions\HoneycombCore\Http\Controllers\HCCoreFormValidator;

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
            'translations.*.title' => 'required',
        ];
    }
}