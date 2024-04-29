<form id="{{ $form->getCurrentStepSlug()}}"
    class="{{ $class ?? '' }}"
    hx-post="{{ route('form.work-contract-step', ['slug' => $form->getCurrentStepSlug()]) }}"
    hx-swap="outerHTML transition:true"
    hx-indicator="#spinner"
    hx-disabled-elt="input">
    @csrf
    @foreach ($form->getCurrentStep()->getBlocks() as $block)
        @include('helpers.form-block', ["block" => $block])
    @endforeach
    @if ($form->hasPreviousStep())
        <button hx-get="{{ route('form.work-contract-previous-step', ['slug' => $form->getCurrentStepSlug()]) }}"
            hx-target="#{{ $form->getCurrentStepSlug()}}"
            hx-swap="outerHTML transition:true"
            hx-indicator="#spinner"
            hx-disabled-elt="input">
            Previous
        </button>
    @endif
    <input type="submit" value="Next">
    <div id="spinner" class="htmx-indicator">Loading spinner...</div>
</form>
