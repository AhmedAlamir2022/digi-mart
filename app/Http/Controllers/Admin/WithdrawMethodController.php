<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\WithdrawMethodStoreRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class WithdrawMethodController extends Controller implements HasMiddleware
{
    static function Middleware(): array
    {
        return [
            new Middleware('permission:show withdraw methods', only: ['index']),
            new Middleware('permission:add new withdraw method', only: ['create', 'store']),
            new Middleware('permission:edit withdraw method', only: ['edit', 'update']),
            new Middleware('permission:delete withdraw method', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $methods = WithdrawMethod::all();
        return view('admin.withdraw-method.index', compact('methods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.withdraw-method.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WithdrawMethodStoreRequest $request)
    {
        $method = new WithdrawMethod();
        $method->name = $request->name;
        $method->minimum_amount = $request->minimum_amount;
        $method->maximum_amount = $request->maximum_amount;
        $method->description = $request->description;
        $method->status = $request->status;
        $method->save();

        notyf()->success('Withdrawal Method Created Successfully');
        return to_route('admin.withdrawal-methods.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WithdrawMethod $withdrawalMethod)
    {
        return view('admin.withdraw-method.edit', compact('withdrawalMethod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WithdrawMethodStoreRequest $request, WithdrawMethod $withdrawalMethod)
    {
        $withdrawalMethod->name = $request->name;
        $withdrawalMethod->minimum_amount = $request->minimum_amount;
        $withdrawalMethod->maximum_amount = $request->maximum_amount;
        $withdrawalMethod->description = $request->description;
        $withdrawalMethod->status = $request->status;
        $withdrawalMethod->save();

        notyf()->info('Withdrawal Method Updated Successfully');
        return to_route('admin.withdrawal-methods.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WithdrawMethod $withdrawalMethod)
    {
        try {
            $withdrawalMethod->delete();

            notyf()->info('Withdrawal Method deleted successfully.');
            return response()->json(['status' => 'success', 'message' => __('Delete successfully')], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
