@extends('admin.layouts.master')
@section('title', 'Withdrawal Methods')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Withdrawal Methods') }}</h3>
                        <div class="card-actions">
                            @can('add new withdraw method')
                                <a href="{{ route('admin.withdrawal-methods.create') }}" class="btn btn-primary">
                                    <i class="ti ti-plus"></i>
                                    {{ __('Add new') }}
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Minimum Amount') }}</th>
                                            <th>{{ __('Maximum Amount') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th class="w-8"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($methods as $method)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <span class="badge bg-primary-lt text-primary fw-semibold px-3 py-2">
                                                        {{ $method->name }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info-lt text-info fw-medium px-3 py-2">
                                                        {{ currencyPosition($method->minimum_amount) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-warning-lt text-warning fw-medium px-3 py-2">
                                                        {{ currencyPosition($method->maximum_amount) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($method->status == 1)
                                                        <span
                                                            class="badge bg-green-lt text-green">{{ __('Active') }}</span>
                                                    @else
                                                        <span class="badge bg-red-lt text-red">{{ __('InActive') }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-muted">
                                                    {{ formatDate($method->created_at, true) }}
                                                </td>
                                                <td>
                                                    @can('edit withdraw method')
                                                        <a href="{{ route('admin.withdrawal-methods.edit', $method->id) }}"
                                                            class="btn btn-sm btn-outline-primary"><i
                                                                class="ti ti-edit"></i></a>
                                                    @endcan
                                                    @can('delete withdraw method')
                                                        <a class="delete-item btn btn-sm btn-outline-danger"
                                                            href="{{ route('admin.withdrawal-methods.destroy', $method->id) }}"><i
                                                                class="ti ti-trash"></i></a>
                                                        </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    {{ __('No withdrawal methods found') }}</td>
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
