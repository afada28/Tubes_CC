<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with('activeSubscription')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with('subscriptions')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function toggleAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = !$user->is_admin;
        $user->save();

        return redirect()->back()->with('success', 'Status admin berhasil diubah.');
    }
}
