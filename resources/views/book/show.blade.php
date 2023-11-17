<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="container mx-auto py-8">
                <p class="mb-4 d-flex">Book
                    <x-nav-link :href="route('book.index')" :active="request()->routeIs('category')" style="margin-left: auto; float: right;">
                        {{ __('Back') }}
                    </x-nav-link>
                </p>
                <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow-md">
                    <h1 class="text-3xl font-bold mb-4">{{ $book->name }}</h1>
                    
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <p class="mb-4 ">Category: <span class="text-red-500">{{ $book->category->name }}</span></p>
                        <p class="mb-4 ">Price: <span class="text-red-500">Rs {{ round($book->price, 2) }}</span></p>
                        @if(auth()->check() && (auth()->user()->user_type === 'admin') || (auth()->user()->user_type === 'employee'))
                            <p class="mb-4 ">Quantity: <span class="text-red-500">{{ $book->qty }}</span></p>
                        @endif
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <img src="{{ asset('storage/' . $book->image1) }}" alt="Blog Image 1" class="rounded-md">
                        <img src="{{ asset('storage/' . $book->image2) }}" alt="Blog Image 2" class="rounded-md">
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-5">
                        {{ $book->description }}
                    </p>
                    <a href="" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Buy
                    </a>
                    <a href="" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Rent
                    </a>
                    <a href="https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf" target="_blank" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Read Book
                    </a>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
