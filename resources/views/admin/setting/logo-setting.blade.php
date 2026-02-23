@extends('admin.setting.index')

@section('setting_content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <div class="card-body">
            <h2 class="mb-1">{{ __('Logo and Favicon Settings') }}</h2>
            <div class="text-muted mb-4">
                Upload and manage your platform branding assets
            </div>

            <form action="{{ route('admin.settings.logo.update') }}" method="POST" id="x-form"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- Main Logo --}}
                    <div class="col-md-6">
                        <div class="card border shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="mb-3">{{ __('Main Logo') }}</h5>

                                <x-admin.image-preview width="180" src="{{ asset(config('settings.logo')) }}" />

                                <div class="mt-3">
                                    <x-admin.input-text type="file" name="logo" :label="__('Upload New Logo')" />
                                </div>

                                <div class="text-muted small mt-2">
                                    Recommended size: 300x80px
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Footer Logo --}}
                    <div class="col-md-6">
                        <div class="card border shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="mb-3">{{ __('Footer Logo') }}</h5>

                                <x-admin.image-preview width="180" src="{{ asset(config('settings.footer_logo')) }}" />

                                <div class="mt-3">
                                    <x-admin.input-text type="file" name="footer_logo" :label="__('Upload Footer Logo')" />
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Favicon --}}
                    <div class="col-md-6">
                        <div class="card border shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="mb-3">{{ __('Favicon') }}</h5>

                                <x-admin.image-preview width="60" src="{{ asset(config('settings.favicon')) }}" />

                                <div class="mt-3">
                                    <x-admin.input-text type="file" name="favicon" :label="__('Upload Favicon')" />
                                </div>

                                <div class="text-muted small mt-2">
                                    Recommended: 32x32px (.ico or .png)
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Breadcrumb Image --}}
                    <div class="col-md-6">
                        <div class="card border shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="mb-3">{{ __('Breadcrumb Background') }}</h5>

                                <x-admin.image-preview width="250" src="{{ asset(config('settings.breadcrumb')) }}" />

                                <div class="mt-3">
                                    <x-admin.input-text type="file" name="breadcrumb" :label="__('Upload Breadcrumb Image')" />
                                </div>
                            </div>
                        </div>
                    </div>

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
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const file = this.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    input.closest('.card-body')
                        .querySelector('img')
                        .src = e.target.result;
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
@endpush
