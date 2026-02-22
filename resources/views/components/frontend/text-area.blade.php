<div class="form_box">
    <label for="{{ $name }}"
        class="form-label mb-2 font-18 font-heading fw-600">{{ $label }} @if($required) <code>*</code> @endif</label>

    <textarea name="{{ $name }}" {{ $attributes->merge(['class' => 'common-input border']) }} placeholder="{{ $placeholder }}" >{!! $value !!}</textarea>
    <x-input-error :message="$errors->first($name)" />
</div>
