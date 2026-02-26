@extends('admin.layouts.master')
@section('title', 'Order Details')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Order Details') }}</h3>
                        <div class="card-actions">
                            <x-admin.back-button :href="route('admin.orders.index')" />
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover align-middle">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">{{ __('Order ID') }}</td>
                                            <td>#{{ $order->code }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">{{ __('User') }}</td>
                                            <td>{{ $order->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">{{ __('Transaction ID') }}</td>
                                            <td>{{ $order->transaction->payment_id ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">{{ __('Payment Method') }}</td>
                                            <td>{{ ucfirst($order->transaction->payment_gateway ?? '-') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">{{ __('Total Amount') }}</td>
                                            <td>
                                                <span
                                                    class="fw-semibold">{{ config('settings.currency_icon') }}{{ number_format($order->transaction->paid_amount, 2) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">{{ __('Paid in Amount') }}</td>
                                            <td>
                                                {{ number_format($order->transaction->paid_in_amount, 2) }}
                                                {{ $order->transaction->paid_in_currency_icon ?? '-' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">{{ __('Exchange Rate') }}</td>
                                            <td>{{ $order->transaction->exchange_rate ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">{{ __('Status') }}</td>
                                            <td>
                                                <span class="badge bg-green-lt text-green">
                                                    {{ ucfirst($order->transaction->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <table class="table table-striped table-hover table-responsive align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 5%">#</th>
                                    <th>Product</th>
                                    <th class="text-center" style="width: 10%">Qnt</th>
                                    <th class="text-end" style="width: 15%">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->purchaseItems as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <p class="fw-semibold mb-1">{{ $item->item->name }}</p>
                                            <div class="text-muted small">Author: {{ $item->item->author->name }}</div>
                                        </td>
                                        <td class="text-center">1</td>
                                        <td class="text-end">
                                            {{ config('settings.currency_icon') }}{{ number_format($item->item->price, 2) }}
                                        </td>
                                    </tr>
                                @endforeach

                                <tr class="fw-bold">
                                    <td colspan="3" class="text-end">Total</td>
                                    <td class="text-end">
                                        {{ config('settings.currency_icon') }}{{ number_format($order->transaction->paid_amount, 2) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer text-end">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
