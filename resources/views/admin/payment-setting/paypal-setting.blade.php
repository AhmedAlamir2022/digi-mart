@extends('admin.payment-setting.index')

@section('setting_content')
<div class="col-12 col-md-12 d-flex flex-column">

    <div class="card-body">

        <h2 class="mb-1">{{ __('Paypal Settings') }}</h2>
        <div class="text-muted mb-4">
            {{ __('Configure your PayPal gateway credentials and environment mode') }}
        </div>

        <form action="{{ route('admin.paypal-settings.update') }}" method="POST" id="x-form">
            @csrf
            @method('PUT')

            {{-- Environment Settings --}}
            <div class="mb-4">
                <h4 class="mb-3 text-primary">{{ __('Environment Configuration') }}</h4>

                <div class="row">
                    <div class="col-md-6">
                        <x-admin.input-select name="paypal_mode" :label="__('Paypal Mode')">
                            <option @selected(config('settings.paypal_mode') == 'sandbox') value="sandbox">
                                {{ __('Sandbox') }}
                            </option>
                            <option @selected(config('settings.paypal_mode') == 'live') value="live">
                                {{ __('Live') }}
                            </option>
                        </x-admin.input-select>
                    </div>

                    <div class="col-md-6">
                        <x-admin.input-select name="paypal_status" :label="__('Paypal Status')">
                            <option @selected(config('settings.paypal_status') == 'active') value="active">
                                {{ __('Active') }}
                            </option>
                            <option @selected(config('settings.paypal_status') == 'inactive') value="inactive">
                                {{ __('Inactive') }}
                            </option>
                        </x-admin.input-select>
                    </div>
                </div>
            </div>

            {{-- API Credentials --}}
            <div class="mb-4">
                <h4 class="mb-3 text-primary">{{ __('API Credentials') }}</h4>

                <div class="row">
                    <div class="col-md-6">
                        <x-admin.input-text
                            name="paypal_app_id"
                            :label="__('App Id')"
                            :value="config('settings.paypal_app_id')" />
                    </div>

                    <div class="col-md-6">
                        <x-admin.input-text
                            name="paypal_client_id"
                            :label="__('Client Id')"
                            :value="config('settings.paypal_client_id')" />
                    </div>

                    <div class="col-md-12">
                        <x-admin.input-text
                            name="paypal_secret_key"
                            :label="__('Secret Key')"
                            :value="config('settings.paypal_secret_key')" />
                    </div>
                </div>
            </div>

        </form>

    </div>

    <div class="card-footer bg-transparent mt-auto">
        <div class="btn-list justify-content-end">
            <x-admin.submit-button
                :label="__('Save Changes')"
                onclick="$('#x-form').submit();" />
        </div>
    </div>

</div>
@endsection
