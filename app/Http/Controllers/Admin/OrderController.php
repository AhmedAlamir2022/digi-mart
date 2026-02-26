<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class OrderController extends Controller implements HasMiddleware
{
    static function Middleware(): array
    {
        return [
            new Middleware('permission:show all orders', only: ['index']),
            new Middleware('permission:show order details', only: ['show']),
        ];
    }

    function index()
    {
        $orders = Purchase::with(['user:id,name', 'transaction', 'purchaseItems'])->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function show(string $id)
    {
        $order = Purchase::with([
            'user',
            'transaction',
            'purchaseItems.item.author'
        ])->findOrFail($id);

        return view('admin.order.show', compact('order'));
    }
}
