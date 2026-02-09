@extends('layouts.student')

@section('title', 'Detail Buku')

@section('content')
<div style="max-width: 100%;">
    <a href="{{ route('student.books.index') }}" style="color: #2563eb; text-decoration: none; font-weight: 600; margin-bottom: 16px; display: inline-block;">
        ← Kembali ke Daftar Buku
    </a>

    <div style="background: white; border-radius: 8px; padding: 24px; border: 1px solid #e2e8f0; margin-bottom: 24px;">

        {{-- HEADER --}}
        <div style="display: flex; gap: 24px; margin-bottom: 24px;">

            {{-- COVER --}}
            <div style="width: 200px; height: 300px; background: #e5e7eb; border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                @if($book->cover_image)
                    <img src="{{ asset('storage/'.$book->cover_image) }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                @else
                    <div style="font-size: 64px;">📖</div>
                @endif
            </div>

            {{-- INFO --}}
            <div style="flex: 1;">
                <h1 style="margin: 0 0 16px; font-size: 28px;">{{ $book->name }}</h1>

                <p style="margin: 8px 0;"><strong>Pengarang:</strong> {{ $book->author?->name ?? '-' }}</p>
                <p style="margin: 8px 0;"><strong>Penerbit:</strong> {{ $book->publisher?->name ?? '-' }}</p>
                <p style="margin: 8px 0;"><strong>Kategori:</strong> {{ $book->category?->name ?? '-' }}</p>
                <p style="margin: 8px 0;"><strong>Tahun:</strong> {{ $book->publication_date?->format('Y') ?? '-' }}</p>
                <p style="margin: 8px 0;">
                    <strong>Stok:</strong> 
                    @if($book->stok > 0)
                        <span style="color: #10b981; font-weight: 600;">✓ Tersedia ({{ $book->stok }})</span>
                    @else
                        <span style="color: #dc2626; font-weight: 600;">✗ Tidak Tersedia</span>
                    @endif
                </p>

                {{-- ACTION BUTTONS --}}
                <div style="margin-top: 24px; display: flex; gap: 12px; flex-wrap: wrap;">
                    @if($loan)
                        {{-- Book is already borrowed --}}
                        <button disabled style="padding: 12px 24px; background: #fbbf24; color: #78350f; border: none; border-radius: 6px; font-weight: 600; cursor: default;">
                            ✓ Buku Dipinjam
                        </button>
                    @elseif($book->stok > 0)
                        {{-- Book is available to borrow --}}
                        <form method="POST" action="{{ route('student.books.borrow', $book->id) }}" style="display: inline;">
                            @csrf
                            <button type="submit" style="padding: 12px 24px; background: #10b981; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">
                                📚 Pinjam Buku
                            </button>
                        </form>
                    @else
                        {{-- Book is out of stock --}}
                        <button disabled style="padding: 12px 24px; background: #d1d5db; color: #6b7280; border: none; border-radius: 6px; font-weight: 600; cursor: default;">
                            ❌ Tidak Tersedia
                        </button>
                    @endif
                </div>
            </div>
        </div>

        {{-- DESKRIPSI --}}
        @if($book->description)
        <div style="border-top: 1px solid #e2e8f0; padding-top: 24px;">
            <h3 style="margin: 0 0 12px; font-size: 16px; font-weight: 700;">Deskripsi</h3>
            <p style="margin: 0; line-height: 1.6; color: #475569;">{{ $book->description }}</p>
        </div>
        @endif
        
        {{-- ULASAN & RATING --}}
        <div style="margin-top: 16px; border-top: 1px solid #e2e8f0; padding-top: 24px;">
            <h3 style="margin: 0 0 12px; font-size: 16px; font-weight: 700;">Ulasan & Rating</h3>

            @if(isset($averageRating) && $averageRating)
                <p style="margin: 0 0 12px; font-weight: 600; color: #1f2937;">Rata-rata: {{ number_format($averageRating, 1) }} ⭐</p>
            @else
                <p style="margin: 0 0 12px; color: #6b7280;">Belum ada rating.</p>
            @endif

            @if(isset($reviews) && $reviews->isNotEmpty())
                <div style="display:flex; flex-direction:column; gap:12px;">
                    @foreach($reviews as $rev)
                        <div style="background:#fff; border:1px solid #e6eef8; padding:12px; border-radius:8px;">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                                <div style="font-weight:700; color:#0f172a;">{{ $rev->user?->name ?? 'Anonim' }}</div>
                                <div style="background:#fef3c7; color:#92400e; padding:4px 8px; border-radius:6px; font-weight:700;">{{ $rev->rating }} ⭐</div>
                            </div>
                            <div style="color:#475569; line-height:1.6;">{{ $rev->review ?? '-' }}</div>
                            <div style="margin-top:8px; font-size:12px; color:#9ca3af;">{{ $rev->created_at->format('d M Y') }}</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div style="background: #d1fae5; border: 1px solid #6ee7b7; border-radius: 8px; padding: 16px; color: #065f46;">
            {{ session('success') }}
        </div>
    @endif


    @if(session('error'))
        <div style="background: #fee2e2; border: 1px solid #fecaca; border-radius: 8px; padding: 16px; color: #991b1b;">
            {{ session('error') }}
        </div>
    @endif
</div>
@endsection
