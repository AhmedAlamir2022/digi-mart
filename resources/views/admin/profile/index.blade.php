@extends('admin.layouts.master')
@section('title', 'Profile')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <form class="card shadow-sm border-0 rounded-4" action="{{ route('admin.profile.update') }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="card-body p-5">

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h3 class="card-title mb-0 fw-bold">{{ __('Edit Profile') }}</h3>
                        </div>

                        <div class="text-center mb-4">

                            <div class="position-relative d-inline-block">
                                <img src="{{ asset(auth('admin')->user()->avatar) }}" class="rounded-circle shadow"
                                    style="width:130px;height:130px;object-fit:cover;border:4px solid #fff;">

                                <span
                                    class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 shadow-sm">
                                    <i class="ti ti-camera"></i>
                                </span>
                            </div>

                        </div>

                        <div class="row g-4">

                            <div class="col-md-12">
                                <x-admin.input-text type="file" name="avatar" :label="__('Change Avatar')" />
                            </div>

                            <div class="col-md-6">
                                <x-admin.input-text name="name" :label="__('Name')" :value="auth('admin')->user()->name" />
                            </div>

                            <div class="col-md-6">
                                <x-admin.input-text name="email" :label="__('Email')" :value="auth('admin')->user()->email" />
                            </div>

                        </div>

                    </div>

                    <div class="card-footer border-0 text-end p-4">
                        <button type="submit" class="btn btn-primary px-4">
                            {{ __('Update Profile') }}
                        </button>
                    </div>
                </form>

                <form class="card mt-4 shadow-sm border-0 rounded-4" action="{{ route('admin.password.update') }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <div class="card-body p-5">

                        <h3 class="card-title fw-bold mb-4">
                            {{ __('Update Password') }}
                        </h3>

                        <div class="row g-4">

                            <div class="col-md-12">
                                <x-admin.input-text type="password" name="current_password" :label="__('Current Password')"
                                    :placeholder="__('Your current password')" />
                            </div>

                            <div class="col-md-6">
                                <x-admin.input-text type="password" name="password" :label="__('New Password')" :placeholder="__('Your new password')" />
                            </div>

                            <div class="col-md-6">
                                <x-admin.input-text type="password" name="password_confirmation" :label="__('Confirm Password')"
                                    :placeholder="__('Confirm your new password')" />
                            </div>

                        </div>

                    </div>

                    <div class="card-footer border-0 text-end p-4">
                        <button type="submit" class="btn btn-primary px-4">
                            {{ __('Update Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
