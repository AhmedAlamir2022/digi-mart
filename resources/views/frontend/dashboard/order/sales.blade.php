@extends('frontend.dashboard.layouts.master')
@section('title', 'Sales')
@section('content')
    <div class="wsus__dash_order_table">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5>{{ __('Author Sales') }}</h5>
                <p>{{ __('All Sales History') }}.</p>
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
                            Details
                        </th>
                        <th class="p_date">
                            Earning
                        </th>
                        <th class="price">
                            Platform Charge
                        </th>
                        <th class="price">
                            Amount
                        </th>
                        <th class="price">
                            Date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $key => $sale)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">
                                <div>
                                    <h6><a href="{{ route('products.show', $sale->item->slug) }}"
                                            target="_blank">{{ $sale->item->name }}</a></h6>
                                </div>
                                <div>
                                    <span>{{ $sale->item->category->name }} / {{ $sale->item->subCategory->name }}</span>
                                </div>
                            </td>
                            <td><b
                                    class="text-success">+{{ config('settings.currency_icon') }}{{ $sale->author_earning }}</b>
                            </td>
                            <td><b
                                    class="text-danger">-{{ config('settings.currency_icon') }}{{ $sale->amount - $sale->author_earning }}</b>
                            </td>
                            <td><b>{{ config('settings.currency_icon') }}{{ $sale->amount }}</b></td>
                            <td class="text-start">{{ formatDate($sale->created_at, true) }}</td>

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
            {{ $sales->links() }}
        </div>
    </div>
@endsection
