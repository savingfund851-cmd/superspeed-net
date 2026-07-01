<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentGatewayService
{
    /**
     * Simulate initiating a payment and returning a gateway URL.
     */
    public function initiatePayment(Payment $payment)
    {
        // In a real integration, we would build the payload and POST to the gateway
        // For SSLCommerz: 
        // $post_data = array();
        // $post_data['store_id'] = env('PAYMENT_STORE_ID');
        // $post_data['store_passwd'] = env('PAYMENT_STORE_PASSWORD');
        // $post_data['total_amount'] = $payment->amount;
        // $post_data['currency'] = "BDT";
        // $post_data['tran_id'] = $payment->transaction_id;
        // $post_data['success_url'] = route('payment.success');
        // $post_data['fail_url'] = route('payment.fail');
        // $post_data['cancel_url'] = route('payment.cancel');
        // $post_data['cus_name'] = $payment->user->name;
        // $post_data['cus_email'] = $payment->user->email;
        // ... call curl and get redirect URL

        // Mocked response: return a simulated gateway URL
        return route('payment.mock.gateway', ['transaction_id' => $payment->transaction_id]);
    }

    /**
     * Simulate IPN verification
     */
    public function verifyPayment($post_data)
    {
        // In a real integration, verify via gateway API using the trans_id or validation_id
        
        $transaction_id = $post_data['tran_id'] ?? null;
        if (!$transaction_id) {
            return false;
        }

        $payment = Payment::where('transaction_id', $transaction_id)->first();
        if (!$payment) {
            return false;
        }

        // Only process if it is pending
        if ($payment->status == 'pending') {
            $payment->update([
                'status' => 'completed',
                'gateway_response' => json_encode($post_data)
            ]);

            // Activate subscription
            $payment->subscription->update([
                'status' => 'active',
                'start_date' => now(),
                'end_date' => now()->addMonth(),
            ]);

            return true;
        }

        return false;
    }
}
