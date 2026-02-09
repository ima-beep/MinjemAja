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

        // Jika admin (sebelumnya: guru), arahkan ke admin dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Jika siswa, arahkan ke siswa dashboard
        return view('dashboard.index');
    }
}
