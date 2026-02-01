<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * DASHBOARD
     * - HANYA BISA DIAKSES SETELAH LOGIN
     * - REDIRECT KE DASHBOARD YANG SESUAI BERDASARKAN ROLE
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Jika guru, arahkan ke teacher dashboard
        if ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        }

        // Jika siswa, arahkan ke siswa dashboard
        return view('dashboard.index');
    }
}
