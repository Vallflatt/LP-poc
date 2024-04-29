<?php

namespace App\Classes;

use Illuminate\Http\Request;

abstract class LegalForm {
    /** @var FormStep[] */
    protected array $steps;
    protected string $currentStepSlug;
    protected string $title;
    protected string $slug;

    /** @return FormStep[] */
    public function getSteps(): array
    {
        return $this->steps;
    }

    public function getStepBySlug(string $slug): FormStep
    {
        return $this->getSteps()[$slug];
    }

    public function getCurrentStepSlug(): string
    {
        return $this->currentStepSlug;
    }

    /**
     * Load the next step in the form
     *
     * @return bool false if there is no next step
     */
    public function nextStep(): bool
    {
        $currentIndex = array_search($this->currentStepSlug, array_keys($this->steps));
        if ($currentIndex < count($this->steps) - 1)
        {
            $this->currentStepSlug = array_keys($this->steps)[$currentIndex + 1];
            return true;
        }
        return false;
    }

    public function hasPreviousStep(): bool
    {
        return array_search($this->currentStepSlug, array_keys($this->steps)) > 0;
    }

    /**
     * Load the previous step in the form
     *
     * @return bool false if there is no previous step
     */
    public function previousStep(): bool
    {
        $currentIndex = array_search($this->currentStepSlug, array_keys($this->steps));
        if ($currentIndex > 0)
        {
            $this->currentStepSlug = array_keys($this->steps)[$currentIndex - 1];
            return true;
        }
        return false;
    }

    public function getCurrentStep(): FormStep
    {
        return $this->steps[$this->currentStepSlug];
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function saveInSession(Request $request): array
    {
        $data = array_reduce($this->getSteps(), function ($accumulator, $step) {
            return array_merge($accumulator, $step->saveInSession());
        }, []);
        $request->session()->put($this->getSlug(), $data);
        return $data;
    }

    public function loadFromSession(Request $request): void
    {
        $data = $request->session()->get($this->getSlug());
        if ($data)
        {
            foreach($this->getSteps() as $step)
            {
                $step->loadFromSession($data[$step->getSlug()] ?? null);
            }
        }
    }

    public function clearSession(Request $request): void
    {
        $request->session()->forget($this->getSlug());
    }
}
