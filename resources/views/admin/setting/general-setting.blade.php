@extends('admin.setting.index')

@section('setting_content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <div class="card-body">
            <h2 class="mb-1">{{ __('General Settings') }}</h2>
            <div class="text-muted mb-4">
                Configure your platform basic information and localization
            </div>

            <form action="{{ route('admin.settings.general.update') }}" method="POST" id="x-form">
                @csrf
                @method('PUT')

                {{-- Basic Information --}}
                <div class="mb-4">
                    <h4 class="mb-3 text-primary">{{ __('Basic Information') }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <x-admin.input-text name="site_name" :label="__('Site Name')" :value="config('settings.site_name')" />
                        </div>

                        <div class="col-md-6">
                            <x-admin.input-text name="site_email" :label="__('Site Email')" :value="config('settings.site_email')" />
                        </div>
                    </div>
                </div>

                {{-- Localization --}}
                <div class="mb-4">
                    <h4 class="mb-3 text-primary">{{ __('Localization') }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <x-admin.input-select name="country" :label="__('Country')" class="select_2">
                                @foreach (config('options.countries') as $key => $country)
                                    <option @selected($key == config('settings.country')) value="{{ $key }}">
                                        {{ $country }}
                                    </option>
                                @endforeach
                            </x-admin.input-select>
                        </div>

                        <div class="col-md-6">
                            <x-admin.input-select name="time_zone" :label="__('Time Zone')" class="select_2">
                                @foreach (config('options.time_zones') as $key => $zone)
                                    <option @selected($key == config('settings.time_zone')) value="{{ $key }}">
                                        {{ $key }} - {{ $zone }}
                                    </option>
                                @endforeach
                            </x-admin.input-select>
                        </div>
                    </div>
                </div>

                {{-- Currency Settings --}}
                <div class="mb-4">
                    <h4 class="mb-3 text-primary">{{ __('Currency Settings') }}</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <x-admin.input-select name="default_currency" :label="__('Default Currency')" class="select_2">
                                @foreach (config('options.currencies') as $key => $currency)
                                    <option @selected($key == config('settings.default_currency')) value="{{ $key }}">
                                        {{ $currency }} - {{ $key }}
                                    </option>
                                @endforeach
                            </x-admin.input-select>
                        </div>

                        <div class="col-md-4">
                            <x-admin.input-text name="currency_icon" :label="__('Currency Icon')" :value="config('settings.currency_icon')" />
                        </div>

                        <div class="col-md-4">
                            <x-admin.input-select name="currency_position" :label="__('Currency Position')">
                                <option @selected(config('settings.currency_position') == 'left') value="left">
                                    {{ __('Left') }}
                                </option>
                                <option @selected(config('settings.currency_position') == 'right') value="right">
                                    {{ __('Right') }}
                                </option>
                            </x-admin.input-select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <x-admin.submit-button :label="__('Save')" onclick="$('#x-form').submit();" />
            </div>
        </div>
    </div>
@endsection
