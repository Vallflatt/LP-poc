<?php

namespace App\Classes;

use Illuminate\Http\Request;
use App\Classes\FormInputField;

class FormBlock
{
    public bool $hasError = false;
    private string $slug;
    /** @var FormInputField[] */
    private array $fields;

    /** @param FormInputField[] $fields */
    public function __construct(string $slug, array $fields)
    {
        $this->slug = $slug;
        $this->fields = $fields;
    }

    /** @return FormInputField[] */
    public function getFields(): array
    {
        return $this->fields;
    }

    public function getFieldBySlug(string $slug): FormInputField
    {
        return array_values(array_filter($this->getFields(), function($field) use ($slug) {
            return $slug === $field->getSlug();
        }))[0];
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function validate(Request $request): bool
    {
        foreach($this->getFields() as $field)
        {
            $field->validate($request);
            $this->hasError = $this->hasError || $field->hasError;
        }
        return $this->hasError;
    }

    public function getErrorMessage(): string
    {
        $errorFields = array_filter($this->getFields(), function($field) {
            return $field->hasError;
        });

        if (empty($errorFields))
        {
            return '';
        }

        // TODO not all errors are due to missing values. Manage that.
        // TODO translate
        return "Veuillez saisir une valeur pour " . implode(', ', array_map(function($field) {
            return $field->getSlug();
        }, $errorFields));
    }

    public function getDisplayName(): string
    {
        // TODO translate
        return ucfirst(str_replace('-', ' ', $this->getSlug()));
    }

    public function saveInSession(): array
    {
        $fieldsInfo = array_reduce($this->getFields(), function ($accumulator, $field) {
            return array_merge($accumulator, $field->saveInSession());
        }, []);
        return [$this->getSlug() => $fieldsInfo];
    }

    public function loadFromSession(array | null $data): void
    {
        if ($data)
        {
            foreach($this->getFields() as $field)
            {
                if ($field->getValue() === null)
                {
                    $field->loadFromSession($data[$field->getSlug()] ?? null);
                }
            }
        }
    }
}
