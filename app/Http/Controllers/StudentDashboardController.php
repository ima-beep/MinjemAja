<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();

        $activeLoans = Loan::where('status', 'active')->count();

        $loans = Loan::with(['book.author', 'book.publisher'])
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('dashboard.student', compact('totalBooks', 'activeLoans', 'loans'));
    }
}
