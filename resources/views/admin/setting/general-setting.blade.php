<div class="col-12 col-md-12 d-flex flex-column">
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('admin.settings.general.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card shadow-sm border-0">
                    <!-- Header -->
                    <div class="card-header bg-white border-bottom">
                        <h4 class="mb-0 fw-semibold">{{ __('General Settings') }}</h4>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                        <div class="row g-3">

                            <!-- Site Name -->
                            <div class="col-md-6 mb-4">
                                <label class="fw-semibold">{{ __('Site Name') }}</label>
                                <input type="text" name="site_name"
                                    value="{{ old('site_name', config('settings.site_name')) }}" class="form-control"
                                    placeholder="Enter site name" required>
                            </div>

                            <!-- Site Email -->
                            <div class="col-md-6 mb-4">
                                <label class="fw-semibold">{{ __('Site Email') }}</label>
                                <input type="email" name="site_email"
                                    value="{{ old('site_email', config('settings.site_email')) }}" class="form-control"
                                    placeholder="Enter site email" required>
                            </div>

                            <!-- Country -->
                            <div class="col-md-6 mb-4">
                                <label class="fw-semibold">{{ __('Country') }}</label>
                                <select name="country" class="form-control select2" required>
                                    <option value="">{{ __('Select Country') }}</option>
                                    @foreach (config('options.countries') as $key => $country)
                                        <option value="{{ $key }}" @selected($key == old('country', config('settings.country')))>
                                            {{ $country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Time Zone -->
                            <div class="col-md-6 mb-4">
                                <label class="fw-semibold">{{ __('Time Zone') }}</label>
                                <select name="time_zone" class="form-control select2" required>
                                    <option value="">{{ __('Select Time Zone') }}</option>
                                    @foreach (config('options.time_zones') as $key => $zone)
                                        <option value="{{ $key }}" @selected($key == old('time_zone', config('settings.time_zone')))>
                                            {{ $key }} - {{ $zone }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Default Currency -->
                            <div class="col-md-4 mb-4">
                                <label class="fw-semibold">{{ __('Default Currency') }}</label>
                                <select name="default_currency" class="form-control select2" required>
                                    <option value="">{{ __('Select Currency') }}</option>
                                    @foreach (config('options.currencies') as $key => $currency)
                                        <option value="{{ $key }}" @selected($key == old('default_currency', config('settings.default_currency')))>
                                            {{ $currency }} - {{ $key }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Currency Icon -->
                            <div class="col-md-4 mb-4">
                                <label class="fw-semibold">{{ __('Currency Icon') }}</label>
                                <input type="text" name="currency_icon"
                                    value="{{ old('currency_icon', config('settings.currency_icon')) }}"
                                    class="form-control" placeholder="$" required>
                            </div>

                            <!-- Currency Position -->
                            <div class="col-md-4 mb-4">
                                <label class="fw-semibold">{{ __('Currency Position') }}</label>
                                <select name="currency_position" class="form-control select2" required>
                                    <option value="left" @selected(old('currency_position', config('settings.currency_position')) == 'left')>
                                        {{ __('Left') }}
                                    </option>
                                    <option value="right" @selected(old('currency_position', config('settings.currency_position')) == 'right')>
                                        {{ __('Right') }}
                                    </option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-white text-end border-top">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-save me-1"></i> {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
