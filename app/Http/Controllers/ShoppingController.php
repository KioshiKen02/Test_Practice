<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shopping;
use App\Models\Transaction; // Ensure you import the Transaction model

class ShoppingController extends Controller
{
    // Fetch all items from the shoppings table
    public function index()
    {
        $shoppings = Shopping::all();
        return view('shopping.index', compact('shoppings')); // Return the shopping view
    }
    
    // View for the shopping cart
    public function shoppingCart()
    {
        return view('shopping.cart');
    }

    // Add shopping item to cart
    public function addShoppingToCart(Request $request)
    {
        $shoppingId = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // Default quantity is 1

        // Retrieve the shopping item by ID
        $shoppingItem = Shopping::find($shoppingId);

        if (!$shoppingItem) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        // Initialize or get the existing cart session
        $cart = session()->get('cart', []);

        // If the item already exists in the cart, update its quantity
        if (isset($cart[$shoppingId])) {
            $cart[$shoppingId]['quantity'] += $quantity;
        } else {
            // Add a new item to the cart session
            $cart[$shoppingId] = [
                'id' => $shoppingItem->id,
                'name' => $shoppingItem->name,
                'price' => $shoppingItem->price,
                'quantity' => $quantity,
                'poster' => $shoppingItem->poster,
            ];
        }

        session()->put('cart', $cart); // Save updated cart to session

        // Calculate total quantity of items in the cart
        $totalQuantity = array_sum(array_column($cart, 'quantity'));

        return response()->json(['message' => 'Cart updated', 'cartCount' => $totalQuantity], 200);
    }
    
    // Delete item from the cart
    public function deleteItem(Request $request)
    {
        $cart = session()->get('cart');

        // Check if the item exists in the cart
        if ($request->id && isset($cart[$request->id])) {
            unset($cart[$request->id]); // Remove item from the cart
            session()->put('cart', $cart); // Update session cart

            return response()->json(['success' => 'Item successfully deleted.'], 200);
        }

        return response()->json(['error' => 'Item not found in cart'], 404);
    }

    // Update item quantity in the cart
    public function updateItem(Request $request)
    {
        $cart = session()->get('cart');

        // Check if the item exists in the cart
        if ($request->id && isset($cart[$request->id])) {
            // Update quantity
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart); // Update session cart

            return response()->json(['success' => 'Item quantity updated.'], 200);
        }

        return response()->json(['error' => 'Item not found in cart'], 404);
    }

    public function checkout(Request $request)
    {
    // Validate the request data as necessary

    // Process the payment here (add your payment logic)

    // Assuming payment is successful:
    
    // Retrieve the cart items from the session
    $cart = session('cart', []);

    // Loop through the cart items and create a transaction record
    foreach ($cart as $id => $item) {
        Transaction::create([
            'user_id' => auth()->id(), // assuming you have a user
            'product_id' => $item['id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            // Add more fields as needed
        ]);
    }

    // Clear the cart
    Session::forget('cart');

    // Return a response (you can return JSON or redirect)
    return response()->json(['success' => true]);
}


}
