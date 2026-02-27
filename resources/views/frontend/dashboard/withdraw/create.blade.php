@extends('frontend.dashboard.layouts.master')
@section('title', 'Create Withdraw Request')
@section('content')
    <div class="wsus__dash_order_table">

        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5>{{ __('Create Withdraw Request') }}</h5>

            </div>
            <div>
                <a class="btn btn-primary" href="{{ route('withdraws.index') }}">{{ __('Go Back') }}</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-widget red">
                    <span class="dashboard-widget__icon">
                        <i class="ti ti-basket-check"></i>
                    </span>
                    <div class="dashboard-widget__content flx-between gap-1 align-items-end">
                        <div>
                            <h4 class="dashboard-widget__number mb-1 mt-3">{{ currencyPosition(user()->balance) }}</h4>
                            <span class="dashboard-widget__text font-14">{{ __('Current Balance') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-widget red">
                    <span class="dashboard-widget__icon">
                        <i class="ti ti-basket-check"></i>
                    </span>
                    <div class="dashboard-widget__content flx-between gap-1 align-items-end">
                        <div>
                            <h4 class="dashboard-widget__number mb-1 mt-3">
                                {{ currencyPosition($user->pending_withdraw_sum ?? 0) }}</h4>
                            <span class="dashboard-widget__text font-14">{{ __('Pending Withdraw') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-widget red">
                    <span class="dashboard-widget__icon">
                        <i class="ti ti-basket-check"></i>
                    </span>
                    <div class="dashboard-widget__content flx-between gap-1 align-items-end">
                        <div>
                            <h4 class="dashboard-widget__number mb-1 mt-3">
                                {{ currencyPosition($user->paid_withdraw_sum ?? 0) }}</h4>
                            <span class="dashboard-widget__text font-14">{{ __('Total Withdraw') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-widget red">
                    <span class="dashboard-widget__icon">
                        <i class="ti ti-basket-check"></i>
                    </span>
                    <div class="dashboard-widget__content flx-between gap-1 align-items-end">
                        <div>
                            <h4 class="dashboard-widget__number mb-1 mt-3">
                                {{ currencyPosition($user->author_sales_sum_author_earning ?? 0) }}</h4>
                            <span class="dashboard-widget__text font-14">{{ __('Total Earnings') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div>
            <div class="">
                <table class="table">
                    <tr>
                        <td>
                            {{ __('Payment Method') }} :
                        </td>
                        <td class="text-start">
                            {{ user()->withdrawInfo?->withdrawGateway->name }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ __('Account Info') }} :
                        </td>
                        <td class="text-start">
                            {!! nl2br(user()->withdrawInfo?->information) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ __('Minimum Withdraw Amount') }} :
                        </td>
                        <td class="text-start">
                            {{ currencyPosition(user()->withdrawInfo?->withdrawGateway->minimum_amount) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ __('Maximum Withdraw Amount') }} :
                        </td>
                        <td class="text-start">
                            {{ currencyPosition(user()->withdrawInfo?->withdrawGateway->maximum_amount) }}
                        </td>
                    </tr>
                </table>

            </div>
        </div>
        <form action="{{ route('withdraws.store') }}" method="POST">
            @csrf
            <x-frontend.input-text name="amount" :label="__('Amount')" :required="true" />

            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
        </form>

    </div>
@endsection
