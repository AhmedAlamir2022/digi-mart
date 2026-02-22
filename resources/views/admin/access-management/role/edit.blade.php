@extends('admin.layouts.master')
@section('title', 'Update Role')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">{{ __('Update Role') }}</h3>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-light d-flex align-items-center gap-1">
                            <i class="ti ti-arrow-narrow-left"></i> {{ __('Back') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <x-admin.input-text name="role" :label="__('Role Name')" value="{{ $role->name }}" />
                            </div>

                            <hr class="my-4">

                            <div class="row g-3">
                                @foreach ($permissions as $groupName => $permissionItems)
                                    <div class="col-md-4">
                                        <div class="card border-light shadow-sm h-100">
                                            <div class="card-header fw-semibold">{{ $groupName }}</div>
                                            <div class="card-body p-3">
                                                @foreach ($permissionItems as $permission)
                                                    <label class="form-check d-flex align-items-center gap-2 mb-2">
                                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                                            value="{{ $permission->name }}" @checked($role->hasPermissionTo($permission->name))>
                                                        <span class="form-check-label">{{ $permission->name }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Role') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .card-header {
                font-size: 1rem;
            }

            .form-check-input:checked {
                background-color: #0d6efd;
                border-color: #0d6efd;
            }

            .card:hover {
                transform: translateY(-2px);
                transition: all 0.2s ease-in-out;
            }
        </style>
    @endpush
@endsection
