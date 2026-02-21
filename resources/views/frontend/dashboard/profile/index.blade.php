@extends('frontend.dashboard.layouts.master')
@section('title', 'Profile')
@section('content')
    <div class="profile">
        <div class="row gy-4">
            <div class="col-xxl-3 col-xl-4">
                <div class="profile-info">
                    <div class="profile-card card border-0 shadow-sm rounded-4 overflow-hidden">

                        <!-- Header -->
                        <div class="profile-header text-center p-4 position-relative">

                            <div class="profile-avatar-wrapper mb-3">
                                <img src="{{ $user->avatar ? asset($user->avatar) : asset('default-avatar.png') }}"
                                    class="profile-avatar rounded-circle shadow" alt="Avatar">
                            </div>

                            <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                            <span class="badge bg-light text-dark px-3 py-2">
                                {{ ucfirst($user->user_type) }}
                            </span>
                        </div>

                        <!-- Info List -->
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush profile-info-list">

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="d-flex align-items-center gap-2">
                                        <i class="ti ti-user text-primary"></i>
                                        <span class="fw-semibold">{{ __('Name') }}</span>
                                    </span>
                                    <span class="text-muted">{{ $user->name }}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="d-flex align-items-center gap-2">
                                        <i class="ti ti-mail-forward text-primary"></i>
                                        <span class="fw-semibold">{{ __('Email') }}</span>
                                    </span>
                                    <span class="text-muted">{{ $user->email }}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="d-flex align-items-center gap-2">
                                        <i class="ti ti-map-pin text-primary"></i>
                                        <span class="fw-semibold">{{ __('Country') }}</span>
                                    </span>
                                    <span class="text-muted">{{ $user->country ?? '-' }}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="d-flex align-items-center gap-2">
                                        <i class="ti ti-currency-dollar text-success"></i>
                                        <span class="fw-semibold">{{ __('Balance') }}</span>
                                    </span>
                                    <span class="fw-bold text-success">$0.00 USD</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="d-flex align-items-center gap-2">
                                        <i class="ti ti-basket-check text-warning"></i>
                                        <span class="fw-semibold">{{ __('Purchased') }}</span>
                                    </span>
                                    <span class="fw-bold">0 {{ __('items') }}</span>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xxl-9 col-xl-8">
                <div class="dashboard-card">
                    <div class="dashboard-card__header pb-0">
                        <ul class="nav tab-bordered nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link font-18 font-heading active" id="pills-personalInfo-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-personalInfo" type="button" role="tab"
                                    aria-controls="pills-personalInfo"
                                    aria-selected="true">{{ __('Personal Info') }}</button>
                            </li>
                            @if (isAuthor())
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link font-18 font-heading" id="pills-payouts-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-payouts" type="button" role="tab"
                                        aria-controls="pills-payouts" aria-selected="false"
                                        tabindex="-1">{{ __('Payouts') }}</button>
                                </li>
                            @endif
                            <li class="nav-item" role="presentation">
                                <button class="nav-link font-18 font-heading" id="pills-changePassword-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-changePassword" type="button"
                                    role="tab" aria-controls="pills-changePassword" aria-selected="false"
                                    tabindex="-1">{{ __('Change Password') }}</button>
                            </li>
                        </ul>
                    </div>

                    <div class="profile-info-content">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-personalInfo" role="tabpanel"
                                aria-labelledby="pills-personalInfo-tab" tabindex="0">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                                    autocomplete="off">

                                    @csrf
                                    @method('PUT')

                                    <div class="card shadow-sm border-0">
                                        <div class="card-body p-4">

                                            <div class="row g-4">

                                                <!-- Avatar Section -->
                                                <div class="col-12 text-center">
                                                    <div class="position-relative d-inline-block">

                                                        <!-- Preview Image -->
                                                        <img id="avatarPreview"
                                                            src="{{ $user->avatar ? asset($user->avatar) : asset('default-avatar.png') }}"
                                                            class="rounded-circle border shadow-sm"
                                                            style="width:140px;height:140px;object-fit:cover;cursor:pointer;">

                                                        <!-- Hidden File Input -->
                                                        <input type="file" name="avatar" id="avatar" class="d-none"
                                                            accept="image/*">

                                                        <!-- Upload Button -->
                                                        <div class="mt-3">
                                                            <label for="avatar" class="btn btn-outline-primary btn-sm">
                                                                <i class="fas fa-camera me-1"></i> Change Avatar
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Full Name -->
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold">Full Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ old('name', $user->name) }}">
                                                    @error('name')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Email -->
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold">Email Address</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ old('email', $user->email) }}">
                                                    @error('email')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Country -->
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold">{{ __('Country') }}</label>
                                                    <select name="country" class="form-select select_2" required>
                                                        <option value="">{{ __('Select') }}</option>
                                                        @foreach (config('options.countries') as $value)
                                                            <option value="{{ $value }}"
                                                                {{ old('country', $user->country) == $value ? 'selected' : '' }}>
                                                                {{ $value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- City -->
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold">City</label>
                                                    <input type="text" name="city" class="form-control"
                                                        value="{{ old('city', $user->city) }}">
                                                </div>

                                                <!-- Address -->
                                                <div class="col-12">
                                                    <label class="form-label fw-semibold">Address</label>
                                                    <input type="text" name="address" class="form-control"
                                                        value="{{ old('address', $user->address) }}">
                                                </div>

                                                <!-- Submit -->
                                                <div class="col-12 text-end mt-3">
                                                    <button class="btn btn-primary px-4 py-2">
                                                        <i class="fas fa-save me-1"></i>
                                                        {{ __('Update Profile') }}
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- <div class="tab-pane fade" id="pills-payouts" role="tabpanel"
                                aria-labelledby="pills-payouts-tab" tabindex="0">
                                <form action="{{ route('withdraw.info') }}" autocomplete="off" method="POST">
                                    @csrf
                                    <div class="row">
                                        <x-frontend.input-select name="payout_method" :label="__('Payout Method')"
                                            class="select_2 withdraw-method">
                                            @foreach ($withdrawMethods as $method)
                                                <option @selected($user?->withdrawInfo?->withdraw_method_id == $method->id) value="{{ $method->id }}">
                                                    {{ $method->name }}</option>
                                            @endforeach
                                        </x-frontend.input-select>
                                        <div>
                                            @foreach ($withdrawMethods as $method)
                                                <div
                                                    class="method-{{ $method->id }} {{ $user?->withdrawInfo?->withdraw_method_id == $method->id ? '' : 'd-none' }} alert alert-info">
                                                    {!! nl2br($method->description) !!}</div>
                                            @endforeach
                                        </div>
                                        <x-frontend.text-area name="information" :label="__('Information')" :value="$user?->withdrawInfo?->information" />
                                        <div class="col-sm-12">
                                            <button class="btn btn-main btn-lg"> {{ __('Update Payout') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}
                            <div class="tab-pane fade" id="pills-changePassword" role="tabpanel"
                                aria-labelledby="pills-changePassword-tab">
                                <form action="{{ route('password.update') }}" method="POST" autocomplete="off">
                                    @csrf
                                    @method('PUT')

                                    <div class="card shadow-sm border-0 rounded-4">
                                        <div class="card-body p-4">

                                            <div class="row g-4">

                                                <!-- Current Password -->
                                                <div class="col-12">
                                                    <label for="current_password"
                                                        class="form-label fw-semibold">{{ __('Current Password') }}</label>
                                                    <input type="password" name="current_password" id="current_password"
                                                        placeholder="********"
                                                        class="form-control @error('current_password') is-invalid @enderror">
                                                </div>

                                                <!-- New Password -->
                                                <div class="col-md-6">
                                                    <label for="password"
                                                        class="form-label fw-semibold">{{ __('New Password') }}</label>
                                                    <input type="password" name="password" id="password"
                                                        placeholder="********"
                                                        class="form-control @error('password') is-invalid @enderror">
                                                </div>

                                                <!-- Confirm Password -->
                                                <div class="col-md-6">
                                                    <label for="password_confirmation"
                                                        class="form-label fw-semibold">{{ __('Confirm Password') }}</label>
                                                    <input type="password" name="password_confirmation"
                                                        id="password_confirmation" placeholder="********"
                                                        class="form-control">
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="col-12 text-end mt-3">
                                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                                        <i class="fas fa-save me-1"></i> {{ __('Update Password') }}
                                                    </button>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.withdraw-method').on('change', function() {
                var methodId = $(this).val();
                $('.method-' + methodId).removeClass('d-none');
                $('.method-' + methodId).siblings().addClass('d-none');
            })
        })
    </script>
@endpush
