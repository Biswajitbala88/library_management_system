<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel - Razorpay Payment Gateway Integration</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div id="app">
        <main class="py-4">
            <div class="container mx-auto">
                <div class="flex justify-center">
                    <div class="w-full lg:w-1/2">
                        @if($message = Session::get('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Error!</strong>
                                <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @endif

                        @if($message = Session::get('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @endif
                        <div class="bg-white shadow-md rounded-lg p-6 mt-6">
                            <h2 class="text-2xl font-bold mb-6 text-center">Order Summery</h2>
                            <p class="">Order Id: #{{ $order->user_id }}</p>
                            <p class="">Order Date: {{ $order->order_date }}</p>
                            <p class="">Quantity: {{ $order->qty }}</p>
                            
                            <div class="text-center mb-8">
                                <form action="{{ route('razorpay.payment.store') }}" method="POST">
                                    @csrf
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="{{ env('RAZORPAY_API_KEY') }}"
                                    data-amount="{{ $order->total_amt * 100 }}"
                                    data-buttontext=""
                                    data-name="{{ $order->book->name }}"
                                    data-description="{{ $order->book->description }}"
                                    data-image="http://127.0.0.1:8001/storage/{{ $order->user->image }}"
                                    data-prefill.name="{{ $order->user->name }}"
                                    data-prefill.email="{{ $order->user->email }}"
                                    data-theme.color="#ff7529">
                                    </script>
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4" type="submit">Pay {{ $order->total_amt }} INR</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
