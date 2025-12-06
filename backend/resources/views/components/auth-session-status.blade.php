@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'form-status-message']) }}>
        {{ $status }}
    </div>
@endif
