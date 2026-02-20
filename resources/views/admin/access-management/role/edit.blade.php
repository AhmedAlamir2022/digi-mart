@extends('admin.layouts.master')
@section('title', 'Edit Role')

@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-header">
                <h1>Edit Role</h1>

                <div class="ml-auto">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">Access Management</div>
                    <div class="breadcrumb-item active">Edit Role</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-header">
                                    <h4>Edit Role: {{ ucfirst($role->name) }}</h4>
                                </div>

                                <div class="card-body">

                                    {{-- Role Name --}}
                                    <div class="form-group">
                                        <label>Role Name</label>
                                        <input type="text" class="form-control" name="role"
                                            value="{{ old('role', $role->name) }}" required>
                                    </div>

                                    {{-- Permissions --}}
                                    <div class="row">

                                        @foreach ($permissions as $groupName => $permissionItems)
                                            <div class="col-md-4 mb-4">
                                                <div class="card shadow-sm h-100">

                                                    <div class="card-header bg-primary text-white py-2">
                                                        <h6 class="mb-0 text-capitalize">
                                                            <i class="fas fa-layer-group mr-1"></i>
                                                            {{ $groupName }}
                                                        </h6>
                                                    </div>

                                                    <div class="card-body p-3" style="max-height: 250px; overflow-y: auto;">

                                                        @foreach ($permissionItems as $permission)
                                                            <div class="custom-control custom-checkbox mb-2">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="perm_{{ $permission->id }}"
                                                                    value="{{ $permission->name }}" name="permissions[]"
                                                                    {{-- Check if role already has permission --}} @checked(in_array($permission->name, old('permissions', $role->permissions->pluck('name')->toArray())))>

                                                                <label class="custom-control-label text-capitalize"
                                                                    for="perm_{{ $permission->id }}">
                                                                    {{ str_replace('-', ' ', $permission->name) }}
                                                                </label>
                                                            </div>
                                                        @endforeach

                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-1"></i> Update Role
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
