@extends('shopping.main')

@section('content')
<table id="cart" class="table table-bordered">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $item)
                <tr rowId="{{ $id }}">
                    <td data-th="Product Name">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                <img src="{{ asset($item['poster']) }}" alt="{{ $item['name'] }}" class="img-fluid" />
                            </div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $item['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price" class="text-center">₱{{ number_format($item['price'], 2) }}</td>
                    <td data-th="Quantity" class="text-center"> 
                         <div class="d-flex justify-content-center align-items-center">
                            <input type="number" style="width: 80px;" value="{{ $item['quantity'] }}" min="1" class="form-control quantity me-2" />
                            <button class="btn btn-outline-success btn-sm update-item" data-id="{{ $id }}">Update</button>
                        </div>
                    </td>
                    <td data-th="Total" class="text-center">₱{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    <td class="actions">
                        <div class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-outline-danger btn-sm delete-item">Delete</button>
                    </td>
                </tr>
                @php $total += $item['price'] * $item['quantity']; @endphp
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" class="text-right">
                <h4><strong>Total:₱{{ number_format($total, 2) }}</strong></h4>
                <a href="{{ url('/dashboard') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <button id="checkout-button" class="btn btn-danger">Checkout</button>
                <div id="loading-spinner" class="spinner-border text-light" role="status" style="display: none;">
                        <span class="visually-hidden">Loading...</span>
                    </div>

            </td>
        </tr>
    </tfoot>
</table>
@endsection

@section('scripts')
<script type="text/javascript">
    $(".update-item").click(function (e) {
    e.preventDefault();

    var itemId = $(this).data("id");
    var quantity = $(this).siblings(".quantity").val();

    $.ajax({
        url: '{{ route('shopping.update') }}',
        method: "POST",
        data: {
            _token: '{{ csrf_token() }}',
            id: itemId,
            quantity: quantity
        },
        success: function (response) {
            window.location.reload(); // Refresh the cart to show updated values
        },
        error: function (xhr, status, error) {
            alert('Failed to update item quantity. Please try again.');
        }
    });
});

    $(".delete-item").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if (confirm("Do you really want to delete this item?")) {
            $.ajax({
                url: '{{ route('shopping.delete') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("rowId")
                },
                success: function (response) {
                    window.location.reload(); // Refresh the cart
                },
                error: function (xhr, status, error) {
                    alert('Failed to delete item. Please try again.');
                }
            });
        }
    });

    $("#checkout-button").click(function (e) {
    e.preventDefault();

    // Show loading spinner and disable the button
    $("#loading-spinner").show();
    $(this).prop('disabled', true).text('Processing...');

    // Calculate the total amount from the cart for the checkout
    let calculatedTotal = {{ $total }}; // Assuming you have a way to pass this value to your script

    // Make the AJAX call for checkout
    $.ajax({
    url: '{{ route('shopping.checkout') }}', // Use your checkout route
    method: "POST",
    data: {
        _token: '{{ csrf_token() }}', // Include CSRF token for security
        total: calculatedTotal, // Added a comma here
        shopping_id: shoppingId 
    },
    success: function (response) {
        // Hide spinner and reset button text
        $("#loading-spinner").hide();
        $("#checkout-button").prop('disabled', false).text('Checkout');

        if (response.success) {
            alert('Transaction successfully processed! The Skin will be added to your Stem Account immediately.');

            // Clear the cart items from the view
            $("#cart tbody").html('<tr><td colspan="5" class="text-center">Your cart is empty.</td></tr>');
            $("tfoot h4 strong").text("Total:₱0.00"); // Reset the total

            // Redirect to the dashboard
            window.location.href = '{{ url('/dashboard') }}'; // Redirect to dashboard
        } else {
            alert('Checkout failed: ' + response.message);
        }
    },
    error: function (xhr, status, error) {
        console.error(xhr.responseText);
        alert('An error occurred while processing the checkout. Please try again.');

        // Hide spinner and reset button text in case of error
        $("#loading-spinner").hide();
        $("#checkout-button").prop('disabled', false).text('Checkout');
    }
});
});

</script>
@endsection
