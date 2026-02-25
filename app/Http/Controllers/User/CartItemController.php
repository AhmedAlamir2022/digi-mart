<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = CartItem::with('item.category', 'item.subCategory')->where('user_id', user()->id)->get();
        return view('frontend.pages.cart', compact('cartItems'));
    }

    function store(string $id): JsonResponse
    {
        // dd($id);
        $item = Item::where('id', $id)->where('status', 'approved')->first();
        if (!$item) {
            return ValidationException::withMessages(['Item not found or not approved']);
        } elseif (CartItem::where('item_id', $id)->where('user_id', user()->id)->exists()) {
            return response()->json(['status' => 'error', 'message' => __('Item already in cart')], 400);
        } elseif ($item->author_id == user()->id) {
            return response()->json(['status' => 'error', 'message' => __('You cannot add your own item to cart')], 400);
        }

        $cart = new CartItem();
        $cart->item_id = $id;
        $cart->user_id = user()->id;
        $cart->save();

        $cartCount = CartItem::where('user_id', user()->id)->count();

        return response()->json(['status' => 'success', 'message' => __('Item added to cart'), 'cart_count' => $cartCount], 200);
    }

    function destroy(string $id): JsonResponse
    {
        // dd($id);
        if (CartItem::where('id', $id)->where('user_id', user()->id)->doesntExist()) {
            return response()->json(['status' => 'error', 'message' => __('Item not found in cart')], 400);
        }

        CartItem::where('id', $id)->where('user_id', user()->id)->delete();

        notyf()->info('Item removed from cart.');
        return response()->json(['status' => 'success', 'message' => __('Item removed from cart')], 200);
    }
}
