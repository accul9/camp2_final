<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $payload = $request->getContent();
        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid Payload'], 400);
        }

        // Handle the event
        if ($event->type == 'payment_intent.succeeded') {
            $paymentIntent = $event->data->object; // The Stripe payment intent object
            $this->createOrderFromPaymentIntent($paymentIntent);
        }

        return response()->json(['status' => 'success']);
    }

    protected function createOrderFromPaymentIntent($paymentIntent)
    {
        $userId = $paymentIntent->metadata->user_id; // Ensure you pass the user ID in the metadata when creating the PaymentIntent
        $cartItems = Cart::with(['item', 'set'])->where('user_id', $userId)->get();

        $details = []; // This will store item or set details

        foreach ($cartItems as $cartItem) {
            if ($cartItem->item) {
                $details[] = ['type' => 'item', 'id' => $cartItem->item_id, 'quantity' => $cartItem->quantity];
            } elseif ($cartItem->set) {
                $details[] = ['type' => 'set', 'id' => $cartItem->set_id, 'quantity' => $cartItem->quantity];
            }
        }

        // Create the order
        Order::create([
            'user_id' => $userId,
            'stripe_session_id' => $paymentIntent->id,
            'amount_received' => $paymentIntent->amount_received / 100, // Convert to dollars
            'details' => json_encode($details),
        ]);

        // Optionally, clear the cart
        Cart::where('user_id', $userId)->delete();
    }
}
