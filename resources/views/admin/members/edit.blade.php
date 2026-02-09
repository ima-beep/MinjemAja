@extends('layouts.admin')

@section('title', 'Edit Anggota')

@section('content')
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px;">👥 Edit Anggota</h1>

        <form method="POST" action="{{ route('admin.members.update', $member->id) }}" style="margin: 0; padding: 0; width: 100%; box-sizing: border-box;">
            @csrf
            @method('PUT')

            <div style="display: flex; flex-direction: column; gap: 18px; width: 100%;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Nama</label>
                <input type="text" name="name" value="{{ old('name', $member->name) }}" required
                    style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                @error('name')
                    <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Email</label>
                <input type="email" name="email" value="{{ old('email', $member->email) }}" required
                    style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                @error('email')
                    <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">NISN</label>
                <input type="text" name="nisn" value="{{ old('nisn', $member->nisn) }}"
                    style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                @error('nisn')
                    <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Kelas/Jurusan</label>
                <input type="text" name="kelas" value="{{ old('kelas', $member->kelas) }}"
                    style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                @error('kelas')
                    <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Status</label>
                <select name="status" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                    <option value="active" {{ old('status', $member->status ?? 'active') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status', $member->status ?? 'active') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('status')
                    <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: flex; gap: 12px; margin-top: auto; border-top: 1px solid #e5e7eb; padding-top: 24px;">
                <button type="submit" style="flex: 0 1 200px; padding: 12px 16px; background: #2563eb; color: #fff; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 14px;">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.members.index') }}" style="flex: 0 1 200px; padding: 12px 16px; background: #e5e7eb; color: #0f172a; text-align: center; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 14px;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
