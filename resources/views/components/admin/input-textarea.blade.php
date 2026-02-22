<div class="mb-3 mb-0">
    <label class="form-label">{{ $label }}</label>
    <textarea rows="5" name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }} placeholder="{{ $placeholder }}" value="Mike">{{ $value }}</textarea>
    <x-input-error :message="$errors->first($name)" />
</div>
