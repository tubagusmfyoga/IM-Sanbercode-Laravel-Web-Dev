<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function formregister()
    {
        return view('auth.register');
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required',
                            'string',
                            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                            'confirmed'
                            ]
        ], [
            'name.required' => 'Nama perlu diisi.',
            'name.string' => 'Nama harus berupa huruf.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email perlu diisi.',
            'email.email' => 'Mohon masukkan email yang valid.',
            'email.unique' => 'Email ini sudah digunakan.',
            'password.required' => 'Kata sandi perlu diisi.',
            'password.string' => 'Kata sandi harus berupa string.',
            'password.regex' => 'Kata sandi harus mengandung setidaknya satu huruf besar, satu huruf kecil, satu angka, dan satu karakter khusus.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $userCount = user::count();
        if ($userCount == 0) {
            $roleData = 'admin';
        } else {
            $roleData = 'staff';
        }

        user::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $roleData
        ]);
        return redirect('/login')->with('success', 'Registrasi Berhasil. Silahkan login.');
    }

    public function formlogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/']
        ], [
            'email.required' => 'Email perlu diisi.',
            'email.email' => 'Mohon masukkan email yang valid.',
            'password.required' => 'Kata sandi perlu diisi.',
            'password.regex' => 'Kata sandi harus mengandung setidaknya satu huruf besar, satu huruf kecil, satu angka, dan satu karakter khusus.'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Anda telah berhasil Logut.');
    }
}