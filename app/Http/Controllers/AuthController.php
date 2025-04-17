<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('name', 'password'))) {
            return redirect('/')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['name' => 'Tên đăng nhập hoặc mật khẩu không đúng'])->withInput();
    }


    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9]+$/',
                'unique:users,name', // kiểm tra trùng tên đăng nhập
            ],
            'password' => 'required|confirmed|min:8',
        ], [
            'name.required' => 'Tên đăng nhập là bắt buộc.',
            'name.regex' => 'Tên đăng nhập chỉ được phép sử dụng chữ cái và số, không dấu và không có khoảng trắng.',
            'name.unique' => 'Tên đăng nhập đã tồn tại.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect('/')->with('success', 'Đăng ký thành công!');
    }


    

    // Đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

