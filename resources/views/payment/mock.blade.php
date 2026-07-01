<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSLCommerz Payment Simulation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md overflow-hidden border border-gray-100">
        <div class="bg-gray-900 p-6 text-center">
            <h2 class="text-white text-xl font-bold">Secure Payment Gateway</h2>
            <p class="text-gray-400 text-sm mt-1">TEST ENVIRONMENT (SANDBOX)</p>
        </div>
        
        <div class="p-6">
            <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-100">
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-500">Merchant</span>
                    <span class="font-medium text-gray-900">SuperSpeed Net</span>
                </div>
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-500">Transaction ID</span>
                    <span class="font-mono text-xs text-gray-700 bg-gray-200 px-1 rounded">{{ $payment->transaction_id }}</span>
                </div>
                <div class="flex justify-between text-sm font-bold border-t pt-2 mt-2">
                    <span class="text-gray-700">Total Amount</span>
                    <span class="text-blue-600">৳{{ number_format($payment->amount, 2) }}</span>
                </div>
            </div>

            <form action="{{ route('payment.mock.process') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="transaction_id" value="{{ $payment->transaction_id }}">
                <input type="hidden" name="amount" value="{{ $payment->amount }}">
                
                <p class="text-sm text-gray-600 mb-4 text-center">Please select a simulation outcome to proceed:</p>
                
                <button type="submit" name="action" value="success" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition shadow-sm">
                    Simulate Successful Payment
                </button>
                
                <button type="submit" name="action" value="fail" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-4 rounded-lg transition shadow-sm">
                    Simulate Failed Payment
                </button>
                
                <button type="submit" name="action" value="cancel" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-lg transition shadow-sm">
                    Cancel & Return to Merchant
                </button>
            </form>
        </div>
        <div class="bg-gray-50 p-4 text-center border-t border-gray-100">
            <p class="text-xs text-gray-400">This is a mock interface for testing purposes only. No real transactions are processed.</p>
        </div>
    </div>
</body>
</html>
