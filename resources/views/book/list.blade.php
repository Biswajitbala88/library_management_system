<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="container mx-auto py-8">
                <table class="w-full bg-white">
                    <thead>
                        <tr>
                            <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-2 border-b-2 border-gray-300 text-left text-sm leading-4 text-gray-600 uppercase tracking-wider">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">1</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">John Doe</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">johndoe@example.com</td>
                        </tr>
                        <!-- Repeat the above row for each table row -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
