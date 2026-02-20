@extends('admin.layouts.master')
@section('title', 'Create Role User')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Create Role User</h1>

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
                    <div class="breadcrumb-item active">Create Role User</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card shadow-sm">
                                <form action="{{ route('admin.role-users.store') }}" method="POST">
                                    @csrf

                                    <div class="card-header bg-white border-bottom">
                                        <h4 class="mb-0 fw-semibold">Create New Admin</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                            <!-- Name -->
                                            <div class="col-md-6 mb-4">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter full name" required>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6 mb-4">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Enter email address" required>
                                            </div>

                                            <!-- Password -->
                                            <div class="col-md-6 mb-4">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Enter password" required>
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="col-md-6 mb-4">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control"
                                                    name="password_confirmation" placeholder="Confirm password" required>
                                            </div>

                                            <!-- Role -->
                                            <div class="col-md-12 mb-4">
                                                <label>Assign Role</label>
                                                <select name="role" class="form-control select2">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}">
                                                            {{ ucfirst($role->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-footer bg-white text-end border-top">
                                        <button type="submit" class="btn btn-primary px-4 py-2">
                                            <i class="fas fa-user-plus me-1"></i> Create Admin
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
