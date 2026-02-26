<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(Request $request)
    {
        $query = Item::with(['author']);
        // $query->withCount(['sales', 'reviews']);
        // $query->withAvg('reviews', 'stars');
        $query->where('status', 'approved');

        $query->when($request->filled('category'), function ($query) use ($request) {
            $query->whereHas('category', function ($query) use ($request) {
                $query->whereSlug($request->category);
            });
        });
        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'LIKE', "%$request->search%")
                ->orWhere('description', 'LIKE', "%$request ->search%");
        });
        $query->when($request->filled('rating'), function ($query) use ($request) {
            $query->whereHas('reviews', function ($query) use ($request) {
                $query->where('stars', $request->rating);
            });
        });
        $products = $query->paginate(12);

        $categories = Category::withCount(['items' => function ($query) {
            return $query->where('status', 'approved');
        }])->get();

        $productCount = Item::where('status', 'approved')->count();


        $purchasedItemIds = collect(); // نعرفه الأول

        if (auth()->check()) {
            $purchasedItemIds = PurchaseItem::where('user_id', auth()->id())
                ->whereHas('purchase', function ($q) {
                    $q->where('status', 'completed');
                })
                ->pluck('item_id')
                ->map(fn($id) => (int) $id);
        }

        return view('frontend.pages.products', compact('products', 'categories', 'productCount', 'purchasedItemIds'));
    }

    function show(string $slug)
    {
        $product = Item::where('slug', $slug)->whereStatus('approved')->firstOrFail();
        return view('frontend.pages.product-details', compact('product'));
    }
}
