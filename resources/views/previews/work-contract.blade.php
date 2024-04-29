<div id="preview" {{isset($oob) ? "hx-swap-oob='true'" : ''}}>
    <h3>{{ $formatter->getDisplayName() }}</h3>
    <p>
        Concern: {{ $formatter->getEmployeeInformation() }}
    </p>
    <p>For a job of: {{ $formatter->getJobTitle() }}</p>
    <p>Many other stuffs</p>
</div>
