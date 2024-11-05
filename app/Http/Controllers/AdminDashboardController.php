<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard with the list of users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all users, ordering by creation date
        $users = User::orderBy('created_at', 'desc')->get();

        // Return the admin dashboard view with the users data
        return view('admin-dashboard', compact('users'));
    }

    /**
     * Show the edit form for a specific user.
     *
     * @param  User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            // Add any other fields you want to validate
        ]);

        // Update the user
        $user->update($request->all());

        // Redirect back to the users index with a success message
        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
    }

    /**
     * Show the user's dashboard.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function showUserDashboard(User $user)
    {
        // Here you can load additional user data if needed
        return view('admin.users.dashboard', compact('user'));
    }
}
