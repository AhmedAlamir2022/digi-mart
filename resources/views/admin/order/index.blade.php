@extends('admin.layouts.master')
@section('title', 'Orders')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">{{ __('All Orders') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-vcenter card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Buyer</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span class="badge bg-light text-dark" style="font-family: monospace;">
                                                    #{{ $order->code }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar rounded-circle bg-secondary text-white text-center"
                                                        style="width:32px; height:32px; line-height:32px; font-size:14px;">
                                                        {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                                    </div>
                                                    <span>{{ $order->user->name }}</span>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <span class="fw-bold text-success">
                                                    {{ number_format($order->transaction->paid_in_amount, 2) }}
                                                    <small
                                                        class="text-muted">{{ $order->transaction->paid_in_currency_icon }}</small>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-green-lt text-green">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>{{ formatDate($order->created_at, true) }}</td>
                                            <td class="text-center">
                                                @can('show order details')
                                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                                        class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                                        title="View Details">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">No orders found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
