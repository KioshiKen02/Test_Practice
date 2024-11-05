<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Http\Controllers\Controller; // Import the Controller class
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all(); // Get all transactions
        return view('admin.transactions.index', compact('transactions'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required|string|in:pending,complete', // Validate status
        ]);

        $transaction->status = $request->status;
        $transaction->save();

        return redirect()->back()->with('success', 'Transaction updated successfully!');
    }
}
