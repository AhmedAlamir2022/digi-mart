@extends('frontend.dashboard.layouts.master')
@section('title', 'Withdraw List')
@section('content')
    <div class="wsus__dash_order_table">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5>{{ __('Withdraw List') }}</h5>
                <p>{{ __('All withdraw history') }}.</p>
            </div>
            <div>
                <div>
                    <a class="btn btn-primary" href="{{ route('withdraws.create') }}">{{ __('Create a Request') }}</a>
                </div>

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
                            Amount
                        </th>

                        <th class="p_date">
                            Status
                        </th>
                        <th class="p_date">
                            Date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(user()->withdraws()->latest()->get() as $withdraw)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ currencyPosition($withdraw->amount) }}</td>
                        <td>
                            @if ($withdraw->status == 'pending')
                            <span class="badge bg-warning text-white">{{ $withdraw->status }}</span>
                            @elseif($withdraw->status == 'paid')
                            <span class="badge bg-success text-white">{{ $withdraw->status }}</span>
                            @else
                            <span class="badge bg-danger text-white">{{ $withdraw->status }}</span>
                            @endif
                        </td>
                        <td>{{ formatDate($withdraw->created_at) }}</td>
                    </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>
        </div>
        <div>
            {{-- {{ $sales->links() }} --}}
        </div>
    </div>
@endsection
