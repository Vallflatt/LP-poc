<label for="{{ $slug }}">{{ $hasError ? '(E) ' : '' }}{{ $name }}</label>
<input id="{{ $slug }}"
    name="{{ $slug }}"
    type="text"
    value="{{ $value }}">
<br>
