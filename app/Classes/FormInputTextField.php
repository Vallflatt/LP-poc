<?php

namespace App\Classes;

class FormInputTextField extends FormInputField {
    public function render(): string
    {
        return view('helpers.form-input-text-field', [
            'value' => $this->currentValue,
            'slug' => $this->getSlug(),
            'hasError' => $this->hasError,
            'name' => $this->getDisplayName(),
            ])->render();
    }
}
