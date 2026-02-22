<div class="form_box">
    <label for="{{ $name }}"
        class="form-label mb-2 font-18 font-heading fw-600">{{ $label }} @if($required) <code>*</code> @endif</label>
    <input type="{{ $type == null ? 'text' : $type }}" {{ $attributes->merge(['class' => 'common-input border']) }}
        value="{{ $value }}" placeholder="{{ $placeholder }}" name="{{ $name }}">
    <x-input-error :message="$errors->first($name)" />
</div>
