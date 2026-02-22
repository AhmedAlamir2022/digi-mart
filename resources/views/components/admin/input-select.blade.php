<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <select name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control form-select']) }}>
        <option value="">{{ __('Select') }}</option>
        {{ $slot }}
    </select>
    <x-input-error :message="$errors->first(str_replace('[]', '', $name))" />
</div>
