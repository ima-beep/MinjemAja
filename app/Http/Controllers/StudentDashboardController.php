<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalBooks = Book::count();

        $activeLoans = Loan::where('status', 'active')->count();

        $loans = Loan::with(['book.author', 'book.publisher'])
            ->where('status', 'active')
            ->latest()
            ->get();

        // Get pending return loans
        $pendingReturns = Loan::with(['book'])
            ->where('status', 'pending_return')
            ->where('guest_email', $user->email)
            ->get()
            ->count();

        // Get unpaid fines (exclude those already pending payment)
        $unpaidFines = Loan::with(['book'])
            ->where('status', 'returned')
            ->where('guest_email', $user->email)
            ->get()
            ->filter(function ($loan) {
                return $loan->getDaysDue() > 0 && $loan->fine_status !== 'approved_payment' && $loan->fine_status !== 'pending_payment';
            })
            ->count();

        // Get pending payment fines
        $pendingPaymentFines = Loan::with(['book'])
            ->where('status', 'returned')
            ->where('guest_email', $user->email)
            ->where('fine_status', 'pending_payment')
            ->get()
            ->filter(function ($loan) {
                return $loan->getDaysDue() > 0;
            })
            ->count();

        return view('dashboard.student', compact('totalBooks', 'activeLoans', 'loans', 'pendingReturns', 'unpaidFines', 'pendingPaymentFines'));
    }
}
