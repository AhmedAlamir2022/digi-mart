<div class="col-12 col-md-12 d-flex flex-column">
    <div class="card shadow-sm border-0">
        <form action="{{ route('admin.settings.smtp.update') }}" method="POST" id="smtp-settings-form">
            @csrf
            @method('PUT')

            <div class="card shadow-sm border-0">
                <!-- Header -->
                <div class="card-header bg-white border-bottom">
                    <h4 class="mb-0 fw-semibold">{{ __('SMTP Settings') }}</h4>
                </div>

                <!-- Body -->
                <div class="card-body">
                    <div class="row g-3">

                        <!-- Sender Name -->
                        <div class="col-md-12 mb-4">
                            <label for="smtp_sender_name" class="fw-semibold">{{ __('Sender Name') }}</label>
                            <input type="text" name="smtp_sender_name" id="smtp_sender_name"
                                   value="{{ old('smtp_sender_name', config('settings.smtp_sender_name')) }}"
                                   class="form-control @error('smtp_sender_name') is-invalid @enderror"
                                   placeholder="Enter sender name" required>
                            @error('smtp_sender_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sender Email -->
                        <div class="col-md-6 mb-4">
                            <label for="smtp_sender_email" class="fw-semibold">{{ __('Sender Email') }}</label>
                            <input type="email" name="smtp_sender_email" id="smtp_sender_email"
                                   value="{{ old('smtp_sender_email', config('settings.smtp_sender_email')) }}"
                                   class="form-control @error('smtp_sender_email') is-invalid @enderror"
                                   placeholder="Enter sender email" required>
                            @error('smtp_sender_email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Recipient Email -->
                        <div class="col-md-6 mb-4">
                            <label for="smtp_recipient_email" class="fw-semibold">{{ __('Recipient Email') }}</label>
                            <input type="email" name="smtp_recipient_email" id="smtp_recipient_email"
                                   value="{{ old('smtp_recipient_email', config('settings.smtp_recipient_email')) }}"
                                   class="form-control @error('smtp_recipient_email') is-invalid @enderror"
                                   placeholder="Enter recipient email" required>
                            @error('smtp_recipient_email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mail Host -->
                        <div class="col-md-12 mb-4">
                            <label for="smtp_mail_host" class="fw-semibold">{{ __('Mail Host') }}</label>
                            <input type="text" name="smtp_mail_host" id="smtp_mail_host"
                                   value="{{ old('smtp_mail_host', config('settings.smtp_mail_host')) }}"
                                   class="form-control @error('smtp_mail_host') is-invalid @enderror"
                                   placeholder="Enter mail host" required>
                            @error('smtp_mail_host')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- SMTP User Name -->
                        <div class="col-md-6 mb-4">
                            <label for="smtp_user_name" class="fw-semibold">{{ __('SMTP User Name') }}</label>
                            <input type="text" name="smtp_user_name" id="smtp_user_name"
                                   value="{{ old('smtp_user_name', config('settings.smtp_user_name')) }}"
                                   class="form-control @error('smtp_user_name') is-invalid @enderror"
                                   placeholder="Enter SMTP user name" required>
                            @error('smtp_user_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- SMTP Password -->
                        <div class="col-md-6 mb-4">
                            <label for="smtp_user_password" class="fw-semibold">{{ __('SMTP Password') }}</label>
                            <input type="password" name="smtp_user_password" id="smtp_user_password"
                                   value="{{ old('smtp_user_password', config('settings.smtp_user_password')) }}"
                                   class="form-control @error('smtp_user_password') is-invalid @enderror"
                                   placeholder="Enter SMTP password" required>
                            @error('smtp_user_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- SMTP Port -->
                        <div class="col-md-6 mb-4">
                            <label for="smtp_port" class="fw-semibold">{{ __('SMTP Port') }}</label>
                            <input type="text" name="smtp_port" id="smtp_port"
                                   value="{{ old('smtp_port', config('settings.smtp_port')) }}"
                                   class="form-control @error('smtp_port') is-invalid @enderror"
                                   placeholder="Enter SMTP port" required>
                            @error('smtp_port')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- SMTP Encryption -->
                        <div class="col-md-6 mb-4">
                            <label for="smtp_encryption" class="fw-semibold">{{ __('SMTP Encryption') }}</label>
                            <select name="smtp_encryption" id="smtp_encryption"
                                    class="form-control @error('smtp_encryption') is-invalid @enderror" required>
                                <option value="ssl" @selected(old('smtp_encryption', config('settings.smtp_encryption')) == 'ssl')>SSL</option>
                                <option value="tls" @selected(old('smtp_encryption', config('settings.smtp_encryption')) == 'tls')>TLS</option>
                            </select>
                            @error('smtp_encryption')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer bg-white text-end border-top">
                    <button type="submit" form="smtp-settings-form" class="btn btn-primary px-4 py-2">
                        <i class="fas fa-save me-1"></i> {{ __('Save') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
