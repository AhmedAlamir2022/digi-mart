<div class="col-12 col-md-12 d-flex flex-column">
    <div class="card shadow-sm border-0">
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('admin.settings.commission.update') }}" method="POST" id="commission-form">
                @csrf
                @method('PUT')

                <div class="card shadow-sm border-0">
                    <!-- Header -->
                    <div class="card-header bg-white border-bottom">
                        <h4 class="mb-0 fw-semibold">{{ __('Author Commission Settings') }}</h4>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- Author Commission Input -->
                            <div class="col-md-12 mb-4">
                                <label for="author_commission" class="fw-semibold">{{ __('Author Commission (%)') }}</label>
                                <input type="text" name="author_commission" id="author_commission"
                                       value="{{ old('author_commission', config('settings.author_commission')) }}"
                                       class="form-control @error('author_commission') is-invalid @enderror"
                                       placeholder="Enter author commission" required>
                                @error('author_commission')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-white text-end border-top">
                        <button type="submit" form="commission-form" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-save me-1"></i> {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
