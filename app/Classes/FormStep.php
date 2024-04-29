<?php

namespace App\Classes;

use Illuminate\Http\Request;

class FormStep {
    public bool $hasError = false;
    private string $slug;
    /** @var FormBlock[] */
    private array $blocks;

    /** @param FormBlock[] $blocks */
    public function __construct(string $slug, array $blocks)
    {
        $this->slug = $slug;
        $this->blocks = $blocks;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    /** @return FormBlock[] */
    public function getBlocks(): array
    {
        return $this->blocks;
    }

    public function getBlockBySlug(string $slug): FormBlock
    {
        return array_values(array_filter($this->getBlocks(), function($block) use ($slug) {
            return $slug === $block->getSlug();
        }))[0];
    }

    public function validate(Request $request): FormStep
    {
        foreach($this->getBlocks() as $block)
        {
            $block->validate($request);
            $this->hasError = $this->hasError || $block->hasError;
        }
        return $this;
    }

    public function getDisplayName(): string
    {
        // TODO translate
        return ucfirst(str_replace('-', ' ', $this->getSlug()));
    }

    public function saveInSession(): array
    {
        $blocksInfo = array_reduce($this->getBlocks(), function ($accumulator, $block) {
            return array_merge($accumulator, $block->saveInSession());
        }, []);
        return [$this->getSlug() => $blocksInfo];
    }

    public function loadFromSession(array | null $data): void
    {
        if ($data)
        {
            foreach($this->getBlocks() as $block)
            {
                $block->loadFromSession($data[$block->getSlug()] ?? null);
            }
        }
    }
}
