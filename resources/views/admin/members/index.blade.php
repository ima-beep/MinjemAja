@extends('layouts.admin')

@section('title', 'Kelola Anggota')

@section('content')
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px;">👥 Kelola Anggota</h1>

        @if(session('success'))
            <div style="background: #dcfce7; border: 1px solid #86efac; border-radius: 6px; padding: 12px; margin-bottom: 20px; color: #166534;">
                {{ session('success') }}
            </div>
        @endif

        <div style="background:#fff; padding:24px; border-radius:8px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="margin: 0; font-size: 18px; font-weight: 600;">Daftar Anggota</h2>
                <span style="background: #dbeafe; color: #1e40af; padding: 6px 12px; border-radius: 6px; font-weight: 600; font-size: 12px;">
                    Total: {{ count($members) }} Anggota
                </span>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f1f5f9;">
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Nama</th>
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Email</th>
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">NISN</th>
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Kelas/Jurusan</th>
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Status</th>
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $member)
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 12px;">{{ $member->name }}</td>
                                <td style="padding: 12px;">{{ $member->email }}</td>
                                <td style="padding: 12px;">{{ $member->nisn ?? '-' }}</td>
                                <td style="padding: 12px;">{{ $member->kelas ?? '-' }}</td>
                                <td style="padding: 12px;">
                                    <span style="background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                                        Aktif
                                    </span>
                                </td>
                                <td style="padding: 12px;">
                                    <a href="{{ route('admin.members.show', $member->id) }}" style="background: #6366f1; color: #fff; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; display: inline-block; margin-right: 8px;">
                                        Detail
                                    </a>
                                    <a href="{{ route('admin.members.edit', $member->id) }}" style="background: #3b82f6; color: #fff; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; display: inline-block; margin-right: 8px;">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.members.destroy', $member->id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus anggota ini?')" style="background: #ef4444; color: #fff; padding: 6px 12px; border: none; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 600; cursor: pointer;">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td colspan="6" style="padding: 40px 12px; text-align: center; color: #6b7280;">
                                    Tidak ada anggota
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
