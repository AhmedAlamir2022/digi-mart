<div class="col-12 col-md-12 d-flex flex-column">
    <div class="card shadow-sm border-0">
        <form action="{{ route('admin.settings.logo.update') }}" method="POST" id="logo-settings-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card shadow-sm border-0">
                <!-- Header -->
                <div class="card-header bg-white border-bottom">
                    <h4 class="mb-0 fw-semibold">{{ __('Logo and Favicon Settings') }}</h4>
                </div>

                <!-- Body -->
                <div class="card-body">
                    <div class="row g-3">

                        <!-- Main Logo -->
                        <div class="col-md-12 mb-4">
                            <label class="fw-semibold">{{ __('Logo') }}</label>
                            <div class="mb-2">
                                <img id="logoPreview" src="{{ asset(config('settings.logo')) }}" width="200" class="img-thumbnail" alt="Logo Preview">
                            </div>
                            <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror" onchange="previewImage(this, 'logoPreview')">
                            @error('logo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <!-- Footer Logo -->
                        <div class="col-md-12 mb-4">
                            <label class="fw-semibold">{{ __('Footer Logo') }}</label>
                            <div class="mb-2">
                                <img id="footerLogoPreview" src="{{ asset(config('settings.footer_logo')) }}" width="200" class="img-thumbnail" alt="Footer Logo Preview">
                            </div>
                            <input type="file" name="footer_logo" id="footer_logo" class="form-control @error('footer_logo') is-invalid @enderror" onchange="previewImage(this, 'footerLogoPreview')">
                            @error('footer_logo')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <!-- Favicon -->
                        <div class="col-md-12 mb-4">
                            <label class="fw-semibold">{{ __('Favicon') }}</label>
                            <div class="mb-2">
                                <img id="faviconPreview" src="{{ asset(config('settings.favicon')) }}" width="80" class="img-thumbnail" alt="Favicon Preview">
                            </div>
                            <input type="file" name="favicon" id="favicon" class="form-control @error('favicon') is-invalid @enderror" onchange="previewImage(this, 'faviconPreview')">
                            @error('favicon')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <!-- Breadcrumb -->
                        <div class="col-md-12 mb-4">
                            <label class="fw-semibold">{{ __('Breadcrumb') }}</label>
                            <div class="mb-2">
                                <img id="breadcrumbPreview" src="{{ asset(config('settings.breadcrumb')) }}" width="300" class="img-thumbnail" alt="Breadcrumb Preview">
                            </div>
                            <input type="file" name="breadcrumb" id="breadcrumb" class="form-control @error('breadcrumb') is-invalid @enderror" onchange="previewImage(this, 'breadcrumbPreview')">
                            @error('breadcrumb')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer bg-white text-end border-top">
                    <button type="submit" form="logo-settings-form" class="btn btn-primary px-4 py-2">
                        <i class="fas fa-save me-1"></i> {{ __('Save') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JS preview function -->
@push('scripts')
<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
