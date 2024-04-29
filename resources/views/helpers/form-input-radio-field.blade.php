<fieldset>
    <legend>{{ $hasError ? '(E) ' : '' }}{{ $name }}</legend>

    @foreach ($options as $key => $optionValue)
        <div>
            <input type="radio" id="{{ $key }}" name="{{ $slug }}" value="{{ $optionValue }}"  {{ $optionValue === $value ? 'checked' : '' }}/>
            <label for="{{ $key }}">{{ $optionValue }}</label>
        </div>
    @endforeach
  </fieldset>
  <br>
