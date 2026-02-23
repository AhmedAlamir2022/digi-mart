@extends('admin.setting.index')

@section('setting_content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <div class="card-body">
            <h2 class="mb-1">{{ __('Author Commission Settings') }}</h2>
            <div class="text-muted mb-4">
                Define the revenue percentage that authors earn from each sale.
            </div>

            <form action="{{ route('admin.settings.commission.update') }}" method="POST" id="x-form">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <x-admin.input-text type="number" name="author_commission" :label="__('Author Commission (%)')" :value="config('settings.author_commission')"
                            min="0" max="100" step="0.1" />
                    </div>
                </div>

                <div class="alert alert-info mt-3">
                    Example: If product price is <strong>$100</strong>,
                    Author will receive <strong>
                        {{ config('settings.author_commission') }}% = <span id="preview-commission"></span>
                    </strong>
                </div>
            </form>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <x-admin.submit-button :label="__('Save')" onclick="$('#x-form').submit();" />
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    function updatePreview() {
        let commission = parseFloat(document.querySelector('[name="author_commission"]').value) || 0;
        let examplePrice = 100;
        let result = (examplePrice * commission) / 100;
        document.getElementById('preview-commission').innerText = result.toFixed(2);
    }

    document.addEventListener('DOMContentLoaded', function () {
        updatePreview();
        document.querySelector('[name="author_commission"]').addEventListener('input', updatePreview);
    });
</script>
@endpush
