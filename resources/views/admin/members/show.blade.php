@extends('layouts.admin')

@section('title', 'Detail Anggota')

@section('content')
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px; padding: 0 20px;">👥 Detail Anggota</h1>

        <div style="background:#fff; padding:24px; border-radius:8px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,.05); margin: 0 20px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                <div>
                    <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Nama</p>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 600;">{{ $member->name }}</h3>
                </div>
                <div>
                    <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Email</p>
                    <p style="margin: 0; font-size: 14px;">{{ $member->email }}</p>
                </div>
                <div>
                    <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">NISN</p>
                    <p style="margin: 0; font-size: 14px;">{{ $member->nisn ?? '-' }}</p>
                </div>
                <div>
                    <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase;">Kelas/Jurusan</p>
                    <p style="margin: 0; font-size: 14px;">{{ $member->kelas ?? '-' }}</p>
                </div>
            </div>

            <div style="border-top: 2px solid #e2e8f0; padding-top: 24px; margin-bottom: 24px;">
                <h3 style="margin: 0 0 16px; font-size: 16px; font-weight: 600;">Riwayat Peminjaman</h3>
                
                @if($loans->isEmpty())
                    <p style="margin: 0; color: #6b7280; text-align: center; padding: 20px;">Belum ada peminjaman</p>
                @else
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background: #f1f5f9;">
                                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Buku</th>
                                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Tanggal Peminjaman</th>
                                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Jatuh Tempo</th>
                                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #cbd5e1;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($loans as $loan)
                                    <tr style="border-bottom: 1px solid #e2e8f0;">
                                        <td style="padding: 12px;">{{ $loan->book->name }}</td>
                                        <td style="padding: 12px;">{{ optional($loan->loan_date)->format('d M Y') ?? '-' }}</td>
                                        <td style="padding: 12px;">{{ optional($loan->return_date)->format('d M Y') ?? '-' }}</td>
                                        <td style="padding: 12px;">
                                            @if($loan->status === 'returned')
                                                <span style="background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                                                    ✓ Dikembalikan
                                                </span>
                                            @else
                                                <span style="background: #fef3c7; color: #92400e; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                                                    Dipinjam
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div style="margin-top: 16px;">
                    <a href="{{ route('admin.members.index') }}" style="display: inline-block; padding: 8px 12px; background: #e5e7eb; color: #0f172a; text-align: center; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 13px;">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
