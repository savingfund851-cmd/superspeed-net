<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerPortalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Load latest subscription (active or pending) with package relationship
        $subscription = $user->subscriptions()->with('package')->latest()->first();
        
        $payableAmount = null;
        if ($subscription) {
            // Core billing hierarchy from master plan
            $payableAmount = $subscription->payable_amount;
        }

        // Fetch recent payments
        $payments = $user->payments()->latest()->take(5)->get();
        
        return view('dashboard', compact('user', 'subscription', 'payableAmount', 'payments'));
    }
}
