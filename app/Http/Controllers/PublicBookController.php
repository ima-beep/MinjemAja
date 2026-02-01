<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PublicBookController extends Controller
{
    public function show(Book $book)
    {
        // Load relasi yang dibutuhkan
        $book->load(['author', 'publisher', 'category']);

        return view('books.show', compact('book'))->with('isPublicView', true);
    }

    public function storeLoan(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $book = Book::findOrFail($request->book_id);

        // Cek stok
        if ($book->stok <= 0) {
            return back()->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        // Cari atau buat user guest
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt(Str::random(16)), // Generate random password
            ]);
        }

        // Cek apakah sudah meminjam buku yang sama
        $alreadyBorrowed = Loan::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->where('status', 'active')
            ->exists();

        if ($alreadyBorrowed) {
            return back()->with('error', 'Anda sudah meminjam buku ini.');
        }

        // Buat peminjaman
        Loan::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'loan_date' => now(),
            'return_date' => now()->addDays(7),
            'status' => 'active',
        ]);

        // Simpan email ke session untuk guest user
        session(['guest_email' => $request->email]);

        return redirect()->route('public.books.show', $book->id)
            ->with('success', 'Pinjaman telah berhasil. Happy Reading!');
    }

    public function returnLoan(Loan $loan)
    {
        // Cek apakah guest user ini adalah pemilik loan berdasarkan email di session
        if (session('guest_email')) {
            $guestUser = User::where('email', session('guest_email'))->first();
            if (!$guestUser || $loan->user_id !== $guestUser->id) {
                return back()->with('error', 'Anda tidak memiliki akses untuk mengembalikan buku ini.');
            }
        } else {
            return back()->with('error', 'Silakan masukkan email Anda untuk mengembalikan buku.');
        }

        if ($loan->status !== 'active') {
            return back()->with('error', 'Peminjaman ini sudah dikembalikan.');
        }

        $loan->update([
            'status' => 'returned',
            'actual_return_date' => now(),
        ]);

        return back()->with('success', 'Buku berhasil dikembalikan!');
    }

    /**
     * Download book PDF (public - guest users)
     */
    public function download(Book $book)
    {
        // Check if guest user has active loan for this book via session email
        if (!session('guest_email')) {
            return back()->with('error', 'Anda harus meminjam buku terlebih dahulu untuk mendownload PDF.');
        }

        $guestUser = User::where('email', session('guest_email'))->first();
        if (!$guestUser) {
            return back()->with('error', 'Data pengguna tidak ditemukan.');
        }

        $loan = Loan::where('user_id', $guestUser->id)
            ->where('book_id', $book->id)
            ->where('status', 'active')
            ->first();

        if (!$loan) {
            return back()->with('error', 'Anda harus meminjam buku terlebih dahulu untuk mendownload PDF.');
        }

        // Check if book has PDF file
        if (!$book->file_path || !Storage::disk('public')->exists($book->file_path)) {
            return back()->with('error', 'File PDF tidak tersedia untuk buku ini.');
        }

        // Download the file
        return response()->download(Storage::disk('public')->path($book->file_path), $book->name . '.pdf');
    }}