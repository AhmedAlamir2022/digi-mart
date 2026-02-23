<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GeneralSettingUpdateRequest;
use App\Http\Requests\Admin\LogoSettingUpdateRequest;
use App\Http\Requests\Admin\SmtpSettingUpdateRequest;
use App\Models\Setting;
use App\Services\SettingService;
use App\Traits\FileUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SettingController extends Controller implements HasMiddleware
{
    use FileUpload;

    static function Middleware(): array
    {
        return [
            new Middleware('permission:manage settings')
        ];
    }

    function index()
    {
        return view('admin.setting.general-setting');
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

        notyf()->info('General Settings Updated Successfully');
        return redirect()->back();
    }

    function commissionSetting()
    {
        return view('admin.setting.commission-setting');
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

        notyf()->info('Commission Settings Updated Successfully');
        return redirect()->back();
    }

    function logoSetting()
    {
        return view('admin.setting.logo-setting');
    }

    function updateLogoSetting(LogoSettingUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('logo')) {
            $validatedData['logo'] = $this->uploadFile($request->file('logo'));
        }

        if ($request->hasFile('footer_logo')) {
            $validatedData['footer_logo'] = $this->uploadFile($request->file('footer_logo'));
        }

        if ($request->hasFile('favicon')) {
            $validatedData['favicon'] = $this->uploadFile($request->file('favicon'));
        }

        if ($request->hasFile('breadcrumb')) {
            $validatedData['breadcrumb'] = $this->uploadFile($request->file('breadcrumb'));
        }

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        app(SettingService::class)->clearCashedSettings();
        notyf()->info('Logo Settings Updated Successfully');
        return redirect()->back();
    }

    function smtpSetting()
    {
        return view('admin.setting.smtp-setting');
    }

    function updateSmtpSetting(SmtpSettingUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        app(SettingService::class)->clearCashedSettings();
        notyf()->info('SMTP Settings Updated Successfully');
        return redirect()->back();
    }
}
