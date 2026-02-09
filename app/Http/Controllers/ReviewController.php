<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Students: list eligible books and their reviews
    public function studentIndex()
    {
        $user = Auth::user();

        // Books the user has borrowed AND returned (status = 'returned')
        $borrowedBookIds = Loan::where('guest_email', $user->email)
            ->where('status', 'returned')
            ->pluck('book_id')
            ->unique()
            ->toArray();

        $books = Book::whereIn('id', $borrowedBookIds)->get();

        $reviews = Review::where('user_id', $user->id)->whereIn('book_id', $borrowedBookIds)->get();

        return view('student.reviews.index', compact('books', 'reviews'));
    }

    // Show form to create a review for a specific book
    public function create($bookId)
    {
        $user = Auth::user();

        // Check eligibility: user must have borrowed and returned the book (status = 'returned')
        $borrowed = Loan::where('guest_email', $user->email)
            ->where('book_id', $bookId)
            ->where('status', 'returned')
            ->exists();

        if (! $borrowed) {
            return redirect()->route('student.reviews.index')->with('error', 'Anda hanya dapat mengulas buku yang sudah dikembalikan dan disetujui oleh admin.');
        }

        // Prevent duplicate reviews
        $exists = Review::where('user_id', $user->id)->where('book_id', $bookId)->first();
        if ($exists) {
            return redirect()->route('student.reviews.index')->with('success', 'Anda sudah memberi ulasan untuk buku ini.');
        }

        $book = Book::findOrFail($bookId);
        return view('student.reviews.create', compact('book'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        // Prevent duplicate review by same user for same book
        $exists = Review::where('user_id', $user->id)->where('book_id', $validated['book_id'])->first();
        if ($exists) {
            return redirect()->back()->with('success', 'Anda sudah memberi ulasan untuk buku ini.');
        }

        Review::create([
            'user_id' => $user->id,
            'book_id' => $validated['book_id'],
            'rating' => $validated['rating'],
            'review' => $validated['review'] ?? null,
        ]);

        return redirect()->route('student.reviews.index')->with('success', 'Terima kasih, ulasan Anda telah disimpan.');
    }

    // Admin (sebelumnya: Teacher): list all reviews
    public function adminIndex()
    {
        $reviews = Review::with('book', 'user')->latest()->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->back()->with('success', 'Ulasan dihapus');
    }
}
