<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Book') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="bg-blue-100 p-8 my-6">
            <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Book Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Phone -->
                <div class="mt-4">
                    <x-input-label for="category" :value="__('Category')" />
                    <div class="relative">
                        <select class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" name="category">
                            <option value="" selected>Select Category</option>
                            @forelse ($category as $ctg)
                            <option value="{{ $ctg->id }}">{{ $ctg->name }}</option>
                            @empty
                            <option >No data found</option>
                            @endforelse
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="price" :value="__('price')" />
                    <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required  />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
                <!-- Phone -->
                <div class="mt-4">
                    <x-input-label for="qty" :value="__('qty')" />
                    <x-text-input id="qty" class="block mt-1 w-full" type="text" name="qty" :value="old('qty')" required />
                    <x-input-error :messages="$errors->get('qty')" class="mt-2" />
                </div>

                <!-- Phone -->
                <div class="mt-4">
                    <x-input-label for="attachment" :value="__('Photo')" />
                    <x-text-input id="attachment" class="block mt-1 w-full" type="file" name="attachment" :value="old('attachment')" required />
                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea name="description" rows="4" class="w-full"></textarea>

                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>



                <!-- Password -->
                
                <div class="flex items-center justify-end mt-4">
                    
                    <x-primary-button class="ml-4">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

