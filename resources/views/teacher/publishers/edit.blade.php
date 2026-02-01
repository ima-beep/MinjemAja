@extends('layouts.teacher')

@section('title', 'Edit Penerbit')
@section('page_title', 'Edit Penerbit')

@section('content')
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
  <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
    <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px; padding: 0;">Edit Penerbit</h1>

    <form method="POST" action="{{ route('teacher.publishers.update', $publisher) }}" enctype="multipart/form-data"
      style="margin: 0; padding: 0; width: 100%; box-sizing: border-box;">
      @csrf
      @method('PUT')

      <div style="display: flex; flex-direction: column; gap: 18px; width: 100%;">
        <label style="display: block; margin-bottom: 8px; color: #334155; font-weight: 600; font-size: 14px;">Nama Penerbit *</label>
        <input type="text" name="name" placeholder="Masukkan nama penerbit" required
               value="{{ old('name', $publisher->name) }}"
               style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
        @error('name')
            <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
        @enderror
    </div>

    <div style="margin-bottom: 18px;">
        <label style="display: block; margin-bottom: 8px; color: #334155; font-weight: 600; font-size: 14px;">Alamat</label>
        <textarea name="address" placeholder="Masukkan alamat penerbit" rows="3"
                  style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; font-family: inherit; resize: vertical;">{{ old('address', $publisher->address) }}</textarea>
        @error('address')
            <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
        @enderror
    </div>

    <div style="margin-bottom: 18px;">
        <label style="display: block; margin-bottom: 8px; color: #334155; font-weight: 600; font-size: 14px;">Telepon</label>
        <input type="text" name="phone" placeholder="Masukkan nomor telepon" value="{{ old('phone', $publisher->phone) }}"
               style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
        @error('phone')
            <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
        @enderror
    </div>

    <div style="margin-bottom: 24px;">
        <label style="display: block; margin-bottom: 8px; color: #334155; font-weight: 600; font-size: 14px;">Email</label>
        <input type="email" name="email" placeholder="Masukkan alamat email" value="{{ old('email', $publisher->email) }}"
               style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
        @error('email')
            <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
        @enderror
    </div>

    <div style="display: flex; gap: 12px; margin-top: 24px; border-top: 1px solid #e5e7eb; padding-top: 24px;">
        <button type="submit"
            style="flex: 0 1 200px; padding: 12px 16px; background: #2563eb; color: #fff; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 14px;">
            Update Penerbit
        </button>
        <a href="{{ route('teacher.publishers.index') }}"
            style="flex: 0 1 200px; padding: 12px 16px; background: #e5e7eb; color: #0f172a; text-align: center; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 14px;">
            Batal
        </a>
            </div>
        </form>
    </div>
</div>
@endsection