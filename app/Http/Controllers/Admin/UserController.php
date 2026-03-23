<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
     public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
            'status' => 'active',
        ]);

        return back()->with('success', 'Staff created successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deletion of admin accounts
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Cannot delete admin accounts.');
        }
        
        $user->delete();
        
        return back()->with('success', 'Staff deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $user = User::find($id);
        $user->status = $user->status == 'active' ? 'inactive' : 'active';
        $user->save();

        return back();
    }
}
