<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order a Book') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="bg-blue-100 p-8 my-6">
            <form method="POST" action="{{ route('order.store', $book) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $book->id }}" name="book_id">
                <input type="hidden" value="{{ date('Y-m-d') }}" name="order_date">
                <input type="hidden" value="pending" name="status">
                <input type="hidden" value="{{ 'INV-' . date('dy') . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT) }}" name="invoice_no">
                <input type="hidden" value="{{ date('Y-m-d') }}" name="inv_date">

                <div class="mt-4">
                    <x-input-label for="qty" :value="__('Order Type')" />
                    <div class="relative">
                        <select class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" name="order_type">
                            <option value="" selected>Select Type</option>
                            <option value="1">Buy</option>
                            <option value="2">Rent</option>
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('qty')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="qty" :value="__('Quantity')" />
                    <x-text-input id="qty" class="block mt-1 w-full" type="number" name="qty" value="" min="1" />
                    <x-input-error :messages="$errors->get('qty')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="address" :value="__('Address')" />
                    <textarea name="address" rows="4" class="w-full"></textarea>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <input type="hidden" name="total_amt" id="hiddenTotalAmount" value="{{ $book->price * $book->qty }}">

                <p class="">Total Amount: <span id="totalAmount" class="text-red-500">0.00</span></p>


                <div class="flex items-center justify-end mt-4">
                    
                    <x-primary-button class="ml-4">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const qtyInput = document.getElementById('qty');
        const totalAmount = document.getElementById('totalAmount');
        const hiddenTotalAmount = document.getElementById('hiddenTotalAmount');
        const bookPrice = {{ $book->price }}; // Assuming $book->price is the price of the book

        // Function to update the total amount and hidden input
        function updateTotalAmount() {
            const quantity = qtyInput.value ? parseInt(qtyInput.value) : 0;
            const calculatedTotal = bookPrice * quantity;
            totalAmount.textContent = calculatedTotal.toFixed(2);
            hiddenTotalAmount.value = calculatedTotal.toFixed(2);
        }

        // Event listener for input change
        qtyInput.addEventListener('input', updateTotalAmount);
    });
    </script>
</x-app-layout>

