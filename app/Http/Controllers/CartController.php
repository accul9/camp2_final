<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id(); // Get the logged-in user's ID
        $cartItems = Cart::with(['item', 'set'])->where('user_id', $userId)->get();

        $totalAmount = 0;

        foreach ($cartItems as $cartItem) {
            if ($cartItem->item) {
                // Calculate total for individual items
                $totalAmount += $cartItem->item->item_price * $cartItem->quantity;
            }

            if ($cartItem->set) {
                // Assuming you have a method to calculate the total price of a set
                // This could be a method in your Set model that sums up the price of all items in the set
                // For simplicity, let's assume each set has a flat price stored in a `price` attribute
                $totalAmount += $cartItem->set->set_price * $cartItem->quantity;
            }
        }

        return view('cart.index', compact('cartItems', 'totalAmount'));
    }


    /**
     * Show the form for creating a new resource.
     */

    public function add(Request $request)
    {
        $userId = Auth::id(); // Get the logged-in user's ID

        if ($request->has('item_id')) {
            // Adding an individual item to the cart
            $itemInCart = Cart::where('user_id', $userId)
                ->where('item_id', $request->item_id)
                ->first();

            if ($itemInCart) {
                $itemInCart->quantity += $request->quantity ?? 1; // Increment existing quantity
                $itemInCart->update();
            } else {
                Cart::create([
                    'user_id' => $userId,
                    'item_id' => $request->item_id,
                    'quantity' => $request->quantity ?? 1,
                    // No 'set_id' since this is an individual item
                ]);
            }
        } elseif ($request->has('set_id')) {
            // Adding an entire set to the cart
            $setInCart = Cart::where('user_id', $userId)
                ->where('set_id', $request->set_id)
                ->first();

            \Log::debug('Request data:', $request->all());



            if ($setInCart) {
                $setInCart->quantity += $request->quantity ?? 1; // Increment existing quantity
                $setInCart->update();
            } else {
                Cart::create([
                    'user_id' => $userId,
                    'set_id' => $request->set_id,
                    'quantity' => $request->quantity ?? 1,
                    // No 'item_id' since this is a set
                ]);
            }
        } else {
            // Handle case where neither item_id nor set_id is provided
            return back()->with('error', 'No item or set specified.');
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function delete(Request $request)
    {
        $userId = Auth::id();
        if ($request->has('item_id')) {
            $itemInCart = Cart::where('user_id', $userId)
                ->where('item_id', $request->item_id)
                ->first();
            if ($itemInCart) {
                $itemInCart->delete();
            } else {
                return back()->with('error', 'Item not found.');
            }
        } elseif ($request->has('set_id')) {
            $setInCart = Cart::where('user_id', $userId)
                ->where('set_id', $request->set_id)
                ->first();
            if ($setInCart) {
                $setInCart->delete();
            } else {
                return back()->with('error', 'Set not found.');
            }
        } else {
            return back()->with('error', 'No item or set specified.');
        }

        return redirect()->route('cart.index')->with('success', 'Item added to cart successfully.');
    }


    public function checkout()
    {
        $userId = Auth::id();
        $cartItems = Cart::with(['item', 'set'])->where('user_id', $userId)->get();

        $lineItems = [];
        foreach ($cartItems as $cartItem) {
            if ($cartItem->item) {
                $lineItem = [
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => $cartItem->item->item_name,
                            'description' => $cartItem->item->item_description,
                        ],
                        'unit_amount' => $cartItem->item->item_price,
                    ],
                    'quantity' => $cartItem->quantity,
                ];
                array_push($lineItems, $lineItem);
            } elseif ($cartItem->set) {
                $lineItem = [
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => $cartItem->set->set_name,
                            'description' => $cartItem->set->set_description,
                        ],
                        'unit_amount' => $cartItem->set->set_price,
                    ],
                    'quantity' => $cartItem->quantity,
                ];
                array_push($lineItems, $lineItem);
            }
        }
        // dd($lineItems);

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('cart.success'),
            'cancel_url' => route('cart.cancel')
        ]);

        $publicKey = env('STRIPE_PUBLIC_KEY');

        return view('cart.checkout', compact('session', 'publicKey'));
    }

    public function success()
    {
        Cart::where('user_id', Auth::id())->delete();
        return view('cart.success')->with('success', 'Payment successful.');
    }

    public function cancel()
    {
        return redirect()->route('cart.index')->with('error', 'Payment cancelled.');
    }


    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // バリデーション
        $request->validate([
            'quantity' => 'required|integer|min:-10|max:10',
        ]);

        // カートからアイテムを取得
        $cartItem = Cart::where('user_id', Auth::id())
            ->where(function ($query) use ($id) {
                $query->where('item_id', $id)
                    ->orWhere('set_id', $id);
            })
            ->first();

        // アイテムが存在しない場合はエラー
        if (!$cartItem) {
            return redirect()->back()->with('error', 'Cart item not found.');
        }

        // 数量を更新
        /*  $cartItem->quantity += $request->quantity;
        $cartItem->quantity = max(0, $cartItem->quantity); // 数量が0未満にならないようにする
        $cartItem->save(); */

        $quantity = $request->input('quantity', 1); // Default to 1 if not provided
        $cartItem->quantity = $quantity;
        $cartItem->save();

        return redirect()->back()->with('success', 'Cart item updated successfully.');
    }


    public function destroy(string $id)
    {
        //
    }
}
