<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // public function showLoginForm()
    // {
    //     return view('login');
    // }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = DB::table('users')
            ->where('username', $username)
            ->first();

        if ($user && Hash::check($password, $user->password) && $user->role == 1) {
            // Authentication was successful...
            // Auth::loginUsingId($user->id);
            return redirect('/form'); // Redirect to home page
        }

        return redirect()->back()->withErrors(['loginError' => 'Invalid username, password, or role.']); // Redirect back with error message
    }
}
