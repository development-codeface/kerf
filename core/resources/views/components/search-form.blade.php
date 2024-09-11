

@props([
    'placeholder' => 'Search...',
    'btn' => 'btn--primary',
    'dateSearch' => 'no',
    'filter' => 'no',
    'keySearch' => 'yes',
])

<form action="" method="GET" class="d-flex flex-wrap gap-2">
    @if ($filter == 'yes')
        <x-filter  btn="{{ $btn }}" />
    @endif

    @if ($keySearch == 'yes')
        <x-search-key-field placeholder="{{ $placeholder }}" btn="{{ $btn }}" />
    @endif
    @if ($dateSearch == 'yes')
        <x-search-date-field />
    @endif

</form>
