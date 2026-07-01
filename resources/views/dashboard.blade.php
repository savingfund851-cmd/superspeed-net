<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Portal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Active Subscription Section -->
            <div class="p-6 bg-white border-b border-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Your Internet Package</h3>
                
                @if($subscription)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                            <div class="text-sm text-blue-600 font-semibold mb-1">CURRENT PLAN</div>
                            <div class="text-2xl font-bold text-blue-900">{{ $subscription->package->name }}</div>
                            <div class="text-blue-700 mt-2">{{ $subscription->package->speed_mbps }} Mbps Dedicated</div>
                            <div class="mt-4 flex items-center gap-4">
                                @if($subscription->status === 'active')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        Status: Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800" style="background-color: #fee2e2; color: #991b1b;">
                                        Status: Unpaid
                                    </span>
                                    <form action="{{ route('payment.pay') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 text-white rounded-md shadow-sm text-sm font-medium transition" style="background-color: #2563eb;">
                                            Pay Now (৳{{ number_format($payableAmount, 2) }})
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex flex-col justify-center">
                            <div class="text-sm text-gray-500 font-medium mb-1">MONTHLY BILLING</div>
                            <div class="text-3xl font-black text-gray-900">
                                ৳{{ number_format($payableAmount, 2) }}
                            </div>
                            
                            @if($subscription->custom_price !== null)
                                <div class="text-sm text-green-600 mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Special discount applied
                                </div>
                                <div class="text-xs text-gray-400 mt-1 line-through">Standard price: ৳{{ number_format($subscription->package->price, 2) }}</div>
                            @else
                                <div class="text-xs text-gray-500 mt-2">Standard package price</div>
                            @endif

                            <div class="text-xs text-gray-400 mt-4">
                                Billing Cycle: {{ $subscription->start_date->format('d M, Y') }} - {{ $subscription->end_date->format('d M, Y') }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-md">
                        You do not have an active subscription yet. Please contact support to activate your package.
                    </div>
                @endif
            </div>

            <!-- Recent Payments Section -->
            <div class="p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Recent Payments</h3>
                
                @if($payments->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gateway</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($payments as $payment)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->created_at->format('d M, Y h:i A') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">৳{{ number_format($payment->amount, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">{{ $payment->gateway ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $payment->transaction_id ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $payment->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-sm">No recent payments found.</p>
                @endif
            </div>
            
        </div>
    </div>
</x-app-layout>
