@extends('layouts.teacher')

@section('title', 'Edit Pembayaran Denda')

@section('content')
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
        <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 24px;">💰 Edit Pembayaran Denda</h1>

        <form method="POST" action="{{ route('teacher.fines.update', $loan->id) }}" style="margin: 0; padding: 0; width: 100%; box-sizing: border-box;">
            @csrf
            @method('PUT')

            <div style="display: flex; flex-direction: column; gap: 18px; width: 100%;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Anggota</label>
                <p style="margin: 0; padding: 10px 12px; background: #f1f5f9; border-radius: 6px;">{{ $loan->guest_name }}</p>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Buku</label>
                <p style="margin: 0; padding: 10px 12px; background: #f1f5f9; border-radius: 6px;">{{ $loan->book->name }}</p>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Hari Terlambat</label>
                <p style="margin: 0; padding: 10px 12px; background: #f1f5f9; border-radius: 6px;">{{ $daysDue }} hari</p>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Jumlah Denda</label>
                <p style="margin: 0; padding: 10px 12px; background: #fef2f2; border-radius: 6px; color: #dc2626; font-weight: 600;">
                    Rp {{ number_format($fineAmount, 0, ',', '.') }}
                </p>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Jumlah Dibayar</label>
                <input type="number" name="amount_paid" value="{{ old('amount_paid', $loan->fine_amount_paid ?? 0) }}" min="0" max="{{ $fineAmount }}" step="1000" required
                    style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                @error('amount_paid')
                    <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Tanggal Pembayaran</label>
                <input type="date" name="payment_date" value="{{ old('payment_date', $loan->fine_payment_date ? $loan->fine_payment_date->format('Y-m-d') : now()->format('Y-m-d')) }}" required
                    style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                @error('payment_date')
                    <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; color: #1e293b; font-weight: 600; font-size: 14px;">Catatan</label>
                <textarea name="notes" rows="4" placeholder="Catatan pembayaran denda" 
                    style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; font-family: inherit; resize: vertical;">{{ old('notes', $loan->fine_notes ?? '') }}</textarea>
                @error('notes')
                    <p style="color: #dc2626; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: flex; gap: 12px; margin-top: auto; border-top: 1px solid #e5e7eb; padding-top: 24px;">
                <button type="submit" style="flex: 0 1 200px; padding: 12px 16px; background: #2563eb; color: #fff; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 14px;">
                    Simpan Pembayaran
                </button>
                <a href="{{ route('teacher.fines.index') }}" style="flex: 0 1 200px; padding: 12px 16px; background: #e5e7eb; color: #0f172a; text-align: center; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 14px;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
