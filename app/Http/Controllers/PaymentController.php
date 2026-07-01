<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscription;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $gateway;

    public function __construct(PaymentGatewayService $gateway)
    {
        $this->gateway = $gateway;
    }

    public function pay(Request $request)
    {
        $subscription = Subscription::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();

        // Create a pending payment
        $payment = Payment::create([
            'user_id' => auth()->id(),
            'subscription_id' => $subscription->id,
            'amount' => $subscription->package->price, // In reality, calculate taxes/installation
            'transaction_id' => 'TXN_' . uniqid() . Str::random(5),
            'gateway' => 'sslcommerz',
            'status' => 'pending',
        ]);

        // Get redirect URL from service
        $redirectUrl = $this->gateway->initiatePayment($payment);

        return redirect($redirectUrl);
    }

    public function showQuickPay()
    {
        return view('payment.quick-pay');
    }

    public function processQuickPay(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        // Find the user by phone
        $user = \App\Models\User::where('phone', $request->phone)->first();

        if (!$user) {
            return back()->with('error', 'No customer found with this phone number.');
        }

        $subscription = Subscription::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if (!$subscription) {
            return back()->with('error', 'No pending bill found for this number.');
        }

        // Create a pending payment
        $payment = Payment::create([
            'user_id' => $user->id,
            'subscription_id' => $subscription->id,
            'amount' => $subscription->package->price,
            'transaction_id' => 'TXN_' . uniqid() . Str::random(5),
            'gateway' => 'sslcommerz',
            'status' => 'pending',
        ]);

        // Get redirect URL from service
        $redirectUrl = $this->gateway->initiatePayment($payment);

        return redirect($redirectUrl);
    }

    public function mockGateway(Request $request)
    {
        $transaction_id = $request->query('transaction_id');
        $payment = Payment::where('transaction_id', $transaction_id)->firstOrFail();

        return view('payment.mock', compact('payment'));
    }

    public function processMock(Request $request)
    {
        $transaction_id = $request->input('transaction_id');
        $action = $request->input('action'); // success, fail, cancel

        $post_data = [
            'tran_id' => $transaction_id,
            'status' => strtoupper($action),
            'val_id' => 'VAL_' . uniqid(),
            'amount' => $request->input('amount'),
            'store_amount' => $request->input('amount') * 0.98,
            'bank_tran_id' => 'BANK_' . uniqid(),
        ];

        if ($action === 'success') {
            // Trigger IPN locally for testing
            $this->gateway->verifyPayment($post_data);
            return redirect()->route('payment.success')->with('message', 'Payment successful!');
        } elseif ($action === 'fail') {
            return redirect()->route('payment.fail')->with('error', 'Payment failed.');
        } else {
            return redirect()->route('payment.cancel')->with('error', 'Payment cancelled.');
        }
    }

    public function success(Request $request)
    {
        // In real integration, success URL receives POST data, we verify it
        // Since we verify via IPN in this mock, we just show success page.
        return view('payment.status', ['status' => 'success', 'message' => session('message') ?? 'Payment completed successfully.']);
    }

    public function fail(Request $request)
    {
        return view('payment.status', ['status' => 'fail', 'message' => session('error') ?? 'Your payment failed. Please try again.']);
    }

    public function cancel(Request $request)
    {
        return view('payment.status', ['status' => 'cancel', 'message' => session('error') ?? 'You cancelled the payment.']);
    }

    // IPN Endpoint (Called server-to-server by Gateway)
    public function ipn(Request $request)
    {
        $this->gateway->verifyPayment($request->all());
        return response()->json(['message' => 'IPN Processed']);
    }
}
