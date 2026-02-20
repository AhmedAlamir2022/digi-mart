@extends('admin.layouts.master')
@section('title', 'Create Role')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create Role</h1>
                

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
                    <div class="breadcrumb-item active">Create Role</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ route('admin.roles.store') }}" method="POST">
                                @csrf
                                <div class="card-header">
                                    <h4>Create new role</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Role Name</label>
                                        <input type="text" class="form-control" name="role" required="">
                                    </div>
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
                                                                    value="{{ $permission->name }}" name="permissions[]">
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
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
