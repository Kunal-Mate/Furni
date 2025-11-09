<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::guard("admin")->user();
        $currentSessionId = session()->getId();
        $sessions = DB::table('sessions')
            ->where('user_id', Auth::guard('admin')->id())
            ->get();

        return view('userProfile', compact('user', 'sessions', 'currentSessionId'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::guard('admin')->id(),
        ]);
        $user = Auth::guard('admin')->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
    // ✅ Route: PUT /profile/password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
        $user = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }


    public function destroySession($id, Request $request)
    {
        DB::table('sessions')
            ->where('id', $id)
            ->where('user_id', Auth::guard('admin')->id())
            ->delete();

        return redirect()->route('profile')->with('success', 'Session logged out successfully.');
    }
}
