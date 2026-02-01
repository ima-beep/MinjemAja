@extends('layouts.student')

@section('title', 'Edit Foto Profil')

@section('content')
<div style="max-width:700px;">
    <h1>Ubah Foto Profil</h1>

    @if(session('success'))
        <div style="background:#d1fae5;border:1px solid #10b981;padding:12px;border-radius:8px;margin-bottom:12px;color:#065f46;">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div style="background:#f8fafc;padding:16px;border-radius:8px;margin-bottom:20px;border:1px solid #e2e8f0;">
            <h3 style="margin:0 0 16px;font-size:14px;font-weight:700;color:#1e293b;">Informasi Akun</h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <div>
                    <p style="margin:0 0 4px;color:#64748b;font-size:12px;font-weight:600;">Nama</p>
                    <p style="margin:0;font-size:14px;font-weight:600;">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <p style="margin:0 0 4px;color:#64748b;font-size:12px;font-weight:600;">NISN</p>
                    <p style="margin:0;font-size:14px;font-weight:600;">{{ Auth::user()->nisn ?? '-' }}</p>
                </div>
                <div style="grid-column:1/-1;">
                    <p style="margin:0 0 4px;color:#64748b;font-size:12px;font-weight:600;">Email</p>
                    <p style="margin:0;font-size:14px;font-weight:600;">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('student.profile-photo.upload') }}" enctype="multipart/form-data">
            @csrf

            <div style="display:flex;gap:16px;align-items:center;margin-bottom:16px;">
                <div style="width:96px;height:96px;border-radius:8px;overflow:hidden;border:1px solid #e2e8f0;">
                    @if(Auth::user()->profile_photo_path)
                        <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" style="width:100%;height:100%;object-fit:cover;" alt="Profile">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#eef2ff;color:#1e40af;font-weight:700;font-size:32px;">{{ substr(Auth::user()->name,0,1) }}</div>
                    @endif
                </div>
                <div>
                    <div style="font-weight:700">{{ Auth::user()->name }}</div>
                    <div style="color:#64748b;font-size:13px">Siswa</div>
                </div>
            </div>

            <div style="margin-bottom:12px;">
                <label style="display:block;font-weight:600;margin-bottom:8px;">Pilih Foto</label>
                <input type="file" name="profile_photo" accept="image/*" required>
                @error('profile_photo')
                    <div style="color:#dc2626;margin-top:6px">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;gap:10px">
                <button type="submit" style="padding:10px 16px;background:linear-gradient(135deg,#3b82f6,#2563eb);color:white;border:none;border-radius:8px;font-weight:700;">Upload</button>
                <a href="{{ route('student.dashboard') }}" style="display:inline-block;padding:10px 16px;background:#f1f5f9;color:#475569;border-radius:8px;text-decoration:none;">Batal</a>
            </div>
        </form>

        @if(Auth::user()->profile_photo_path)
        <form method="POST" action="{{ route('student.profile-photo.delete') }}" style="margin-top:12px;">
            @csrf
            <button type="submit" onclick="return confirm('Yakin ingin menghapus foto profil?')" style="padding:10px 16px;background:#fee2e2;color:#b91c1c;border:none;border-radius:8px;font-weight:700;">Hapus Foto</button>
        </form>
        @endif
    </div>
</div>
@endsection
