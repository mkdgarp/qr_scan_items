<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = DB::table('users')
            ->where('username', $username)
            ->first();

        if ($user && Hash::check($password, $user->password && $user->role == 1)) {
            // เมื่อล็อกอินสำเร็จ
            // สร้าง session
            Session::put('user_id', $user->id);

            // Redirect ไปที่หน้า /form
            // return 111;
            return redirect('/form');
        } else {
            // กระบวนการเมื่อล็อกอินไม่สำเร็จ
            // แสดงข้อความผิดพลาดและ redirect ผู้ใช้กลับไปที่หน้า login
            // return 000;
            return response()->json(['msg' => 'error'], 401);
        }
        // return 555;
    }
}
