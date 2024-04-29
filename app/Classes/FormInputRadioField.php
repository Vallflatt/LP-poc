<?php

namespace App\Classes;

class FormInputRadioField extends FormInputField {

    private array $options;

    public function __construct(string $slug, string $rule, array $options)
    {
        parent::__construct($slug, $rule);
        $this->options = $options;
    }

    public function render(): string
    {
        return view('helpers.form-input-radio-field', [
            'value' => $this->currentValue,
            'slug' => $this->getSlug(),
            'hasError' => $this->hasError,
            'name' => $this->getDisplayName(),
            'options' => $this->options,
            ])->render();
    }

}
