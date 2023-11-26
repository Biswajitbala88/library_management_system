<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $order->invoice_no }}</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Optional custom styles can be added here */
    </style>
</head>

<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto p-8 bg-white shadow">
        <div class="flex justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold">Invoice</h1>
                <p class="text-gray-600 mt-2">Invoice #{{ $order->invoice_no }}</p>
            </div>
            <div>
                <p class="text-gray-600">Date: {{ $order->inv_date }}</p>
            </div>
        </div>

        <div class="border-t border-b border-gray-300 py-4 mb-6">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left py-2">Book</th>
                        <th class="text-left py-2">Quantity</th>
                        <th class="text-left py-2">Price</th>
                        <th class="text-left py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2">{{ $order->book->name }}</td>
                        <td class="py-2">{{ $order->qty }}</td>
                        <td class="py-2">${{ $order->book->price }}</td>
                        <td class="py-2">${{ $order->total_amt }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex justify-end">
            <div class="text-right">
                <p class="text-gray-600">Subtotal: ${{ $order->total_amt }}</p>
                @php
                    $gstAmt = $order->total_amt * 0.1;
                    $totalAmt = $order->total_amt + $gstAmt;
                @endphp
                <p class="text-gray-600 mt-2">Tax (10%): ${{ $gstAmt }}</p>
                <p class="text-2xl font-bold mt-4">Total: ${{ $totalAmt }}</p>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-lg font-semibold">Payment Details</h2>
            <p class="text-gray-600 mt-2">Payment method: {{ $order->payment_mode }}</p>
            <p class="text-gray-600 mt-2">Payment Status: <span class="text-xl font-bold">{{ $order->payment_status == 'paid' ? 'Paid' : 'Not Paid' }}</span></p>
            <p class="text-gray-600 mt-2">TRANSACTION ID: {{ $order->transaction_id }}</p>
        </div>

        <div class="mt-8">
            <h2 class="text-lg font-semibold">Billing Information</h2>
            <p class="text-gray-600 mt-2">{{ $order->user->name }}</p>
            <p class="text-gray-600">{{ $order->user->email }}</p>
            <p class="text-gray-600">{{ $order->user->phone }}</p>
            <p class="text-gray-600">{{ $order->address }}</p>
        </div>
    </div>
</body>

</html>
