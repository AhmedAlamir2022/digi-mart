@extends('admin.layouts.master')
@section('title', 'Settings')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Settings</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active">Settings</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Tabs Nav -->
                                    <div class="col-md-3">
                                        <ul class="nav nav-pills flex-column" id="settings_tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="general-settings-tab" data-toggle="tab"
                                                    href="#general-settings" role="tab" aria-controls="general-settings"
                                                    aria-selected="true">General Settings</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="commission-settings-tab" data-toggle="tab"
                                                    href="#commission-settings" role="tab"
                                                    aria-controls="commission-settings" aria-selected="false">Commission
                                                    Settings</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="logo-settings-tab" data-toggle="tab"
                                                    href="#logo-settings" role="tab" aria-controls="logo-settings"
                                                    aria-selected="false">Logo Settings</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="smtp-settings-tab" data-toggle="tab"
                                                    href="#smtp-settings" role="tab" aria-controls="smtp-settings"
                                                    aria-selected="false">SMTP Settings</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Tabs Content -->
                                    <div class="col-md-9">
                                        <div class="tab-content" id="settings_tabContent">
                                            <div class="tab-pane fade show active" id="general-settings" role="tabpanel"
                                                aria-labelledby="general-settings-tab">
                                                @include('admin.setting.general-setting')
                                            </div>

                                            <div class="tab-pane fade" id="commission-settings" role="tabpanel"
                                                aria-labelledby="commission-settings-tab">
                                                @include('admin.setting.commission-setting')
                                            </div>

                                            <div class="tab-pane fade" id="logo-settings" role="tabpanel"
                                                aria-labelledby="logo-settings-tab">
                                                @include('admin.setting.logo-setting')
                                            </div>

                                            <div class="tab-pane fade" id="smtp-settings" role="tabpanel"
                                                aria-labelledby="smtp-settings-tab">
                                                @include('admin.setting.smtp-setting')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
