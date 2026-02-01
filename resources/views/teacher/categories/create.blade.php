@extends('layouts.teacher')

@section('title', 'Tambah Kategori')
@section('page_title', 'Tambah Kategori Baru')

@section('content')
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
  <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
    <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px; padding: 0;">Tambah Kategori Baru</h1>

    <form method="POST" action="{{ route('teacher.categories.store') }}" enctype="multipart/form-data"
      style="margin: 0; padding: 0; width: 100%; box-sizing: border-box;">

      @csrf

      @if($errors->any())
        <div style="background: #fee2e2; border: 1px solid #fecaca; border-radius: 6px; padding: 12px; margin-bottom: 16px;">
            <strong style="color: #dc2626;">Error:</strong>
            <ul style="margin: 8px 0 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li style="color: #dc2626;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <div style="display: flex; flex-direction: column; gap: 18px; width: 100%;">

        {{-- Nama Kategori --}}
        <div style="width: 100% !important; margin: 0;">
          <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Nama Kategori</label>
          <input type="text" name="name" value="{{ old('name') }}" required
            style="width: 100% !important; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; box-sizing: border-box;"
            placeholder="Contoh: Fiksi, Non-Fiksi, Teknologi">
          @error('name')
            <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
          @enderror
        </div>

        {{-- Deskripsi --}}
        <div style="width: 100% !important; margin: 0;">
          <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Deskripsi</label>
          <textarea name="description" 
            style="width: 100% !important; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; resize: vertical; min-height: 100px; box-sizing: border-box;"
            placeholder="Deskripsi kategori (opsional)">{{ old('description') }}</textarea>
          @error('description')
            <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
          @enderror
        </div>

      </div>

      <!-- BUTTON MELEBAR PENUH -->
      <div style="display: flex; gap: 12px; margin-top: 32px;">
        <button type="submit" style="flex: 1; padding: 12px 16px; background: #2563eb; color: #fff; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 14px;">
          Simpan Kategori
        </button>
        <a href="{{ route('teacher.categories.index') }}"
           style="flex: 1; padding: 12px 16px; background: #e5e7eb; color: #0f172a; text-align: center; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 14px;">
          Batal
        </a>
      </div>

    </form>
  </div>
</div>
@endsection
