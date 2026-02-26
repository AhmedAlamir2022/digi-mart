@extends('frontend.dashboard.layouts.master')
@section('title', 'Transactions')
@section('content')
    <div class="wsus__dash_order_table">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5>{{ __('Transactions') }}</h5>
                <p>{{ __('Your Transaction History') }}.</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="sn">
                            No
                        </th>
                        <th class="details">
                            Transaction Id
                        </th>
                        <th class="p_date">
                            Method
                        </th>
                        <th class="price">
                            Paid Amount
                        </th>
                        <th class="price">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $key => $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->payment_id }}</td>
                            <td>{{ $transaction->payment_gateway }}</td>
                            <td>{{ $transaction->paid_in_amount }} {{ $transaction->paid_in_currency_icon }}</td>

                            <td><span class="badge bg-success text-white">{{ $transaction->status }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">{{ __('No transaction found') }}</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <div>
            {{ $transactions->links() }}
        </div>
    </div>
@endsection
