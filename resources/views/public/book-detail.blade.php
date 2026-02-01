@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')

<style>
    body {
        background: #f3f4f6;
    }

    .detail-wrapper {
        max-width: 900px;
        margin: 80px auto;
        padding: 0 16px;
    }

    .back-link {
        display: inline-block;
        margin-bottom: 16px;
        text-decoration: none;
        color: #2563eb;
        font-weight: 500;
    }

    .detail-card {
        background: #ffffff;
        padding: 36px;
        border-radius: 18px;
        box-shadow: 0 15px 35px rgba(0,0,0,.08);
    }

    .book-title {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 12px;
        color: #111827;
    }

    .book-meta {
        margin-bottom: 24px;
        color: #374151;
        line-height: 1.8;
    }

    .book-meta span {
        display: block;
    }

    .divider {
        height: 1px;
        background: #e5e7eb;
        margin: 24px 0;
    }

    .action-area {
        margin-top: 16px;
    }

    .btn {
        display: inline-block;
        padding: 12px 26px;
        font-size: 15px;
        font-weight: 600;
        border-radius: 10px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: .3s;
    }

    .btn-primary {
        background: #2563eb;
        color: #fff;
    }

    .btn-primary:hover {
        background: #1d4ed8;
    }

    .btn-outline {
        border: 2px solid #2563eb;
        color: #2563eb;
        background: transparent;
    }

    .btn-outline:hover {
        background: #2563eb;
        color: #fff;
    }

    .hint-text {
        color: #6b7280;
        margin-bottom: 12px;
    }
</style>

<div class="detail-wrapper">

    <a href="{{ route('dashboard') }}" class="back-link">
        ← Kembali ke Dashboard
    </a>

    <div class="detail-card">

        <h1 class="book-title">
            {{ $book->name }}
        </h1>

        <div class="book-meta">
            <span><strong>Penulis:</strong> {{ $book->author?->name ?? '-' }}</span>
            <span><strong>Penerbit:</strong> {{ $book->publisher?->name ?? '-' }}</span>
            <span><strong>Kategori:</strong> {{ $book->category?->name ?? '-' }}</span>
        </div>

        <div class="divider"></div>

        <div class="action-area">
            @auth
                <form method="POST" action="{{ route('loans.store') }}">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">

                    <button type="submit" class="btn btn-primary">
                        📥 Pinjam Buku
                    </button>
                </form>
            @else
                <p class="hint-text">
                    Login atau daftar untuk meminjam buku
                </p>

                <a href="{{ route('login') }}" class="btn btn-primary">
                    Login
                </a>

                <a href="{{ route('register') }}" class="btn btn-outline" style="margin-left:8px">
                    Daftar
                </a>
            @endauth
        </div>

    </div>
</div>

@endsection
