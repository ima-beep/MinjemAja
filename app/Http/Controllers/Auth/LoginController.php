<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
            'role'     => ['required', 'in:admin,student'],
        ]);

        $credentials = [
            'email'    => $validated['email'],
            'password' => $validated['password'],
            'role'     => $validated['role'],
        ];

        // Cek apakah user dengan email tersebut ada
        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->withInput();
        }

        // Cek password
        if (!Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->withInput();
        }

        // Cek apakah role user cocok dengan role yang dipilih di form
        if ($user->role !== $validated['role']) {
            return back()->withErrors([
                'email' => 'Role tidak sesuai dengan akun Anda. Silakan pilih role yang benar.',
            ])->withInput();
        }

        // Login berhasil
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect berdasarkan ROLE dari DATABASE
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        }

        // Safety kalau role aneh
        Auth::logout();
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nisn'     => ['required', 'string', 'max:20', 'unique:users,nisn'],
            'name'     => ['required', 'string', 'max:255'],
            'kelas'    => ['required', 'in:X,XI,XII'],
            'jurusan'  => ['required', 'in:TSM 1,TSM 2,TSM 3,TKR 1,TKR 2,TKR 3,ATPH 1,ATPH 2,APT 1,APT 2,DKV 1,DKV 2,DKV 3,TKJ 1,TKJ 2,RPL 1,RPL 2'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'nisn.unique' => 'NISN sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.confirmed' => 'Password tidak cocok.',
        ]);

        // Additional server-side rule: DKV 3 only allowed for kelas X
        if (isset($validated['jurusan']) && $validated['jurusan'] === 'DKV 3' && ($validated['kelas'] ?? '') !== 'X') {
            return back()->withErrors(['jurusan' => 'DKV 3 hanya dapat dipilih oleh siswa kelas X'])->withInput();
        }

        // Create user dengan role 'student'
        User::create([
            'nisn'     => $validated['nisn'],
            'name'     => $validated['name'],
            'kelas'    => $validated['kelas'],
            'jurusan'  => $validated['jurusan'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'student',
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login dengan akun Anda.');
    }
}
