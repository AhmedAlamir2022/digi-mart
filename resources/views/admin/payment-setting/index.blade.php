@extends('admin.layouts.master')

@section('title', 'Payment Settings')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Payment Settings
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="row g-0">

                        <!-- Sidebar -->
                        <div class="col-12 col-md-3 border-end">
                            <div class="card-body position-sticky" style="top:20px;">
                                <h6 class="text-uppercase text-muted mb-3">
                                    Payment Gateways
                                </h6>

                                <div class="list-group list-group-flush">

                                    <a href="{{ route('admin.payment-settings.index') }}"
                                        class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('payment-settings.*') && !request()->routeIs('stripe-settings.*') && !request()->routeIs('razorpay-settings.*') ? 'active fw-bold' : '' }}">
                                        <i class="ti ti-brand-paypal me-2 text-primary"></i>
                                        PayPal
                                    </a>

                                    <a href="{{ route('admin.stripe-settings.index') }}"
                                        class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('stripe-settings.*') ? 'active fw-bold' : '' }}">
                                        <i class="ti ti-credit-card me-2 text-info"></i>
                                        Stripe
                                    </a>

                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="col-12 col-md-9">
                            <div class="card-body">
                                @yield('setting_content')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
