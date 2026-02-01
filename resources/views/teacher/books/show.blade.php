@extends('layouts.teacher')

@section('title', 'Detail Buku')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 0 16px;">

    {{-- NOTIF --}}
    @if(session('success'))
        <div style="margin-bottom:16px;padding:12px;border-radius:8px;background:#ecfdf5;color:#065f46;font-weight:600;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="margin-bottom:16px;padding:12px;border-radius:8px;background:#fef2f2;color:#991b1b;font-weight:600;">
            {{ session('error') }}
        </div>
    @endif

    <div style="background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.05);overflow:hidden">

        {{-- HEADER --}}
        <div style="padding:24px;border-bottom:1px solid #e5e7eb;display:flex;gap:24px">

            {{-- COVER --}}
            <div style="width:180px;height:260px;background:#e5e7eb;border-radius:8px;flex-shrink:0;display:flex;align-items:center;justify-content:center">
                @if($book->cover_image)
                    <img src="{{ asset('storage/'.$book->cover_image) }}"
                         style="width:100%;height:100%;object-fit:cover;border-radius:8px">
                @else
                    📖
                @endif
            </div>

            {{-- INFO --}}
            <div style="flex:1">
                <h1 style="margin:0 0 8px;font-size:24px">{{ $book->name }}</h1>

                <p><strong>Penulis:</strong> {{ $book->author?->name ?? '-' }}</p>
                <p><strong>Penerbit:</strong> {{ $book->publisher?->name ?? '-' }}</p>
                <p><strong>Kategori:</strong> {{ $book->category?->name ?? '-' }}</p>
                <p><strong>Stok:</strong> {{ $book->stok }}</p>

                {{-- ACTION BUTTONS --}}
                <div style="margin-top:16px;display:flex;gap:8px;flex-wrap:wrap">
                    <button onclick="history.back()"
                        style="padding:8px 16px;background:#e5e7eb;border:none;border-radius:6px;font-weight:600;cursor:pointer">
                        ← Kembali
                    </button>
                </div>
            </div>
        </div>

        {{-- DESKRIPSI --}}
        @if($book->description)
        <div style="padding:24px">
            <h3>Deskripsi</h3>
            <p style="line-height:1.6">{{ $book->description }}</p>
        </div>
        @endif
    </div>

</div>

@endsection
