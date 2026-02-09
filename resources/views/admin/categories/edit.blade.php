@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page_title', 'Edit Kategori')

@section('content')
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
  <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
    <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px; padding: 0;">Edit Kategori</h1>

    <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data"
      style="margin: 0; padding: 0; width: 100%; box-sizing: border-box;">
      @csrf
      @method('PUT')

      <div style="display: flex; flex-direction: column; gap: 18px; width: 100%;">
            <label style="display: block; margin-bottom: 6px; font-weight: 500; color: #374151;">
                Nama Kategori
            </label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                   style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 500; color: #374151;">
                Deskripsi
            </label>
            <textarea name="description" 
                      style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; box-sizing: border-box; resize: vertical; min-height: 100px;">{{ old('description', $category->description) }}</textarea>
        </div>

        <div style="display: flex; gap: 8px;">
            <button type="submit" style="padding: 10px 20px; background: #10b981; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">
                Update Kategori
            </button>
            <a href="{{ route('admin.categories.index') }}"
               style="padding: 10px 20px; background: #6b7280; color: #fff; text-decoration: none; border-radius: 6px; font-weight: 600;">
                Batal
            </a>
        </div>
    </form>
    </div>
@endsection
