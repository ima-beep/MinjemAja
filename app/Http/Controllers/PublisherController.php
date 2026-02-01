<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::with([
            'books.author'
        ])->orderBy('name')->get();

        return view('teacher.publishers.index', compact('publishers'));
    }

    public function create()
    {
        return view('teacher.publishers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:publishers,name',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        Publisher::create($data);

        return redirect()->route('teacher.publishers.index')
            ->with('success', 'Penerbit berhasil ditambahkan');
    }

    public function edit(Publisher $publisher)
    {
        return view('teacher.publishers.edit', compact('publisher'));
    }

    public function update(Request $request, Publisher $publisher)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:publishers,name,' . $publisher->id,
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $publisher->update($data);

        return redirect()->route('teacher.publishers.index')
            ->with('success', 'Penerbit berhasil diperbarui');
    }

    public function destroy(Publisher $publisher)
    {
        if ($publisher->books()->count() > 0) {
            return redirect()->route('teacher.publishers.index')
                ->with('error', 'Penerbit tidak dapat dihapus karena masih memiliki buku');
        }

        $publisher->delete();

        return redirect()->route('teacher.publishers.index')
            ->with('success', 'Penerbit berhasil dihapus');
    }
}
