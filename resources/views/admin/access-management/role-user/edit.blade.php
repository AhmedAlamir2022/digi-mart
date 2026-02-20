@extends('admin.layouts.master')
@section('title', 'Edit Role User')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Role User</h1>

                <div class="ml-auto">
                    <a href="{{ route('admin.role-users.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">Access Management</div>
                    <div class="breadcrumb-item active">Edit Role User</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                        <div class="card shadow-sm">
                            <form action="{{ route('admin.role-users.update', $admin->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-header bg-white border-bottom">
                                    <h4 class="mb-0 fw-semibold">
                                        Edit Admin: {{ ucfirst($admin->name) }}
                                    </h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">

                                        <!-- Name -->
                                        <div class="col-md-6 mb-4">
                                            <label class="fw-semibold">Full Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name', $admin->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6 mb-4">
                                            <label class="fw-semibold">Email Address</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email', $admin->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Password -->
                                        <div class="col-md-6 mb-4">
                                            <label class="fw-semibold">
                                                Password
                                                <small class="text-muted">(Leave blank if not changing)</small>
                                            </label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                placeholder="Enter new password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="col-md-6 mb-4">
                                            <label class="fw-semibold">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                placeholder="Confirm new password">
                                        </div>

                                        <!-- Role -->
                                        <div class="col-md-12 mb-4">
                                            <label class="fw-semibold">Assign Role</label>
                                            <select name="role"
                                                class="form-control select2 @error('role') is-invalid @enderror">

                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}"
                                                        {{ $admin->roles->first()?->name == $role->name ? 'selected' : '' }}>
                                                        {{ ucfirst($role->name) }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('role')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer bg-white text-end border-top">
                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                        <i class="fas fa-save me-1"></i> Update Admin
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
