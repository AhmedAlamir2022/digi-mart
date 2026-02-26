<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AuthorSale;
use App\Models\Item;
use App\Models\PurchaseItem;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $purchases = PurchaseItem::with([
            'item.category',
            'item.subCategory'
        ])
            ->where('user_id', user()->id)
            ->latest()
            ->paginate(10);

        return view('frontend.dashboard.order.index', compact('purchases'));
    }

    function show(string $id)
    {
        $purchaseItem = PurchaseItem::findOrFail($id);
        return view('frontend.dashboard.order.show', compact('purchaseItem'));
    }

    public function itemDownload(string $id)
    {
        $item = Item::findOrFail($id);


        $filePath = public_path('uploads/items/' . basename($item->main_file));

        if (file_exists($filePath)) {

            return response()->download($filePath, basename($item->main_file));
        }

        notyf()->error('File not exist in server.');
        return redirect()->back();
    }

    function sales()
    {
        abort_if(user()->user_type != 'author', 403);
        $sales = AuthorSale::with('item', 'item.category', 'item.subCategory')->where('author_id', user()->id)->latest()->paginate(10);
        return view('frontend.dashboard.order.sales', compact('sales'));
    }

    function transactions()
    {
        $transactions = Transaction::where('user_id', user()->id)->latest()->paginate(25);
        return view('frontend.dashboard.order.transaction', compact('transactions'));
    }
}
