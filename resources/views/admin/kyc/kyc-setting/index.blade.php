@extends('admin.layouts.master')
@section('title', __('KYC Settings'))
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('KYC Settings') }}</h3>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.kyc-settings.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                {{-- Verification Methods --}}
                                <div class="mb-4">
                                    <h4 class="text-primary mb-3">{{ __('Verification Methods') }}</h4>
                                    <div class="text-muted mb-3">
                                        Select which identity documents users can submit for verification.
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <x-admin.input-toggle name="nid_verification" label="National ID Verification"
                                                :checked="$kycSetting?->nid_verification ?? false" />
                                        </div>

                                        <div class="col-md-4">
                                            <x-admin.input-toggle name="passport_verification" label="Passport Verification"
                                                :checked="$kycSetting?->passport_verification ?? false" />
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                {{-- Review Process --}}
                                <div class="mb-4">
                                    <h4 class="text-primary mb-3">{{ __('Review Process') }}</h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <x-admin.input-select name="auto_approve" label="Auto Approve Requests">
                                                <option @selected($kycSetting?->auto_approve == 0) value="0">
                                                    Manual Review (Recommended)
                                                </option>
                                                <option @selected($kycSetting?->auto_approve == 1) value="1">
                                                    Automatically Approve
                                                </option>
                                            </x-admin.input-select>

                                            @if ($kycSetting?->auto_approve == 1)
                                                <div class="alert alert-warning mt-2">
                                                    Enabling auto approval may reduce verification security.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                {{-- User Instructions --}}
                                <div class="mb-4">
                                    <h4 class="text-primary mb-3">{{ __('User Instructions') }}</h4>

                                    <x-admin.input-textarea name="instructions" label="Verification Instructions"
                                        :value="$kycSetting?->instructions" />

                                    <div class="text-muted small mt-2">
                                        These instructions will be shown to users before submitting KYC documents.
                                    </div>
                                </div>

                                <hr>

                                {{-- System Status --}}
                                <div class="mb-4">
                                    <h4 class="text-primary mb-3">{{ __('System Status') }}</h4>

                                    <div class="col-md-6">
                                        <x-admin.input-select name="status" label="KYC Module Status">
                                            <option @selected($kycSetting?->status == 1) value="1">Active</option>
                                            <option @selected($kycSetting?->status == 0) value="0">Inactive</option>
                                        </x-admin.input-select>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-end">
                                <x-admin.submit-button :label="__('Save')" onclick="$('form').submit();" />
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
