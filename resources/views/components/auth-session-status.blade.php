@props(['status'])

@if ($status)
    <div
        {{ $attributes->merge(['class' => 'bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm font-medium']) }}>
        {{ $status }}
    </div>
@endif
