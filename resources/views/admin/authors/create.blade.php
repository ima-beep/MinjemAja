@extends('layouts.admin')

@section('title', 'Tambah Pengarang')
@section('page_title', 'Tambah Pengarang Baru')

@section('content')
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
  <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
    <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px; padding: 0;">Tambah Pengarang Baru</h1>

    <form method="POST" action="{{ route('admin.authors.store') }}" enctype="multipart/form-data"
      style="margin: 0; padding: 0; width: 100%; box-sizing: border-box;">

      @csrf

      <div style="display: flex; flex-direction: column; gap: 18px; width: 100%;">

        {{-- Nama Pengarang --}}
        <div style="width: 100% !important; margin: 0;">
          <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Nama Pengarang</label>
          <input type="text" name="name" placeholder="Masukkan nama pengarang" value="{{ old('name') }}" required
            style="width: 100% !important; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
          @error('name')
            <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
          @enderror
        </div>

        {{-- Tanggal Lahir --}}
        <div style="width: 100% !important; margin: 0;">
          <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Tanggal Lahir</label>
          <input type="date" name="birth_date" value="{{ old('birth_date') }}"
            style="width: 100% !important; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
          @error('birth_date')
            <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
          @enderror
        </div>

        {{-- Kewarganegaraan --}}
        <div style="width: 100% !important; margin: 0;">
          <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Kewarganegaraan</label>
          <input type="text" name="nationality" placeholder="Masukkan kewarganegaraan" value="{{ old('nationality') }}"
            style="width: 100% !important; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; box-sizing: border-box;">
          @error('nationality')
            <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
          @enderror
        </div>

        {{-- Biografi --}}
        <div style="width: 100% !important; margin: 0;">
          <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Biografi</label>
          <textarea name="biography" placeholder="Masukkan biografi pengarang" rows="6"
            style="width: 100% !important; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; font-family: inherit; resize: vertical; box-sizing: border-box;">{{ old('biography') }}</textarea>
          @error('biography')
            <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
          @enderror
        </div>

      </div>

      <!-- BUTTON MELEBAR PENUH -->
      <div style="display: flex; gap: 12px; margin-top: 32px;">
        <button type="submit"
          style="flex: 1; padding: 12px 16px; background: #2563eb; color: #fff; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 14px;">
          Simpan Pengarang
        </button>

        <a href="{{ route('admin.authors.index') }}"
          style="flex: 1; padding: 12px 16px; background: #e5e7eb; color: #0f172a; text-align: center; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 14px;">
          Batal
        </a>
      </div>

    </form>
  </div>
</div>
@endsection
