<?php

namespace App\Classes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class FormInputField {
    public bool $hasError = false;
    protected string $slug;
    protected string $rule;
    protected string|null $currentValue = null;

    public function __construct(string $slug, string $rule)
    {
        $this->slug = $slug;
        $this->rule = $rule;
    }

    abstract public function render(): string;

    public function getDisplayName(): string
    {
        // TODO translate
        return ucfirst(str_replace('_', ' ', $this->getSlug()));
    }

    public function loadFromSession(string | null $data): void
    {
        $this->currentValue = $data;
    }

    public function saveInSession(): array | null
    {
        return [$this->getSlug() => $this->currentValue];
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getValue(): string | null
    {
        return $this->currentValue;
    }

    public function validate(Request $request): void
    {
        $this->currentValue = $request->input($this->getSlug());
        $validator = Validator::make($request->all(), $this->getRule());
        $this->hasError = $validator->fails();
    }

    protected function getRule(): array
    {
        return [$this->getSlug() => $this->rule];
    }
}
