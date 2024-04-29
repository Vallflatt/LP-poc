<ul id="stepper" {{isset($oob) ? "hx-swap-oob='true'" : ''}}>
    @foreach ($form->getSteps() as $slug => $step)
        <li>{{ $step->getDisplayName() }}{{ $slug === $form->getCurrentStepSlug() ? ' <<<' : ''}}</li>
    @endforeach
</ul>
