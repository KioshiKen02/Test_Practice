<?php

namespace App\Http\Controllers;
use App\Models\Shopping; 
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction; 



class DashboardController extends Controller
{

    public function index()
    {
        // Fetch all items from the shoppings table
        $shoppings = Shopping::all();
        return view('dashboard', compact('shoppings'));
    }
    public function showUserDashboard($id)
    {
    $user = User::findOrFail($id);

    return view('admin.users.dashboard', compact('user'));
    }


    public function dashboard()
    {
    $user = auth()->user(); // Get the authenticated user
    // Fetch the user's transactions
    $transactions = Transaction::where('user_id', $user->id)->get(); // Adjust the relationship if necessary

    // Debugging: Check if transactions are being fetched correctly
    if ($transactions->isEmpty()) {
        \Log::info('No transactions found for user: ' . $user->id);
    } else {
        \Log::info('Transactions found for user: ' . $user->id, $transactions->toArray());
    }

    return view('admin.users.dashboard', compact('user', 'transactions'));
}
 
}
