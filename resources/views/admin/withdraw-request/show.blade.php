@extends('admin.layouts.master')
@section('title', 'Withdraw Details')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">

                {{-- Page Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="page-title">{{ __('Withdraw Details') }}</h2>
                    <x-admin.back-button :href="route('admin.withdraw-requests.index')" />
                </div>

                {{-- Withdraw Card --}}
                <div class="card shadow-sm">
                    <div class="card-body">

                        {{-- Author Info --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ __('Author') }}</h5>
                                        <p class="mb-1 fw-semibold">{{ $withdrawRequest->author->name }}</p>
                                        <p class="text-muted mb-0">{{ $withdrawRequest->author->email }}</p>
                                        <p class="text-muted mt-1">{{ __('Balance') }}:
                                            {{ currencyPosition($withdrawRequest->author->balance) }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Withdraw Info --}}
                            <div class="col-md-6">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ __('Withdraw Info') }}</h5>
                                        <p class="mb-1">{{ __('Amount') }}: <span
                                                class="fw-semibold">{{ currencyPosition($withdrawRequest->amount) }}</span>
                                        </p>
                                        <p class="mb-1">{{ __('Payment Method') }}: <span
                                                class="fw-semibold">{{ $withdrawRequest->method }}</span></p>
                                        <p class="mb-1">{{ __('Account Info') }}: <br>{!! nl2br($withdrawRequest->account) !!}</p>
                                        <p class="mb-0">{{ __('Created At') }}:
                                            {{ formatDate($withdrawRequest->created_at) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ __('Status') }}</h5>
                                        @php
                                            $statusColors = [
                                                'pending' => 'badge bg-green-lt text-yellow',
                                                'paid' => 'badge bg-green-lt text-green',
                                                'rejected' => 'badge bg-green-lt text-red',
                                            ];
                                        @endphp
                                        <span
                                            class="badge {{ $statusColors[$withdrawRequest->status] ?? 'bg-gray text-gray' }}">
                                            {{ ucfirst($withdrawRequest->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Action Form --}}
                            @if ($withdrawRequest->status == 'pending')
                                <div class="col-md-6">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ __('Update Status') }}</h5>
                                            <form
                                                action="{{ route('admin.withdraw-requests-status.update', $withdrawRequest->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <x-admin.input-select name="status" :label="__('Status')">
                                                    <option @selected($withdrawRequest->status == 'pending') value="pending">
                                                        {{ __('Pending') }}</option>
                                                    <option @selected($withdrawRequest->status == 'paid') value="paid">{{ __('Paid') }}
                                                    </option>
                                                    <option @selected($withdrawRequest->status == 'rejected') value="rejected">
                                                        {{ __('Rejected') }}</option>
                                                </x-admin.input-select>
                                                <x-admin.submit-button :label="__('Update')" class="mt-2" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
