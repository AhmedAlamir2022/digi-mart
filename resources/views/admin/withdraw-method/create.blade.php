@extends('admin.layouts.master')
@section('title', 'Create Withdrawal Method')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">

                <div class="card shadow border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">{{ __('Create Withdrawal Method') }}</h3>
                        <a href="{{ route('admin.withdrawal-methods.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="ti ti-arrow-left me-1"></i> {{ __('Go Back') }}
                        </a>
                    </div>

                    <form action="{{ route('admin.withdrawal-methods.store') }}" class="x-form" method="POST">
                        @csrf
                        <div class="card-body">

                            {{-- Basic Info Section --}}
                            <div class="mb-4 p-3 border rounded">
                                <h5 class="mb-3 text-primary">{{ __('Basic Information') }}</h5>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <x-admin.input-text name="name" :label="__('Method Name')" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-admin.input-text type='number' name="minimum_amount" :label="__('Minimum Amount')" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-admin.input-text type='number' name="maximum_amount" :label="__('Maximum Amount')" />
                                    </div>
                                </div>
                            </div>

                            {{-- Description Section --}}
                            <div class="mb-4 p-3 border rounded">
                                <h5 class="mb-3 text-primary">{{ __('Description') }}</h5>
                                <x-admin.input-textarea name="description" :label="__('Method Description')" />
                            </div>

                            {{-- Status Section --}}
                            <div class="mb-4 p-3 border rounded">
                                <h5 class="mb-3 text-primary">{{ __('Status') }}</h5>
                                <x-admin.input-select name="status" :label="__('Activation Status')">
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('Inactive') }}</option>
                                </x-admin.input-select>
                            </div>

                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            <x-admin.submit-button :label="__('Create Method')" onclick="$('.x-form').submit();" />
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
