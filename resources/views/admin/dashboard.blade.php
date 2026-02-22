@extends('admin.layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Dashboard
                        </h2>
                    </div>

                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="row row-cards">
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <i class="ti ti-currency-dollar"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{-- <b>{{ config('settings.currency_icon') }} {{ $sales['day'] }}</b> --}}
                                                </div>
                                                <div class="text-secondary">
                                                    Today's Sales
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <i class="ti ti-currency-dollar"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{-- <b>{{ config('settings.currency_icon') }} {{ $sales['week'] }}</b> --}}
                                                </div>
                                                <div class="text-secondary">
                                                    This Week Sales
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <i class="ti ti-currency-dollar"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{-- <b>{{ config('settings.currency_icon') }} {{ $sales['month'] }}</b> --}}
                                                </div>
                                                <div class="text-secondary">
                                                    This Month Sales
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <i class="ti ti-currency-dollar"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{-- <b>{{ config('settings.currency_icon') }} {{ $sales['year'] }}</b> --}}
                                                </div>
                                                <div class="text-secondary">
                                                    This Year Sales
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <i class="ti ti-clock-record"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{-- <b>{{ $statusCount['pending'] ?? 0 }}</b> --}}
                                                </div>
                                                <div class="text-secondary">
                                                    Pending Items
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <i class="ti ti-circle-dashed-x"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{-- <b>{{ $statusCount['soft_rejected'] ?? 0 }}</b> --}}
                                                </div>
                                                <div class="text-secondary">
                                                    Soft Rejected Items
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <i class="ti ti-cancel"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{-- <b>{{ $statusCount['hard_rejected'] ?? 0 }}</b> --}}
                                                </div>
                                                <div class="text-secondary">
                                                    Hard Rejected Items
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <i class="ti ti-rosette-discount-check"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{-- <b>{{ $statusCount['approved'] ?? 0 }}</b> --}}
                                                </div>
                                                <div class="text-secondary">
                                                    Approved Items
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <i class="ti ti-certificate-2"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{-- <b>{{ $kycCount }}</b> --}}
                                                </div>
                                                <div class="text-secondary">
                                                    KYC Pending
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <i class="ti ti-basket-check"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{-- <b>{{ $orderCount }}</b> --}}
                                                </div>
                                                <div class="text-secondary">
                                                    Total Orders
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <i class="ti ti-device-tablet-dollar"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{-- <b>{{ $withdrawalCount }}</b> --}}
                                                </div>
                                                <div class="text-secondary">
                                                    Pending Withdrawals
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                    <i class="ti ti-user-star"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{-- <b>{{ $subscriberCount }}</b> --}}
                                                </div>
                                                <div class="text-secondary">
                                                    Total Subscribers
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Yearly Sales Report</h3>
                                        <div class="card-actions">
                                            {{-- <form action="" method="get" class="year-form">
                                                <select name="year" class="form-select year-select">
                                                    @foreach ($years as $year)
                                                        <option @selected(request()->year == $year) value="{{ $year }}">{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                            </form> --}}
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div id="chart-mentions" class="chart-lg"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Withdraw Requests</h3>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-vcenter card-table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Author</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th class="w-1"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @forelse($withdrawRequests as $withdrawRequest)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <div>
                                                                {{ $withdrawRequest->author->name }}
                                                            </div>
                                                            <div>{{ $withdrawRequest->author->email }}</div>
                                                        </td>
                                                        <td>{{ currencyPosition($withdrawRequest->amount) }}</td>
                                                        <td>
                                                            @if ($withdrawRequest->status == 'pending')
                                                            <span class="badge bg-yellow text-yellow-fg">{{ __('Pending') }}</span>
                                                            @elseif($withdrawRequest->status == 'paid')
                                                            <span class="badge bg-green text-green-fg">{{ __('Paid') }}</span>
                                                            @else
                                                            <span class="badge bg-red text-red-fg">{{ __('Rejected') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ formatDate($withdrawRequest->created_at) }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.withdraw-requests.show', $withdrawRequest->id) }}">
                                                                <i class="ti ti-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center">{{ __('No Data Found') }}</td>
                                                    </tr>
                                                @endforelse --}}

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Recent Orders</h3>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-vcenter card-table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Buyer</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th class="w-1"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @forelse($orders as $order)
                                                    <tr>
                                                        <td>#{{ $order->code }}</td>
                                                        <td>
                                                            {{ $order->user->name }}
                                                        </td>
                                                        <td class="text-green">{{ $order->transaction->paid_in_amount }}
                                                            {{ Str::upper($order->transaction->paid_in_currency_icon) }}
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge bg-green text-green-fg">{{ $order->status }}</span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.orders.show', $order->id) }}">
                                                                <i class="ti ti-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td>No orders found</td>
                                                    </tr>
                                                @endforelse --}}

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <div class="row text-center align-items-center flex-row-reverse">

                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Copyright &copy; {{ date('Y') }}
                                <a href="." class="link-secondary">{{ config('settings.site_name') }}</a>.
                                All rights reserved.
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection


