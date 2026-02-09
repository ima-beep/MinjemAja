@extends('layouts.admin')

@section('title', 'Pinjaman Saya')
@section('page_title', 'Riwayat Pinjaman Buku')

@section('content')
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div style="background:#d1fae5;border:1px solid #6ee7b7;border-radius:6px;padding:12px;margin-bottom:16px;color:#047857;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background:#fee2e2;border:1px solid #fecaca;border-radius:6px;padding:12px;margin-bottom:16px;color:#dc2626;">
            {{ session('error') }}
        </div>
    @endif

    {{-- ACTIVE LOANS --}}
    <div style="background:#fff;padding:24px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.04);margin-bottom:24px;">
        <h2 style="margin-top:0;color:#dc2626;">
            📌 Peminjaman Aktif ({{ $activeLoans->count() }})
        </h2>

        @if($activeLoans->count())
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr style="background:#f9fafb;border-bottom:2px solid #e5e7eb;">
                            <th style="padding:12px;text-align:left;">Judul Buku</th>
                            <th style="padding:12px;">Peminjam</th>
                            <th style="padding:12px;">Tanggal Pinjam</th>
                            <th style="padding:12px;">Batas Kembali</th>
                            <th style="padding:12px;text-align:center;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeLoans as $loan)
                            <tr style="border-bottom:1px solid #e5e7eb;">
                                <td style="padding:12px;">
                                    <strong>{{ $loan->book->name }}</strong><br>
                                    <small>{{ $loan->book->author?->name ?? '-' }}</small>
                                </td>
                                <td style="padding:12px;">
                                    <strong>{{ $loan->guest_name }}</strong><br>
                                    <small>{{ $loan->guest_class }}</small>
                                </td>

                                <td style="padding:12px;">
                                    {{ optional($loan->loan_date)->format('d M Y') ?? '-' }}
                                </td>

                                {{-- BAGIAN INI FIX TOTAL (TIDAK MERAH) --}}
                                <td style="padding:12px;">
                                    @if(optional($loan->return_date)->isPast())
                                        <span style="color:#dc2626;font-weight:600;">
                                            {{ optional($loan->return_date)->format('d M Y') }} ⚠️
                                        </span>
                                    @else
                                        <span style="color:#059669;font-weight:600;">
                                            {{ optional($loan->return_date)->format('d M Y') ?? '-' }} ✓
                                        </span>
                                    @endif
                                </td>

                                <td style="text-align:center;">
                                    <span style="background:#fef3c7;color:#92400e;padding:4px 8px;border-radius:4px;font-size:12px;">
                                        Aktif
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p style="text-align:center;color:#6b7280;">Tidak ada peminjaman aktif.</p>
        @endif
    </div>

    {{-- PENDING RETURN REQUESTS --}}
    @if(isset($pendingReturns) && $pendingReturns->count() > 0)
    <div style="background:#fff;padding:24px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.04);margin-bottom:24px;border-left:4px solid #f59e0b;">
        <h2 style="margin-top:0;color:#f59e0b;">
            ⏳ Permintaan Pengembalian Menunggu Persetujuan ({{ $pendingReturns->count() }})
        </h2>

        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="background:#fef3c7;border-bottom:2px solid #fcd34d;">
                        <th style="padding:12px;text-align:left;">Judul Buku</th>
                        <th style="padding:12px;">Peminjam</th>
                        <th style="padding:12px;">Tanggal Pinjam</th>
                        <th style="padding:12px;">Permintaan Tanggal</th>
                        <th style="padding:12px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingReturns as $loan)
                        <tr style="border-bottom:1px solid #fcd34d;background:#fffbeb;">
                            <td style="padding:12px;">
                                <strong>{{ $loan->book->name }}</strong><br>
                                <small>{{ $loan->book->author?->name ?? '-' }}</small>
                            </td>
                            <td style="padding:12px;">
                                <strong>{{ $loan->guest_name }}</strong><br>
                                <small>{{ $loan->guest_class }}</small>
                            </td>
                            <td style="padding:12px;">
                                {{ optional($loan->loan_date)->format('d M Y') ?? '-' }}
                            </td>
                            <td style="padding:12px;">
                                {{ optional($loan->return_request_date)->format('d M Y') ?? '-' }}
                            </td>
                            <td style="padding:12px;text-align:center;">
                                <form method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" formaction="{{ route('admin.books.approve-return', $loan->id) }}"
                                        onclick="return confirm('Setujui pengembalian buku ini?')"
                                        style="padding:6px 10px;background:#10b981;color:#fff;border:none;border-radius:4px;font-size:12px;font-weight:600;margin-right:4px;cursor:pointer;">
                                        ✓ Setujui
                                    </button>
                                    <button type="submit" formaction="{{ route('admin.books.reject-return', $loan->id) }}"
                                        onclick="return confirm('Tolak pengembalian buku ini?')"
                                        style="padding:6px 10px;background:#ef4444;color:#fff;border:none;border-radius:4px;font-size:12px;font-weight:600;cursor:pointer;">
                                        ✕ Tolak
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- RETURNED LOANS --}}
    <div style="background:#fff;padding:24px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.04);">
        <h2 style="margin-top:0;color:#10b981;">✅ Riwayat Pengembalian</h2>

        @if($returnedLoans->count())
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr style="background:#f9fafb;border-bottom:2px solid #e5e7eb;">
                            <th style="padding:12px;">Judul Buku</th>
                            <th style="padding:12px;">Peminjam</th>
                            <th style="padding:12px;">Tanggal Pinjam</th>
                            <th style="padding:12px;">Tanggal Kembali</th>
                            <th style="padding:12px;text-align:center;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($returnedLoans as $loan)
                            <tr style="border-bottom:1px solid #e5e7eb;">
                                <td style="padding:12px;">
                                    <strong>{{ $loan->book->name }}</strong>
                                </td>
                                <td style="padding:12px;">
                                    <strong>{{ $loan->guest_name }}</strong><br>
                                    <small>{{ $loan->guest_class }}</small>
                                </td>
                                <td style="padding:12px;">
                                    {{ optional($loan->loan_date)->format('d M Y') ?? '-' }}
                                </td>
                                <td style="padding:12px;">
                                    {{ optional($loan->actual_return_date)->format('d M Y') ?? '-' }}
                                </td>
                                <td style="text-align:center;">
                                    <span style="background:#d1fae5;color:#047857;padding:4px 8px;border-radius:4px;font-size:12px;">
                                        Dikembalikan
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="margin-top:16px;display:flex;justify-content:center;">
                    {{ $returnedLoans->links() }}
                </div>
            </div>
        @else
            <p style="text-align:center;color:#6b7280;">Belum ada riwayat pengembalian.</p>
        @endif
    </div>

    </div>
</div>
@endsection
