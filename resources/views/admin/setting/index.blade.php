@extends('admin.layouts.master')
@section('title', 'Settings')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Account Settings
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-12 col-md-3 border-end">
                            <div class="card-body position-sticky" style="top: 20px;">
                                <h6 class="text-uppercase text-muted mb-3">System Configuration</h6>

                                <div class="list-group list-group-flush">
                                    <a href="{{ route('admin.settings.index') }}"
                                        class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.settings.index') ? 'active fw-bold' : '' }}">
                                        <i class="ti ti-settings me-2"></i>
                                        General Settings
                                    </a>

                                    <a href="{{ route('admin.settings.commission.index') }}"
                                        class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.settings.commission.*') ? 'active fw-bold' : '' }}">
                                        <i class="ti ti-cash me-2"></i>
                                        Author Commission
                                    </a>

                                    <a href="{{ route('admin.settings.logo.index') }}"
                                        class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.settings.logo.*') ? 'active fw-bold' : '' }}">
                                        <i class="ti ti-photo me-2"></i>
                                        Logo Settings
                                    </a>

                                    <a href="{{ route('admin.settings.smtp.index') }}"
                                        class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('admin.settings.smtp.*') ? 'active fw-bold' : '' }}">
                                        <i class="ti ti-mail me-2"></i>
                                        SMTP Settings
                                    </a>
                                </div>
                            </div>
                        </div>
                        @yield('setting_content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
