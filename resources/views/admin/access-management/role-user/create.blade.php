@extends('admin.layouts.master')
@section('title', 'Create User')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">

                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">{{ __('Create User') }}</h2>
                    <a href="{{ route('admin.role-users.index') }}"
                        class="btn btn-outline-primary d-flex align-items-center gap-1">
                        <i class="ti ti-arrow-narrow-left"></i> {{ __('Back') }}
                    </a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('admin.role-users.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <x-admin.input-text name="name" :label="__('Name')" placeholder="John Doe" />
                                </div>

                                <div class="col-md-6">
                                    <x-admin.input-text name="email" :label="__('Email')" placeholder="user@example.com" />
                                </div>

                                <div class="col-md-6">
                                    <x-admin.input-text type="password" name="password" :label="__('Password')"
                                        placeholder="********" />
                                </div>

                                <div class="col-md-6">
                                    <x-admin.input-text type="password" name="password_confirmation" :label="__('Confirm Password')"
                                        placeholder="********" />
                                </div>

                                <div class="col-md-12">
                                    <x-admin.input-select name="role" :label="__('Role')" class="form-select">
                                        <option value="" disabled selected>{{ __('Select Role') }}</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </x-admin.input-select>
                                </div>

                            </div>
                            <div class="mt-4 text-end">
                                <x-admin.submit-button :label="__('Create')" onclick="$('form').submit();"
                                    class="btn btn-primary" />
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .card-body form .row.g-3>div {
                transition: transform 0.2s ease;
            }

            .card-body form .row.g-3>div:hover {
                transform: translateY(-2px);
            }

            .form-select {
                height: 45px;
                padding: 0.4rem 0.75rem;
            }

            .card-header h3.card-title {
                font-weight: 600;
                font-size: 1.25rem;
            }

            .btn-outline-primary {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }
        </style>
    @endpush
@endsection
