<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return view('admin.authors.index', [
            'authors' => Author::with('books')->orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:authors,name',
            'biography' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'nationality' => 'nullable|string|max:100',
        ]);

        Author::create($data);

        return redirect()->route('admin.authors.index')
            ->with('success', 'Pengarang berhasil ditambahkan');
    }

    public function edit(Author $author)
    {
        return view('admin.authors.edit', [
            'author' => $author,
        ]);
    }

    public function update(Request $request, Author $author)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:authors,name,' . $author->id,
            'biography' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'nationality' => 'nullable|string|max:100',
        ]);

        $author->update($data);

        return redirect()->route('admin.authors.index')
            ->with('success', 'Pengarang berhasil diperbarui');
    }

    public function destroy(Author $author)
    {
        // Check if author has books
        if ($author->books()->count() > 0) {
            return redirect()->route('admin.authors.index')
                ->with('error', 'Pengarang tidak dapat dihapus karena masih memiliki buku');
        }

        $author->delete();

        return redirect()->route('admin.authors.index')
            ->with('success', 'Pengarang berhasil dihapus');
    }
}
