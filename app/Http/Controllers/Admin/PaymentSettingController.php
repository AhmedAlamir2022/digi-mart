<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaypalSettingUpdateRequest;
use App\Http\Requests\Admin\StripeSettingUpdateRequest;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PaymentSettingController extends Controller implements HasMiddleware
{
    static function Middleware() : array
    {
        return [
            new Middleware('permission:payment setting')
        ];
    }
    function index()
    {
        return view('admin.payment-setting.paypal-setting');
    }


    function updatePaypalSettings(PaypalSettingUpdateRequest $request) : RedirectResponse
    {
        $validatedData = $request->validated();

        foreach($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        $setting = app()->make(SettingService::class);
        $setting->clearCashedSettings();

        notyf()->info('Paypal Settings Updated Successfully');
        return redirect()->back();
    }


    function stripeSetting()
    {
        return view('admin.payment-setting.stripe-setting');
    }

    function updateStripeSettings(StripeSettingUpdateRequest $request) : RedirectResponse
    {
        $validatedData = $request->validated();

        foreach($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        $setting = app()->make(SettingService::class);
        $setting->clearCashedSettings();

        notyf()->info('Stripe Settings Updated Successfully');
        return redirect()->back();
    }
}
