@extends('admin.setting.index')

@section('setting_content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <div class="card-body">
            <h2 class="mb-1">{{ __('SMTP Settings') }}</h2>
            <div class="text-muted mb-4">
                Configure outgoing email server credentials and security settings
            </div>

            <form action="{{ route('admin.settings.smtp.update') }}" method="POST" id="x-form">
                @csrf
                @method('PUT')

                {{-- Sender Info --}}
                <div class="mb-4">
                    <h4 class="text-primary mb-3">{{ __('Sender Information') }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <x-admin.input-text name="smtp_sender_name" :label="__('Sender Name')" :value="config('settings.smtp_sender_name')" />
                        </div>

                        <div class="col-md-6">
                            <x-admin.input-text type="email" name="smtp_sender_email" :label="__('Sender Email')"
                                :value="config('settings.smtp_sender_email')" />
                        </div>
                        
                        <div class="col-md-6">
                            <x-admin.input-text type="email" name="smtp_recipient_email" :label="__('System Notification Email')"
                                :value="config('settings.smtp_recipient_email')" />
                            <small class="text-muted">
                                This email will receive system notifications and test messages.
                            </small>
                        </div>
                    </div>
                </div>

                {{-- Mail Server --}}
                <div class="mb-4">
                    <h4 class="text-primary mb-3">{{ __('Mail Server Configuration') }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <x-admin.input-text name="smtp_mail_host" :label="__('Mail Host')" :value="config('settings.smtp_mail_host')" />
                        </div>

                        <div class="col-md-6">
                            <x-admin.input-text type="number" name="smtp_port" :label="__('SMTP Port')" :value="config('settings.smtp_port')" />
                        </div>

                        <div class="col-md-6">
                            <x-admin.input-text name="smtp_user_name" :label="__('SMTP Username')" :value="config('settings.smtp_user_name')" />
                        </div>

                        <div class="col-md-6">
                            <x-admin.input-text type="password" name="smtp_user_password" :label="__('SMTP Password')"
                                :value="config('settings.smtp_user_password')" />
                        </div>
                    </div>
                </div>

                {{-- Encryption --}}
                <div class="mb-4">
                    <h4 class="text-primary mb-3">{{ __('Security') }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <x-admin.input-select name="smtp_encryption" :label="__('Encryption Type')">
                                <option @selected(config('settings.smtp_encryption') == 'ssl') value="ssl">SSL</option>
                                <option @selected(config('settings.smtp_encryption') == 'tls') value="tls">TLS</option>
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
