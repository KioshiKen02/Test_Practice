<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h1 class="text-xl text-black font-bold mb-4">Transaction Status</h1>

                    @if(session('success'))
                        <div class="alert alert-success mb-4 p-4 bg-green-100 text-green-800 rounded border border-green-300">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Transaction Table -->
                    <table class="min-w-full divide-y divide-gray-200 text-black mb-6">
                        <thead class="bg-gray-50 text-black">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Date</th>
                                @if(auth()->user()->isAdmin())
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if($transactions->isEmpty())
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-red text-sm">No transactions found.</td>
                                </tr>
                            @else
                                @foreach($transactions as $transaction)
                                    <tr class="hover:bg-gray-100 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-black text-sm">{{ $transaction->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-black text-sm">{{ $transaction->total }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-black text-sm">{{ $transaction->status }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-black text-sm">{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                                        @if(auth()->user()->isAdmin())
                                            <td class="px-6 py-4 whitespace-nowrap text-black text-sm">
                                                @if($transaction->status === 'pending')
                                                    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="text-green-600 hover:text-green-800">Mark as Completed</button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <p class="text-gray-600 text-sm">*Please wait for the transaction to be completed.</p>
                </div>
            </div>

            <!-- Transaction Details Section -->
            <div class="p-6 bg-gray-50 shadow sm:rounded-lg mt-6">
                <h2 class="text-xl text-black font-semibold mb-4">Transaction History</h2>
                @if(isset($transaction))
                    <p><strong>ID:</strong> {{ $transaction->id }}</p>
                    <p><strong>Total:</strong> {{ $transaction->total }}</p>
                    <p><strong>Status:</strong> {{ $transaction->status }}</p>
                    <p><strong>Created At:</strong> {{ $transaction->created_at->format('Y-m-d H:i') }}</p>
                    <p><strong>Updated At:</strong> {{ $transaction->updated_at->format('Y-m-d H:i') }}</p>
                    <a href="{{ route('transactions.index') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Back to Transactions
                    </a>
                @else
                    <p class="text-red-500">No transaction details available.</p>
                @endif
            </div>
        </div>
    </div>
</div>
