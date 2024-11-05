<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('RUST [SEA] BIGINNER TRIO/DOU SERVER') }}</title>

    <!-- Fonts -->
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMm7e0g5x8QZjlz6KT9g/f1mtG3zO9w8tD0m5JZ" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- <link href="{{ asset('sass/app.scss') }}" rel="stylesheet"> -->
    
    
    <!-- Scripts -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <!-- Include jQuery in your layout file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
        

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
           
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            console.log('Alpine.js is initialized!');
        });
    </script>
</body>
</html>
