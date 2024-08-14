<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();

        // Assume you have a method to calculate the total price
        $totalPrice = $this->calculateTotalPrice($cartItems);

        $order = new Order();
        $order->user_id = $userId;
        $order->total = $totalPrice;
        $order->details = $cartItems->toJson(); // Example serialization
        $order->save();

        // Clear the user's cart
        Cart::where('user_id', $userId)->delete();

        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    protected function calculateTotalPrice($cartItems)
    {
        $totalPrice = 0;

        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem->price;
        }

        return $totalPrice;
    }
}
