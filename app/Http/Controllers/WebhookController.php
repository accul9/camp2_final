<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Log the request for testing purposes
        \Log::info('Webhook received:', $request->all());

        // Your webhook handling logic here

        return response()->json(['status' => 'success'], 200);
    }
}
