@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $form->getTitle() }}</h2>
        <div class="form-container" style="display: flex;">
            <div class="left">
                @include('helpers.form', ["form" => $form])
            </div>
            <div class="right">
                @include('pages.partials.stepper', ["form" => $form])
            </div>
        </div>
        <div>
            <h2>Preview</h2>
            <div style="padding: 3rem; border: solid 1px grey;">
                @include('previews.work-contract', ["formatter" => $formatter])
            </div>
        </div>
    </div>
@endsection
