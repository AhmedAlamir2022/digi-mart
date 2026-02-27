<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthorWithdrawController extends Controller
{
    //
    function index()
    {
        return view('frontend.dashboard.withdraw.index');
    }

    public function create()
    {
        $user = auth()->user()
            ->load('withdrawInfo.withdrawGateway')
            ->loadSum([
                'withdraws as pending_withdraw_sum' => function ($q) {
                    $q->where('status', 'pending');
                }
            ], 'amount')
            ->loadSum([
                'withdraws as paid_withdraw_sum' => function ($q) {
                    $q->where('status', 'paid');
                }
            ], 'amount')
            ->loadSum('authorSales', 'author_earning');

        return view('frontend.dashboard.withdraw.create', compact('user'));
    }

    function store(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => ['required', 'numeric'],
        ]);

        $withdrawGateway = user()->withdrawInfo?->withdrawGateway;

        if ($request->amount < $withdrawGateway->minimum_amount) {
            throw ValidationException::withMessages(['amount' => __('The minimum amount for withdraw is :amount', ['amount' => $withdrawGateway->minimum_amount])]);
        } elseif ($request->amount > $withdrawGateway->maximum_amount) {
            throw ValidationException::withMessages(['amount' => __('The maximum amount for withdraw is :amount', ['amount' => $withdrawGateway->maximum_amount])]);
        } elseif ($request->amount > user()->balance) {
            throw ValidationException::withMessages(['amount' => __('You don\'t have enough balance')]);
        } elseif (user()->withdraws()->whereStatus('pending')->exists()) {
            throw ValidationException::withMessages(['amount' => __('You already have a pending withdraw request')]);
        }

        $withdrawRequest = new Withdraw();
        $withdrawRequest->author_id = user()->id;
        $withdrawRequest->amount = $request->amount;
        $withdrawRequest->method = $withdrawGateway->name;
        $withdrawRequest->account = user()->withdrawInfo?->information;
        $withdrawRequest->status = 'pending';
        $withdrawRequest->save();

        notyf()->success('Withdraw request has been submitted successfully');
        return to_route('withdraws.index');
    }
}
