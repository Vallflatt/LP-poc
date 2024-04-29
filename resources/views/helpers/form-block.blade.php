<div class="form-block">
    <h4>{{ $block->getDisplayName() }}</h4>
    @foreach ($block->getFields() as $field)
        {!! $field->render() !!}
    @endforeach
    @if($block->hasError)
        <div class="error">{{ $block->getErrorMessage() }}</div>
    @endif
</div>
