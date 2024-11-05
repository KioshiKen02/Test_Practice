<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[SEA] Vanilla - Beginner Trio/Duo Server</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    @yield('styles') {{-- For additional styles specific to certain pages --}}
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-3">Rust Skins</h2>
    @php
        $totalQuantity = 0;
    @endphp
    @if(session('cart'))
        @foreach(session('cart') as $item)
            @php
                $totalQuantity += $item['quantity'];
            @endphp
        @endforeach
    @endif

    <div class="col-12">
        <div class="dropdown">
            <a class="btn btn-outline-dark" href="{{ url('/shopping/cart') }}"> {{-- Fixed the closing parenthesis --}}
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge text-bg-danger" id="cart-quantity">{{ $totalQuantity }}</span>
            </a>
        </div>
    </div>
</div>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @yield('content') {{-- This is where other pages will insert their specific content --}}
</div>

@yield('scripts') {{-- For additional scripts specific to certain pages --}}
</body>
</html>