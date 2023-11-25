<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Template</title>
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
                <p class="text-gray-600 mt-2">Invoice #INV-12345</p>
            </div>
            <div>
                <p class="text-gray-600">Date: January 1, 2023</p>
                <p class="text-gray-600 mt-2">Due Date: January 15, 2023</p>
            </div>
        </div>

        <div class="border-t border-b border-gray-300 py-4 mb-6">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left py-2">Description</th>
                        <th class="text-left py-2">Quantity</th>
                        <th class="text-left py-2">Price</th>
                        <th class="text-left py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2">Product 1</td>
                        <td class="py-2">2</td>
                        <td class="py-2">$50.00</td>
                        <td class="py-2">$100.00</td>
                    </tr>
                    <tr>
                        <td class="py-2">Product 2</td>
                        <td class="py-2">1</td>
                        <td class="py-2">$80.00</td>
                        <td class="py-2">$80.00</td>
                    </tr>
                    <!-- Add more rows for other products or services -->
                </tbody>
            </table>
        </div>

        <div class="flex justify-end">
            <div class="text-right">
                <p class="text-gray-600">Subtotal: $180.00</p>
                <p class="text-gray-600 mt-2">Tax (10%): $18.00</p>
                <p class="text-2xl font-bold mt-4">Total: $198.00</p>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-lg font-semibold">Payment Details</h2>
            <p class="text-gray-600 mt-2">Payment method: Credit Card</p>
            <p class="text-gray-600 mt-2">Card ending: XXXX XXXX XXXX 1234</p>
        </div>

        <div class="mt-8">
            <h2 class="text-lg font-semibold">Billing Information</h2>
            <p class="text-gray-600 mt-2">John Doe</p>
            <p class="text-gray-600">123 Main Street</p>
            <p class="text-gray-600">City, State, ZIP</p>
            <p class="text-gray-600">Country</p>
        </div>
    </div>
</body>

</html>
