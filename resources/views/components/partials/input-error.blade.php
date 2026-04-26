@error($field)
<div
    {{ $attributes->merge(['class' => 'text-sm font-semibold text-left mt-3 text-red-400']) }}
    >
    {{ $message }}
</div>
@enderror