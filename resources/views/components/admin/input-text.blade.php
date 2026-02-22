<div class="mb-3">
    <label class="form-label">{{ $label }}</label>

    <input
        type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        value="{{ old($name, $value ?? '') }}"
        {{ $attributes->merge([
            'class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : ''),
            'placeholder' => $placeholder ?? '',
        ]) }}
    />

    @if ($hint)
        <span class="form-hint">{{ $hint }}</span>
    @endif

</div>
