<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SmtpSettingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'smtp_sender_name' => ['required', 'string', 'max:255'],
            'smtp_sender_email' => ['required', 'email', 'max:255'],
            'smtp_recipient_email' => ['required', 'email', 'max:255'],
            'smtp_mail_host' => ['required', 'string', 'max:255'],
            'smtp_user_name' => ['required', 'string', 'max:255'],
            'smtp_user_password' => ['required', 'string', 'max:255'],
            'smtp_port' => ['required', 'integer', 'between:1,65535'],
            'smtp_encryption' => ['required', 'in:tls,ssl,null'],
        ];
    }

    public function messages(): array
    {
        return [
            'smtp_sender_email.email' => 'Sender email must be valid.',
            'smtp_recipient_email.email' => 'Recipient email must be valid.',
            'smtp_port.integer' => 'SMTP port must be a number.',
            'smtp_encryption.in' => 'Encryption must be TLS, SSL, or NULL.',
        ];
    }
}
