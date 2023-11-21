<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        /* Add your CSS styles for the invoice here */
        /* For example: */
        .invoice {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            font-family: Arial, sans-serif;
        }
        /* Other styles... */
    </style>
</head>
<body>
    <div class="invoice">
        <h1>Invoice</h1>
        <div class="details">
            <p>Invoice Number: {{ $invoiceNumber }}</p>
            <p>Date: {{ $invoiceDate }}</p>
            <!-- Add other invoice details here -->
        </div>
        <table class="items">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item['description'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['price'] }}</td>
                        <td>{{ $item['quantity'] * $item['price'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total">
            <p>Total Amount: ${{ $totalAmount }}</p>
        </div>
    </div>
</body>
</html>
