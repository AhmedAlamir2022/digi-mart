@extends('admin.layouts.master')
@section('title', 'Withdraw Request')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Withdraw Requests') }}</h3>

                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Author</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($withdrawRequests as $withdrawRequest)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="p-2 rounded-3 border bg-light-subtle">

                                                        <span class="badge bg-primary-subtle text-primary">
                                                            {{ $withdrawRequest->author->name }}
                                                        </span>
                                                        <div class="mt-1 small text-muted">
                                                            {{ $withdrawRequest->author->email }}
                                                        </div>

                                                    </div>
                                                </td>
                                                <td><span class="badge bg-warning-lt text-warning fw-medium px-3 py-2">
                                                        {{ currencyPosition($withdrawRequest->amount) }}</td>
                                                <td>
                                                    @if ($withdrawRequest->status == 'pending')
                                                        <span
                                                            class="badge bg-green-lt text-yellow">{{ __('Pending') }}</span>
                                                    @elseif($withdrawRequest->status == 'paid')
                                                        <span
                                                            class="badge bg-green-lt text-green">{{ __('Paid') }}</span>
                                                    @else
                                                        <span class="badge bg-green-lt text-red">{{ __('Rejected') }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-muted">
                                                    {{ formatDate($withdrawRequest->created_at, true) }}
                                                </td>
                                                <td>
                                                    @can('show withdraw request info')
                                                        <a href="{{ route('admin.withdraw-requests.show', $withdrawRequest->id) }}"
                                                            class='btn btn-sm btn-outline-primary'>
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">{{ __('No Data Found') }}</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
