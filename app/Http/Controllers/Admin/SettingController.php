<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GeneralSettingUpdateRequest;
use App\Models\Setting;
use App\Services\SettingService;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use function Flasher\Notyf\Prime\notyf;

class SettingController extends Controller implements HasMiddleware
{
    use FileUpload;

    static function Middleware() : array
    {
        return [
            new Middleware('permission:manage settings')
        ];
    }

    function index(): View
    {
        return view('admin.setting.master');
    }


    function updateGeneralSetting(GeneralSettingUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        $setting = app()->make(SettingService::class);
        $setting->clearCashedSettings();

        notyf()->info('General Settings updated successfully');
        return redirect()->back();
    }


    function updateCommissionSetting(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'author_commission' => ['required', 'numeric']
        ]);



        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        $setting = app()->make(SettingService::class);
        $setting->clearCashedSettings();

        notyf()->info('Commission Settings updated successfully');
        return redirect()->back();
    }

    function updateLogoSetting(Request $request) : RedirectResponse
    {
        $validatedData = $request->validate([
            'logo' => ['nullable', 'image', 'max:2048'],
            'footer_logo' => ['nullable', 'image', 'max:2048'],
            'favicon' => ['nullable', 'image', 'max:2048'],
            'breadcrumb' => ['nullable', 'image', 'max:2048'],
        ]);

        if($request->hasFile('logo')) {
            $validatedData['logo'] = $this->uploadFile($request->file('logo'));
        }
        if($request->hasFile('footer_logo')) {
            $validatedData['footer_logo'] = $this->uploadFile($request->file('footer_logo'));
        }
        if($request->hasFile('favicon')) {
            $validatedData['favicon'] = $this->uploadFile($request->file('favicon'));
        }
        if($request->hasFile('breadcrumb')) {
            $validatedData['breadcrumb'] = $this->uploadFile($request->file('breadcrumb'));
        }

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        $setting = app()->make(SettingService::class);
        $setting->clearCashedSettings();

        notyf()->info('Logo Settings updated successfully');
        return redirect()->back();
    }

    function updateSmtpSetting(Request $request) : RedirectResponse
    {
        $validatedData = $request->validate([
            'smtp_sender_name' => ['required', 'string', 'max:255'],
            'smtp_sender_email' => ['required', 'string', 'max:255'],
            'smtp_recipient_email' => ['required', 'string', 'max:255'],
            'smtp_mail_host' => ['required', 'string', 'max:255'],
            'smtp_user_name' => ['required', 'string', 'max:255'],
            'smtp_user_password' => ['required', 'string', 'max:255'],
            'smtp_port' => ['required', 'string', 'max:255'],
            'smtp_encryption' => ['required', 'string', 'max:255'],
        ]);



        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        $setting = app()->make(SettingService::class);
        $setting->clearCashedSettings();

        notyf()->info('SMTP Settings updated successfully');
        return redirect()->back();
    }
}
