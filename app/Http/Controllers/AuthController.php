<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;
use Illuminate\support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('dashboard');
        }
        // return view('auth.login');
        return view('auth.login');
    }

    public function register()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function registration(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'userName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            // 'mobileNo' => 'required|digits:10',
            'password' => 'required|string|min:4',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $admin = new Admin();
        $admin->name = $request->userName;
        $admin->email = $request->email;
        $admin->role = "superAdmin";
        // $admin->mobileNo = $request->mobileNo;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('dashboard')->with('success', 'Registration successful');

    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->passes()) {

            if (
                Auth::guard('admin')->attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                ], $request->get('remember'))
            ) {
                $admin = Auth::guard('admin')->user();
                // if ($admin->userType == 'Admin') {
                return redirect()->route('dashboard')->with('success', 'Login successful');
                // } else {
                //     Auth::guard('admin')->logout();
                //     return redirect()->route('login')->with('error', 'You are not authorize to access admin panal');
                // }
            } else {
                return redirect()->route('login')->with('error', 'Either Email/Password is incorrect');
            }
        } else {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }


    public function logout(Request $request)
    {
        $sessionId = $request->session()->getId();
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        DB::table('sessions')->where('id', $sessionId)->delete();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
