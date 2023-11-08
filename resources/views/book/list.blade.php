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
                    <x-nav-link :href="route('book.create')" :active="request()->routeIs('category')" style="margin-left: auto; float: right;">
                        {{ __('Add Book') }}
                    </x-nav-link>
                </p>
                <table class="w-full bg-white">
                    <thead>
                        <tr>
                            <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $book->name }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $book->category->name }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                                <a href="{{ route('book.edit', ['book' => $book->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('book.destroy', $book->id) }}" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Delete</button>
                                </form>
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
