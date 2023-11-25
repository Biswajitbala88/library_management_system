<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="container mx-auto py-8">
                <p class="mb-4 d-flex">Orders</p>
                <div class="w-full overflow-auto">
                    <table class="w-full bg-white whitespace-nowrap">
                        <thead>
                            <tr>
                                <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Order Date</th>
                                <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Order Type</th>
                                <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Invoice No</th>
                                <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Invoice Date</th>
                                <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Total Amount</th>
                                <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Payment Mode</th>
                                <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Payment Status</th>
                                <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Transaction Id</th>
                                <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Address</th>
                                <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @php
                                dd($orders)
                            @endphp --}}
                            @forelse ($orders as $order)
                            <tr class="whitespace-nowrap">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                                    <img src="{{ asset('storage/' . $order->book->image1) }}" width="50" />
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $order->book->name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $order->qty }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $order->order_date }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $order->order_type }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 text-red-500">{{ $order->status }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $order->invoice_no }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $order->inv_date }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $order->total_amt }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $order->payment_mode }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $order->payment_status }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $order->transaction_id }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $order->address }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 ">
                                    
                                    @if ($order->status != 'Cancel')
                                        @if (($order->status == 'Delivered') && ($order->payment_status == 'Paid'))
                                            <a href="{{ route('invoice.show', ['order' => $order->id]) }}" class="bg-yellow-500 hover:bg-yellow-700 text-dark font-bold py-2 px-4 rounded ml-2" target="_blank">
                                                Invoice
                                            </a>
                                        @else
                                            <a href="{{ route('order.edit', ['order' => $order->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                                                Update
                                            </a>
                                            <form method="POST" action="{{ route('order.cancelOrder', $order->id) }}" class="inline-block">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" value="cancel" name="status">

                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</button>
                                            </form> 
                                            @if ($order->payment_status == 'Unpaid')
                                                <a href="{{ route('order.edit', ['order' => $order->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2">
                                                    Pay
                                                </a>
                                            @endif
                                        @endif
                                        
                                    @else
                                        <button class="bg-gray-400 text-white font-bold py-2 px-4 rounded ml-2" disabled>Canceled</button>
                                    @endif
                                    
                                </td>
                            </tr> 
                            @empty
                            <tr class="whitespace-nowrap">
                                <td colspan="14">
                                    <p class="text-red-500 text-center p-2">No data found</p>
                                </td>
                            </tr>
                            @endforelse
                            
                            <!-- Repeat the above row for each table row -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
