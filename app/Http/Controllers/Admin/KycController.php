<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KycVerification;
use App\Models\User;
use App\Services\MailSenderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class KycController extends Controller implements HasMiddleware
{
    static function Middleware(): array
    {
        return [
            new Middleware('permission:show kyc requests', only: ['index']),
            new Middleware('permission:update kyc request', only: ['show', 'updateStatus']),
            new Middleware('permission:download kyc file', only: ['downloadDocument']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kycRequests = KycVerification::with('user')->latest()->paginate(10);
        return view('admin.kyc.index', compact('kycRequests'));
    }

    /**
     * Display the specified resource.
     */
    public function show(KycVerification $kyc)
    {
        return view('admin.kyc.show', compact('kyc'));
    }

    function downloadDocument(int $id, int $index)
    {
        $kyc = KycVerification::findOrFail($id);
        $attachmentPath = null;
        foreach (json_decode($kyc->documents) as $key => $value) {
            if ($key == $index) {
                $attachmentPath = $value;
            }
        }

        if (Storage::exists($attachmentPath)) {
            return Storage::download($attachmentPath);
        }

        abort(404);
    }

    function updateStatus(Request $request, KycVerification $kyc): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
            'reason' => ['nullable', 'string', 'max:500']
        ]);

        $kyc->status = $request->status;
        $kyc->reject_reason = $request->reason;
        $kyc->save();

        if ($kyc->status == 'approved') {
            User::findOrFail($kyc->user_id)?->update(['kyc_status' => 1, 'user_type' => 'author']);
            MailSenderService::sendMail(
                name: $kyc->user->name,
                toMail: $kyc->user->email,
                subject: __('Your KYC has been approved'),
                content: __('We are happy to inform you that your KYC has been approved.'),
            );
        } elseif ($kyc->status == 'rejected') {
            User::findOrFail($kyc->user_id)?->update(['kyc_status' => 0, 'user_type' => 'user']);
            MailSenderService::sendMail(
                name: $kyc->user->name,
                toMail: $kyc->user->email,
                subject: __('Your KYC has been rejected'),
                content: $kyc->reject_reason ?? __('We are sorry to inform you that your KYC has been rejected.'),
            );
        } else {
            User::findOrFail($kyc->user_id)?->update(['kyc_status' => 0]);
        }

        notyf()->info('KYC Status Updated Successfully');
        return to_route('admin.kyc.index');
    }
}
