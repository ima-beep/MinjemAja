<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * HALAMAN "PINJAMAN"
     * (GURU: TAMPILKAN SEMUA PINJAMAN, SISWA: TAMPILKAN PINJAMAN MEREKA)
     */
    public function index()
    {
        $user = Auth::user();

        // Jika teacher, tampilkan semua
        if ($user->role === 'teacher') {
            $activeLoans = Loan::where('status', 'active')
                ->with(['book.author', 'book.publisher'])
                ->latest()
                ->get();

            $returnedLoans = Loan::where('status', 'returned')
                ->with(['book.author', 'book.publisher'])
                ->latest()
                ->paginate(10);

            return view('teacher.loans.index', compact('activeLoans', 'returnedLoans'));
        }

        // Jika student, tampilkan pinjaman mereka berdasarkan email
        $activeLoans = Loan::where('guest_email', $user->email)
            ->where('status', 'active')
            ->with(['book.author', 'book.publisher'])
            ->latest()
            ->get();

        $returnedLoans = Loan::where('guest_email', $user->email)
            ->where('status', 'returned')
            ->with(['book.author', 'book.publisher'])
            ->latest()
            ->paginate(10);

        return view('student.loans.index', compact('activeLoans', 'returnedLoans'));
    }

    /**
     * PINJAM BUKU (USER LOGIN)
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $book = Book::findOrFail($request->book_id);

        // Cek stok
        if ($book->stok <= 0) {
            return back()->with('error', 'Buku sedang tidak tersedia.');
        }

        // Cegah pinjam buku yang sama
        $alreadyBorrowed = Loan::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->where('status', 'active')
            ->exists();

        if ($alreadyBorrowed) {
            return back()->with('error', 'Anda sudah meminjam buku ini.');
        }

        Loan::create([
            'user_id'     => $user->id,
            'book_id'     => $book->id,
            'loan_date'   => now(),
            'return_date' => now()->addDays(7),
            'status'      => 'active',
        ]);

        // Kurangi stok
        $book->decrement('stok');

        return redirect()
            ->route('public.books.show', $book->id)
            ->with('success', 'Pinjaman berhasil. Happy Reading!');
    }

    /**
     * KEMBALIKAN BUKU (USER LOGIN)
     */
    public function returnBook(Loan $loan)
    {
        // Keamanan: hanya pemilik pinjaman
        if ($loan->user_id !== Auth::id()) {
            abort(403);
        }

        if ($loan->status !== 'active') {
            return back()->with('error', 'Peminjaman ini sudah dikembalikan.');
        }

        $loan->update([
            'status' => 'returned',
            'actual_return_date' => now(),
        ]);

        // Tambah stok kembali
        $loan->book->increment('stok');

        return back()->with('success', 'Buku berhasil dikembalikan!');
    }

    /**
     * KEMBALIKAN BUKU (TEACHER ONLY)
     */
    public function return(Loan $loan)
    {
        if ($loan->status !== 'active') {
            return back()->with('error', 'Peminjaman ini sudah dikembalikan.');
        }

        $loan->update([
            'status' => 'returned',
            'actual_return_date' => now(),
        ]);

        // Tambah stok kembali
        $loan->book->increment('stok');

        return back()->with('success', 'Buku berhasil dikembalikan!');
    }
}
