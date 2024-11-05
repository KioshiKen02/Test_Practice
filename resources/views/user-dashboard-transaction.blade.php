<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-black text-gray-800 leading-tight">
            {{ __('Transaction Informations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('transactions.index')   {{-- Include the transaction details --}}
                </div>
            </div>
            
            <div class="row mt-4">
                {{-- You can place additional dashboard content here --}}
            </div>
        </div>
    </div>
</x-app-layout>
