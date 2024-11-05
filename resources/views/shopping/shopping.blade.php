@extends('shopping.main')

@section('content')
<div class="row">
    @if($shoppings->isEmpty())
        <p>No items available.</p>
    @else
        @foreach($shoppings as $item)
            <div class="col-md-3 col-6 mb-4 d-flex">
                <div class="card flex-fill">
                    <img src="{{ $item->poster }}" alt="{{ $item->name }}" class="card-img-top">
                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title">{{ $item->name }}</h4>
                        <p>{{ $item->director }}</p>
                        <p class="card-text"><strong>Price: ₱{{ number_format($item->price, 2) }}</strong></p>
                        <input type="hidden" class="product-quantity" value="1">
                        <p class="btn-holder mt-auto">
                            <button class="btn btn-outline-danger add-to-cart" data-product-id="{{ $item->id }}">
                                <i class="fas fa-shopping-cart"></i> <!-- Cart icon -->
                                Add to cart
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(".add-to-cart").click(function (e) {
        e.preventDefault();

        var productId = $(this).data("product-id");
        var productQuantity = $(this).siblings(".product-quantity").val();

        $.ajax({
            url: '{{ route('shopping.add_to_cart') }}',
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: productQuantity
            },
            success: function (response) {
                $('#cart-quantity').text(response.cartCount);
                alert('Cart Updated');
                console.log(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('Failed to add to cart. Please try again.');
            }
        });
    });
</script>
@endsection
