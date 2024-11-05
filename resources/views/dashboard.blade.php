<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('WELCOME TO RUST [SEA] BEGINNERS VANILLA-DUO/TRIO SERVER') }}
        </h2>
    </x-slot>
        
    <div class="container mt-5">
        {{-- Include the shopping items here --}}
        @include('shopping.shopping')
        
        <div class="row mt-4">
            <!--<h3>Dashboard Content</h3>-->
            {{-- You can place additional dashboard content here --}}
        </div>
    </div>

    @section('content')
        {{-- Additional content can be included here if needed --}}
    @endsection
</x-app-layout>
