<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Category;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // If student, show student books view
        if ($user->role === 'student') {
            return view('student.books.index', [
                'books' => Book::latest()->get()
            ]);
        }
        
        // Otherwise, show teacher books view
        return view('teacher.books.index', [
            'books' => Book::latest()->get()
        ]);
    }

    public function create()
    {
        return view('teacher.books.create', [
            'authors' => Author::orderBy('name')->get(),
            'publishers' => Publisher::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:150',
            'author_id'    => 'required|exists:authors,id',
            'publisher_id' => 'required|exists:publishers,id',
            'category_id'  => 'nullable|exists:categories,id',
            'tahun'        => 'required|digits:4',
            'stok'         => 'required|integer|min:0',
            'description'  => 'nullable|string',
            'cover_image'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Convert tahun to publication_date
        if ($data['tahun']) {
            $data['publication_date'] = $data['tahun'] . '-01-01';
        }
        unset($data['tahun']);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $path = $file->store('books', 'public');
            $data['cover_image'] = $path;
        }

        Book::create($data);

        return redirect()->route('teacher.books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function show(Book $book)
    {
        $user = Auth::user();
        $loan = null;
        
        // For students, check loan by guest_email
        if ($user->role === 'student') {
            $loan = Loan::where('guest_email', $user->email)
                ->where('book_id', $book->id)
                ->where('status', 'active')
                ->first();
            
            return view('student.books.show', [
                'book' => $book,
                'loan' => $loan,
                'isPublicView' => false
            ]);
        }
        
        // For teachers, just show book details
        return view('teacher.books.show', [
            'book' => $book
        ]);
    }

    public function edit(Book $book)
    {
        return view('teacher.books.edit', [
            'book' => $book,
            'authors' => Author::orderBy('name')->get(),
            'publishers' => Publisher::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:150',
            'author_id'    => 'required|exists:authors,id',
            'publisher_id' => 'required|exists:publishers,id',
            'category_id'  => 'nullable|exists:categories,id',
            'tahun'        => 'required|digits:4',
            'stok'         => 'required|integer|min:0',
            'description'  => 'nullable|string',
            'cover_image'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Convert tahun to publication_date
        if ($data['tahun']) {
            $data['publication_date'] = $data['tahun'] . '-01-01';
        }
        unset($data['tahun']);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old file if exists
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }
            
            $file = $request->file('cover_image');
            $path = $file->store('books', 'public');
            $data['cover_image'] = $path;
        }

        $book->update($data);

        return redirect()->route('teacher.books.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('teacher.books.index')
            ->with('success', 'Buku berhasil dihapus');
    }

    /**
     * Borrow a book (authenticated user / student)
     */
    public function borrowBook(Book $book)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return back()->with('error', 'Anda harus login untuk meminjam buku');
        }

        $user = Auth::user();

        // Check stock
        if ($book->stok <= 0) {
            return back()->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        // Create loan with guest info from authenticated user
        Loan::create([
            'book_id' => $book->id,
            'guest_name' => $user->name,
            'guest_nisn' => $user->phone ?? 'N/A',
            'guest_class' => 'Student',
            'guest_email' => $user->email,
            'guest_phone' => $user->phone ?? '',
            'loan_date' => now(),
            'return_date' => now()->addDays(7),
            'status' => 'active',
        ]);

        // Decrease stock
        $book->decrement('stok');

        return back()->with('success', 'Buku berhasil dipinjam. Durasi peminjaman 7 hari.');
    }

    /**
     * Return a book (authenticated user)
     */
    public function returnBook($loanId)
    {
        $loan = Loan::findOrFail($loanId);

        if ($loan->status !== 'active') {
            return back()->with('error', 'Peminjaman ini sudah dikembalikan.');
        }

        $loan->update([
            'status' => 'returned',
            'actual_return_date' => now(),
        ]);

        // Increase stock
        $loan->book->increment('stok');

        return back()->with('success', 'Buku berhasil dikembalikan!');
    }

}
