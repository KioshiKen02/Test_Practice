<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $header = 'User Dashboard Transactions'; // Set your header value
        $transactions = Auth::user()->transactions; // Fetch user transactions
    
        return view('user-dashboard-transaction', compact('header', 'transactions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'status' => 'required|string|in:pending,completed,failed', // Validate status to be one of the allowed values
        ]);

        // Create a new transaction record
        Transaction::create([
            'user_id' => auth()->id(),
            'amount' => $validated['amount'],
            'status' => 'pending', // Set default status to 'pending'
        ]);

        return redirect()->back()->with('success', 'Transaction added successfully.');
    }

    public function update(Request $request, Transaction $transaction)
    {
        // Ensure only admins can update the status
        if (!Auth::user()->isAdmin()) {
            return redirect()->back()->with('error', 'You do not have permission to update this transaction.');
        }

        $validated = $request->validate([
            'status' => 'required|string|in:completed', // Only allow setting status to completed
        ]);

        // Update the transaction status
        $transaction->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Transaction marked as completed successfully.');
    }

    public function transactions()
    {
        $transactions = Transaction::where('user_id', auth()->id())->get();
        return view('transactions.index', compact('transactions'));
    }

}
