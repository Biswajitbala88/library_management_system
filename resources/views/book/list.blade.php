<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="container mx-auto py-8">
                <p class="mb-4 d-flex">Books
                    @if(auth()->check() && (auth()->user()->user_type === 'admin') || (auth()->user()->user_type === 'employee'))
                        <x-nav-link :href="route('book.create')" :active="request()->routeIs('category')" style="margin-left: auto; float: right;">
                            {{ __('Add Book') }}
                        </x-nav-link>            
                    @endif
                </p>
                <table class="w-full bg-white">
                    <thead>
                        <tr>
                            <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Category</th>
                            @if(auth()->check() && (auth()->user()->user_type === 'admin') || (auth()->user()->user_type === 'employee'))
                                <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Quantity</th>
                            @endif
                            
                            <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                                <img src="{{ asset('storage/' . $book->image1) }}" width="50" />
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $book->name }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $book->category->name }}</td>
                            @if(auth()->check() && (auth()->user()->user_type === 'admin') || (auth()->user()->user_type === 'employee'))
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $book->qty }}</td>
                            @endif
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">Rs {{ round($book->price, 2) }}</td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                                <a href="{{ route('book.show', ['book' => $book->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    View
                                </a>
                                @if(auth()->check() && (auth()->user()->user_type === 'admin') || (auth()->user()->user_type === 'employee'))
                                    <a href="{{ route('book.edit', ['book' => $book->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('book.destroy', $book->id) }}" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Delete</button>
                                    </form>
                                @endif
                                
                            </td>
                        </tr> 
                        @empty
                            <tr>
                                <td colspan="3">
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
</x-app-layout>
