@extends('admin.layouts.master')
@section('title', 'Profile')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Profile Information</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item active">Profile</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                        <div class="card shadow-sm">
                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="card-header bg-white border-bottom">
                                    <h5 class="mb-0 fw-semibold">
                                        <i class="fas fa-user me-2"></i> Profile Information Update
                                    </h5>
                                </div>

                                <div class="card-body">
                                    <div class="row">

                                        <!-- Avatar -->
                                        <div class="col-md-12 mb-4 text-center">

                                            <label class="fw-semibold d-block mb-3">Profile Avatar</label>

                                            <div class="position-relative d-inline-block">

                                                <!-- صورة البروفايل -->
                                                <img id="avatarPreview"
                                                    src="{{ admin()->avatar ? asset(admin()->avatar) : asset('admin/assets/img/avatar/avatar-1.png') }}"
                                                    class="rounded-circle shadow" width="130" height="130"
                                                    style="object-fit: cover; border: 4px solid #f1f1f1;">

                                                <!-- زر اختيار صورة -->
                                                <label for="avatarInput" class="btn btn-sm btn-primary position-absolute"
                                                    style="bottom: 0; right: 0; border-radius: 50%;">
                                                    <i class="fas fa-camera"></i>
                                                </label>

                                            </div>

                                            <input type="file" id="avatarInput" name="avatar" class="d-none"
                                                accept="image/*">

                                        </div>

                                        <!-- Name -->
                                        <div class="col-md-6 mb-4">
                                            <label class="fw-semibold">Full Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ admin()->name }}">
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6 mb-4">
                                            <label class="fw-semibold">Email Address</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ admin()->email }}">
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer bg-white text-end border-top">
                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                        <i class="fas fa-save me-1"></i> Update Profile
                                    </button>
                                </div>

                            </form>
                        </div>
                        <div class="card shadow-sm mt-4">
                            <form action="{{ route('admin.password.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-header bg-white border-bottom">
                                    <h5 class="mb-0 fw-semibold">
                                        <i class="fas fa-lock me-2"></i> Change Password
                                    </h5>
                                </div>

                                <div class="card-body">
                                    <div class="row">

                                        <!-- Current Password -->
                                        <div class="col-md-12 mb-4">
                                            <label class="fw-semibold">Current Password</label>
                                            <div class="input-group">
                                                <input type="password" name="current_password" class="form-control">
                                            </div>
                                        </div>

                                        <!-- New Password -->
                                        <div class="col-md-6 mb-4">
                                            <label class="fw-semibold">New Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="col-md-6 mb-4">
                                            <label class="fw-semibold">Confirm New Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer bg-white text-end border-top">
                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                        <i class="fas fa-save me-1"></i> Update Password
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
