<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Updated</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
</head>
<body class="font-sans antialiased">
    <div class="max-w-2xl mx-auto px-4">
        <p class="text-lg font-semibold mb-4">Order Status Updated #{{ $order->id }}</p>
        <p class="mb-2">Hello,</p>
        <p class="mb-4">Your order status has been updated. Here are the details:</p>
        <!-- Include order details using Blade directives -->
        <p class="mb-4"><strong>Order Item:</strong> {{ $order->book->name }}</p>
        <p class="mb-4"><strong>Order Date:</strong> {{ $order->order_date }}</p>
        <p class="mb-4"><strong>Status:</strong> {{ $order->status }}</p>
        <p class="mb-4"><strong>Total Amount:</strong> ${{ $order->total_amt }}</p>

        @if(!empty($order->invoice_no))
            <a href="http://127.0.0.1:8000/invoice/show/{{ $order->id }}" target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block">Download Invoice</a>
        @endif
        <!-- Additional content and styling as needed -->
    </div>
</body>
</html>
