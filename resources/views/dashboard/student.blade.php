@extends('layouts.student')

@push('styles')
<style>
.stat-card {
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: white;
    border-radius: 8px;
    padding: 40px 32px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    text-align: center;
    min-height: 200px;
}
.stat-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}
.stat-info {
    flex: 1;
}
.stat-info p {
    margin: 0 0 14px 0;
    font-size: 14px;
    color: #64748b;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.5px;
}
.stat-info h2 {
    margin: 0;
    font-size: 56px;
    font-weight: 700;
    color: #2563eb;
}
.stat-icon {
    font-size: 48px;
    margin-left: 20px;
    opacity: 0.8;
}

.status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.status-badge.active {
    background: #fef3c7;
    color: #92400e;
}
.status-badge.returned {
    background: #d1fae5;
    color: #065f46;
}
</style>
@endpush

@section('title', 'Dashboard Siswa')

@section('content')
<div style="max-width: 1400px;">

    <h1>📊 Dashboard Siswa</h1>

    {{-- STATISTIK --}}
    <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:20px; margin-bottom:32px;">

        <div class="stat-card">
            <div class="stat-info">
                <p>📚 Total Buku</p>
                <h2>{{ $totalBooks }}</h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <p>📋 Sedang Dipinjam</p>
                <h2>{{ $activeLoans }}</h2>
            </div>
        </div>

    </div>

    {{-- PINJAMAN AKTIF --}}
    @if($loans->count() > 0)
    <div class="box" style="margin-bottom: 32px;">
        <h3>Buku yang Sedang Dipinjam</h3>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $loan)
                <tr>
                    <td><strong>{{ $loan->book->name }}</strong></td>
                    <td>{{ $loan->book->author?->name ?? '-' }}</td>
                    <td>{{ $loan->loan_date->format('d M Y') }}</td>
                    <td>{{ $loan->return_date->format('d M Y') }}</td>
                    <td>
                        @if($loan->status === 'active')
                            <span class="status-badge active">Aktif</span>
                        @else
                            <span class="status-badge returned">Dikembalikan</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 20px; margin-bottom: 32px; color: #1e40af;">
        <strong>ℹ️ Belum ada peminjaman</strong><br>
        <small>Anda belum meminjam buku. Kunjungi halaman <a href="{{ route('student.books.index') }}" style="color: #1e40af; text-decoration: underline;">Kumpulan Buku</a> untuk mulai meminjam.</small>
    </div>
    @endif

</div>
@endsection
