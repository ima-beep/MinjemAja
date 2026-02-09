<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;

class AdminDashboardController extends Controller
{
    /**
     * DASHBOARD ADMIN (sebelumnya: GURU)
     */
    public function index()
    {
        // Statistik utama
        $totalBooks = Book::count();
        $totalStudents = User::where('role', 'student')->count();
        $activeLoans = Loan::where('status', 'active')->count();
        $returnedLoans = Loan::where('status', 'returned')->count();

        // Peminjaman terbaru
        $recentLoans = Loan::with(['book.author'])
            ->latest()
            ->limit(10)
            ->get();

        // Siswa yang sedang meminjam
        $activeStudentLoans = Loan::with(['book'])
            ->where('status', 'active')
            ->latest()
            ->limit(10)
            ->get();

        return view('dashboard.admin', compact(
            'totalBooks',
            'totalStudents',
            'activeLoans',
            'returnedLoans',
            'recentLoans',
            'activeStudentLoans'
        ));
    }
}
