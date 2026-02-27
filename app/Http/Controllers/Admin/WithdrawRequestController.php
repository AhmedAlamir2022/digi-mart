<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdraw;
use App\Services\MailSenderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class WithdrawRequestController extends Controller implements HasMiddleware
{
    static function Middleware(): array
    {
        return [
            new Middleware('permission:show all withdraw requests', only: ['index']),
            new Middleware('permission:show withdraw request info', only: ['show', 'updateStatus']),
        ];
    }
    //
    function index()
    {
        $withdrawRequests = Withdraw::with('author')->latest()->paginate(10);
        return view('admin.withdraw-request.index', compact('withdrawRequests'));
    }

    function show(string $id)
    {
        $withdrawRequest = Withdraw::findOrFail($id);
        return view('admin.withdraw-request.show', compact('withdrawRequest'));
    }

    function updateStatus(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:pending,paid,rejected']
        ]);

        $withdrawRequest = Withdraw::findOrFail($id);
        $withdrawRequest->status = $request->status;
        $withdrawRequest->save();
        $amount = currencyPosition($withdrawRequest->amount);

        if ($withdrawRequest->status == 'paid') {
            $updateBalance = $withdrawRequest->author;
            $updateBalance->balance = $updateBalance->balance - $withdrawRequest->amount;
            $updateBalance->save();

            MailSenderService::sendMail(
                name: $withdrawRequest->author->name,
                toMail: $withdrawRequest->author->email,
                subject: 'Withdrawal Request Approved',
                content: "Your withdrawal request for amount {$amount} has been approved"
            );
        } elseif ($withdrawRequest->status == 'rejected') {
            MailSenderService::sendMail(
                name: $withdrawRequest->author->name,
                toMail: $withdrawRequest->author->email,
                subject: 'Withdrawal Request Rejected',
                content: "Your withdrawal request for amount {$amount} has been rejected please try again or contact support"
            );
        }

        notyf()->info('Withdrawal request updated successfully.');
        return to_route('admin.withdraw-requests.index');
    }
}
