@extends('layouts.admin')

@section('title', 'Edit Buku')

@section('content')

<!-- Make edit form layout consistent with create form -->
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px; padding: 0;">✏️ Edit Buku</h1>

        <form method="POST" action="{{ route('admin.books.update', $book->id) }}" enctype="multipart/form-data"
            style="margin: 0; padding: 0; width: 100%; box-sizing: border-box;">

            @csrf
            @method('PUT')

            <div style="display: flex; flex-direction: column; gap: 18px; width: 100%;">

                {{-- Judul --}}
                <div style="width: 100% !important; margin: 0;">
                    <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Judul Buku</label>
                    <input type="text" name="name" placeholder="Masukkan judul buku" value="{{ old('name', $book->name) }}" required
                        style="width: 100% !important; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                    @error('name')
                        <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Penulis --}}
                <div style="width: 100% !important; margin: 0;">
                    <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Penulis</label>
                    <select name="author_id" required
                        style="width: 100% !important; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                        <option value="">-- Pilih Penulis --</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('author_id')
                        <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div style="width: 100% !important; margin: 0;">
                    <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Deskripsi</label>
                    <textarea name="description" placeholder="Masukkan deskripsi atau sinopsis buku" rows="4"
                        style="width: 100% !important; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; font-family: inherit; resize: vertical; box-sizing: border-box;">{{ old('description', $book->description) }}</textarea>
                    @error('description')
                        <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Penerbit --}}
                <div style="width: 100% !important; margin: 0;">
                    <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Penerbit</label>
                    <select name="publisher_id" required
                        style="width: 100% !important; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                        <option value="">-- Pilih Penerbit --</option>
                        @foreach($publishers as $publisher)
                            <option value="{{ $publisher->id }}" {{ old('publisher_id', $book->publisher_id) == $publisher->id ? 'selected' : '' }}>
                                {{ $publisher->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('publisher_id')
                        <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div style="width: 100% !important; margin: 0;">
                    <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Kategori</label>
                    <select name="category_id"
                        style="width: 100% !important; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tahun Terbit --}}
                <div style="width: 100% !important; margin: 0;">
                    <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Tahun Terbit</label>
                    <input type="number" name="tahun" value="{{ old('tahun', $book->publication_date ? $book->publication_date->format('Y') : '') }}" required
                        placeholder="Contoh: 2024"
                        style="width: 100% !important; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                    @error('tahun')
                        <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Stok --}}
                <div style="width: 100% !important; margin: 0;">
                    <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Stok Buku</label>
                    <input type="number" name="stok" value="{{ old('stok', $book->stok ?? 0) }}" required min="0"
                        placeholder="Masukkan jumlah stok"
                        style="width: 100% !important; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                    @error('stok')
                        <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Gambar Sampul --}}
                <div style="width: 100% !important; margin: 0;">
                    <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Gambar Sampul</label>
                    @if($book->cover_image)
                        <img src="{{ asset('storage/'.$book->cover_image) }}" style="max-width:200px;border-radius:6px;margin-bottom:10px;display:block">
                    @endif
                    <input type="file" name="cover_image" accept="image/*"
                        style="width: 100% !important; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
                    <p style="color: #6b7280; font-size: 12px; margin-top: 4px;">Format: JPG, PNG, GIF. Ukuran maksimal: 2 MB</p>
                    @error('cover_image')
                        <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- BUTTON MELEBAR PENUH -->
            <div style="display: flex; gap: 12px; margin-top: 32px;">
                <button type="submit"
                    style="flex: 1; padding: 12px 16px; background: #2563eb; color: #fff; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 14px;">
                    Update Buku
                </button>

                <a href="{{ route('admin.books.index') }}"
                    style="flex: 1; padding: 12px 16px; background: #e5e7eb; color: #0f172a; text-align: center; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 14px;">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
