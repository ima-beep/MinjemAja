@extends('layouts.admin')

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

@section('title', 'Dashboard Admin')

@section('content')
<div style="max-width: 1400px;">

    <h1>📊 Dashboard Admin</h1>

    {{-- STATISTIK --}}
    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin-bottom:32px;">

        <div class="stat-card">
            <div class="stat-info">
                <p>📚 Total Buku</p>
                <h2>{{ $totalBooks }}</h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <p>👨‍🎓 Total Siswa</p>
                <h2>{{ $totalStudents }}</h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <p>📖 Peminjaman Aktif</p>
                <h2>{{ $activeLoans }}</h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <p>✓ Dikembalikan</p>
                <h2>{{ $returnedLoans }}</h2>
            </div>
        </div>

    </div>

    <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:32px;" class="grid-2">

        {{-- PEMINJAMAN TERBARU --}}
        <div class="box">
            <h3>📖 Peminjaman Terbaru</h3>

            <table width="100%">
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentLoans as $loan)
                        <tr>
                            <td>
                                <strong>{{ $loan->book->name }}</strong><br>
                                <small>{{ $loan->book->author->name ?? '-' }}</small>
                            </td>
                            <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                            <td>
                                <span class="status-badge {{ $loan->status === 'active' ? 'active' : 'returned' }}">
                                    {{ $loan->status === 'active' ? 'Aktif' : 'Dikembalikan' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align:center; padding:20px; color:#64748b;">
                                Belum ada peminjaman
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- SISWA SEDANG MEMINJAM --}}
        <div class="box">
            <h3>👨‍🎓 Siswa Sedang Meminjam</h3>

            <table width="100%">
                <thead>
                    <tr>
                        <th>Siswa</th>
                        <th>Buku</th>
                        <th>Tgl Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activeStudentLoans as $loan)
                        <tr>
                            <td>{{ $loan->guest_name }}</td>
                            <td>{{ $loan->book->name }}</td>
                            <td>{{ $loan->return_date->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align:center; padding:20px; color:#64748b;">
                                Tidak ada siswa yang meminjam
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
