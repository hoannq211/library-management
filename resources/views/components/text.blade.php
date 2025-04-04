@if ($type == 'title')
    <text class="alert alert-{{ $background }}">
        <h1>{{ $slot }}</h1>
    </text>
@else
    <text class="alert alert-{{ $background }}">
        {{ $slot }}
    </text>
@endif