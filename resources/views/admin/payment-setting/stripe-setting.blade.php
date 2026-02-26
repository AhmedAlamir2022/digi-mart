@extends('admin.payment-setting.index')

@section('setting_content')
    <div class="col-12 col-md-12 d-flex flex-column">

        <div class="card-body">

            <h2 class="mb-1">{{ __('Stripe Settings') }}</h2>
            <div class="text-muted mb-4">
                {{ __('Configure your Stripe payment gateway credentials and activation status') }}
            </div>

            <form action="{{ route('admin.stripe-settings.update') }}" method="POST" id="x-form">
                @csrf
                @method('PUT')

                {{-- API Credentials --}}
                <div class="mb-4">
                    <h4 class="mb-3 text-primary">{{ __('API Credentials') }}</h4>

                    <div class="row">

                        <div class="col-md-6">
                            <x-admin.input-text name="stripe_publishable_key" :label="__('Publishable Key')" :value="config('settings.stripe_publishable_key')" />
                        </div>

                        <div class="col-md-6">
                            <x-admin.input-text name="stripe_secret_key" :label="__('Secret Key')" :value="config('settings.stripe_secret_key')" />
                        </div>

                    </div>
                </div>

                {{-- Gateway Status --}}
                <div class="mb-4">
                    <h4 class="mb-3 text-primary">{{ __('Gateway Status') }}</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <x-admin.input-select name="stripe_status" :label="__('Stripe Status')">
                                <option @selected(config('settings.stripe_status') == 'active') value="active">
                                    {{ __('Active') }}
                                </option>
                                <option @selected(config('settings.stripe_status') == 'inactive') value="inactive">
                                    {{ __('Inactive') }}
                                </option>
                            </x-admin.input-select>
                        </div>
                    </div>
                </div>

            </form>

        </div>

        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <x-admin.submit-button :label="__('Save Changes')" onclick="$('#x-form').submit();" />
            </div>
        </div>

    </div>
@endsection
