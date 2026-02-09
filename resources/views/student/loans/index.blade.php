@extends('layouts.student')

@section('title', 'Riwayat Peminjaman')

@section('content')

{{-- 🔥 WRAPPER FIX: ikut container layout, bukan ke tengah --}}
<div style="width: 100%; max-width: none; margin: 0; padding: 0;">

    <div>
        <h1 style="margin: 0 0 20px; font-size: 28px; color: #0f172a; font-weight: 700;">
            📋 Riwayat Peminjaman
        </h1>

        @if(session('success'))
            <div style="margin-bottom: 16px; padding: 12px; border-radius: 8px; background: #dcfce7; color: #166534; font-weight: 600;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="margin-bottom: 16px; padding: 12px; border-radius: 8px; background: #fee2e2; color: #991b1b; font-weight: 600;">
                {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- PINJAMAN AKTIF --}}
    <div style="background: #fff; border-radius: 10px; margin: 0 0 16px 0; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,.05); border: 1px solid #e5e7eb;">
        <h3 style="margin: 0 0 12px; color: #0f172a; font-size: 15px; font-weight: 700; border-bottom: 2px solid #2563eb; padding-bottom: 8px;">
            Sedang Dipinjam ({{ $activeLoans->count() }})
        </h3>

        @if($activeLoans->count() > 0)
            <table style="width:100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="background: #f1f5f9;">
                        <th style="padding: 12px; text-align: left; font-weight: 600;">Judul Buku</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600;">Pengarang</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600;">Tanggal Pinjam</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600;">Tanggal Kembali</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activeLoans as $loan)
                    <tr>
                        <td style="padding: 12px;"><strong>{{ $loan->book->name }}</strong></td>
                        <td style="padding: 12px;">{{ $loan->book->author?->name ?? '-' }}</td>
                        <td style="padding: 12px;">{{ $loan->loan_date->format('d M Y') }}</td>
                        <td style="padding: 12px; color: #dc2626; font-weight: 600;">{{ $loan->return_date->format('d M Y') }}</td>
                        <td style="padding: 12px;">
                            <form method="POST" action="{{ route('student.books.return', $loan->id) }}">
                                @csrf
                                <button type="submit"
                                    onclick="return confirm('Kembalikan buku ini?')"
                                    style="padding: 6px 12px; background: #f59e0b; color: #fff; border: none; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                    Kembalikan
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #6b7280; text-align: center; padding: 20px; margin: 0;">
                Anda tidak sedang meminjam buku
            </p>
        @endif
    </div>

    {{-- PERMINTAAN PENGEMBALIAN MENUNGGU PERSETUJUAN --}}
    @if(isset($pendingReturns) && $pendingReturns->count() > 0)
    <div style="background: #fff; border-radius: 10px; margin: 0 0 16px 0; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,.05); border: 1px solid #fcd34d;">
        <h3 style="margin: 0 0 12px; color: #92400e; font-size: 15px; font-weight: 700; border-bottom: 2px solid #f59e0b; padding-bottom: 8px;">
            ⏳ Pengembalian Menunggu Persetujuan ({{ $pendingReturns->count() }})
        </h3>

        <table style="width:100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="background: #fef3c7;">
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Judul Buku</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Pengarang</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Tanggal Pinjam</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Tanggal Permintaan</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingReturns as $loan)
                <tr style="background: #fffbeb;">
                    <td style="padding: 12px;"><strong>{{ $loan->book->name }}</strong></td>
                    <td style="padding: 12px;">{{ $loan->book->author?->name ?? '-' }}</td>
                    <td style="padding: 12px;">{{ $loan->loan_date->format('d M Y') }}</td>
                    <td style="padding: 12px;">{{ $loan->return_request_date->format('d M Y') }}</td>
                    <td style="padding: 12px; color: #f59e0b; font-weight: 600;">Menunggu Persetujuan</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    {{-- RIWAYAT PEMINJAMAN --}}
    <div style="background: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,.05); border: 1px solid #e5e7eb;">
        <h3 style="margin: 0 0 12px; color: #0f172a; font-size: 15px; font-weight: 700; border-bottom: 2px solid #2563eb; padding-bottom: 8px;">
            Riwayat Peminjaman ({{ $returnedLoans->total() }})
        </h3>

        @if($returnedLoans->count() > 0)
            <table style="width:100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="background: #f1f5f9;">
                        <th style="padding: 12px;">Judul Buku</th>
                        <th style="padding: 12px;">Pengarang</th>
                        <th style="padding: 12px;">Tanggal Pinjam</th>
                        <th style="padding: 12px;">Tanggal Dikembalikan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($returnedLoans as $loan)
                    <tr>
                        <td style="padding: 12px;"><strong>{{ $loan->book->name }}</strong></td>
                        <td style="padding: 12px;">{{ $loan->book->author?->name ?? '-' }}</td>
                        <td style="padding: 12px;">{{ $loan->loan_date->format('d M Y') }}</td>
                        <td style="padding: 12px;">{{ $loan->actual_return_date?->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($returnedLoans->hasPages())
                <div style="margin-top: 16px; display: flex; justify-content: center;">
                    {{ $returnedLoans->links() }}
                </div>
            @endif
        @else
            <p style="color: #6b7280; text-align: center; padding: 20px; margin: 0;">
                Belum ada riwayat peminjaman
            </p>
        @endif
    </div>

</div>
@endsection
