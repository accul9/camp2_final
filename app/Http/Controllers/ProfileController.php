<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email',
            'user_postcode' => 'required',
            'user_address' => 'required',
            'user_phone' => 'required',
        ]);

        $user = Auth::user();
        $user->last_name = $request->last_name;
        $user->first_name = $request->first_name;
        $user->email = $request->email;
        $user->user_postcode = $request->user_postcode;
        $user->user_address = $request->user_address;
        $user->user_phone = $request->user_phone;

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->route('profile.show');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show(Request $request)
    {
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }

    public function purchaseHistory()
    {
        $userId = Auth::id();

        // Assuming you have an Order model that represents the purchases
        $purchases = Order::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        return view('profile.purchases', compact('purchases'));
    }
}
