@extends('frontend.dashboard.layouts.master')
@section('title', 'Profile')
@push('styles')
@endpush
@section('content')
    <div class="profile container-xl py-5">

        <div class="row gy-4">

            <!-- Sidebar / Profile Info -->
            <div class="col-xxl-3 col-xl-4">
                <div class="profile-info card shadow-sm p-4 text-center">

                    <!-- Avatar -->
                    <div class="avatar-upload mb-3 position-relative">
                        <div class="avatar-preview rounded-circle mx-auto mb-3"
                            style="background-image: url('{{ asset($user->avatar) }}'); width: 130px; height: 130px; background-size: cover; background-position: center; border: 4px solid #fff; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
                            <label for="avatarInput" class="avatar-edit position-absolute"
                                style="bottom:0; right:0; cursor:pointer; background:#007bff; color:#fff; width:36px; height:36px; display:flex; justify-content:center; align-items:center; border-radius:50%;">
                                <i class="ti ti-camera"></i>
                            </label>
                        </div>
                        <input type="file" id="avatarInput" name="avatar" class="d-none">
                    </div>

                    <!-- Name & Type -->
                    <h5 class="profile-info__name mb-0">{{ $user->name }}</h5>
                    <small class="text-muted">{{ $user->user_type }}</small>

                    <!-- Profile List -->
                    <ul class="profile-info-list list-unstyled mt-4 text-start">
                        <li class="d-flex justify-content-between align-items-center mb-2">
                            <span><i class="ti ti-user me-2"></i> {{ __('Name') }}</span>
                            <strong>{{ $user->name }}</strong>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-2">
                            <span><i class="ti ti-mail-forward me-2"></i> {{ __('Email') }}</span>
                            <strong>{{ $user->email }}</strong>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-2">
                            <span><i class="ti ti-map-pin me-2"></i> {{ __('Country') }}</span>
                            <strong>{{ $user->country ?? '-' }}</strong>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-2">
                            <span><i class="ti ti-currency-dollar me-2"></i> {{ __('Balance') }}</span>
                            <strong>$0.00 USD</strong>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                            <span><i class="ti ti-basket-check me-2"></i> {{ __('Purchased') }}</span>
                            <strong>0 {{ __('items') }}</strong>
                        </li>
                    </ul>

                </div>
            </div>

            <!-- Main Content / Tabs -->
            <div class="col-xxl-9 col-xl-8">
                <div class="dashboard-card card shadow-sm p-4">

                    <!-- Tabs -->
                    <ul class="nav nav-pills nav-pills-bordered mb-4" id="profileTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="personal-tab" data-bs-toggle="pill"
                                data-bs-target="#personal" type="button" role="tab">{{ __('Personal Info') }}</button>
                        </li>
                        @if (isAuthor())
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="payout-tab" data-bs-toggle="pill" data-bs-target="#payouts"
                                    type="button" role="tab">{{ __('Payouts') }}</button>
                            </li>
                        @endif
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="password-tab" data-bs-toggle="pill" data-bs-target="#password"
                                type="button" role="tab">{{ __('Change Password') }}</button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="profileTabsContent">

                        <!-- Personal Info -->
                        <div class="tab-pane fade show active" id="personal" role="tabpanel">
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <x-frontend.input-text type="file" name="avatar" :label="__('Avatar')" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-frontend.input-text name="name" :label="__('Name')" :value="$user->name" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-frontend.input-text name="email" :label="__('Email')" :value="$user->email" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-frontend.input-select name="country" :label="__('Country')" class="select_2">
                                            @foreach (config('options.countries') as $key => $value)
                                                <option @selected($user->country == $value) value="{{ $value }}">
                                                    {{ $value }}</option>
                                            @endforeach
                                        </x-frontend.input-select>
                                    </div>
                                    <div class="col-md-6">
                                        <x-frontend.input-text name="city" :label="__('City')" :value="$user->city" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-frontend.input-text name="address" :label="__('Address')" :value="$user->address" />
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary btn-lg w-100">{{ __('Update Profile') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Payouts (Author Only) -->
                        <div class="tab-pane fade" id="payouts" role="tabpanel">
                            <p class="text-muted">Payouts section coming soon...</p>
                        </div>

                        <!-- Change Password -->
                        <div class="tab-pane fade" id="password" role="tabpanel">
                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf @method('PUT')
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <x-frontend.input-text type="password" name="current_password" :label="__('Current Password')" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-frontend.input-text type="password" name="password" :label="__('New Password')" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-frontend.input-text type="password" name="password_confirmation"
                                            :label="__('Confirm Password')" />
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-lg w-100">{{ __('Update Password') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
