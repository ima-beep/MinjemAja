@extends('layouts.student')

@section('title', 'Ulasan Saya')

@section('content')
<div style="max-width: 1000px;">
    <h1>⭐ Rating & Review</h1>

    @if(session('success'))
        <div style="background:#dcfce7; border:1px solid #86efac; padding:12px; border-radius:6px; margin-bottom:12px; color:#166534;">{{ session('success') }}</div>
    @endif

    <div class="box" style="margin-bottom:20px;">
        <h3>Buku yang bisa Anda ulas</h3>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Pengarang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td><strong>{{ $book->name }}</strong></td>
                    <td>{{ $book->author?->name ?? '-' }}</td>
                    <td>
                        @php $existing = $reviews->firstWhere('book_id', $book->id); @endphp
                        @if($existing)
                            <span style="background:#d1fae5; color:#065f46; padding:6px 10px; border-radius:6px;">Sudah Diulas</span>
                        @else
                            <a href="{{ route('student.reviews.create', $book->id) }}" style="background:#2563eb; color:#fff; padding:6px 10px; border-radius:6px; text-decoration:none;">Ulasan</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="box">
        <h3>Ulasan Anda</h3>
        @if($reviews->isEmpty())
            <p>Belum ada ulasan.</p>
        @else
            <table style="width:100%;">
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Rating</th>
                        <th>Ulasan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $r)
                    <tr>
                        <td>{{ $r->book->name }}</td>
                        <td>{{ $r->rating }} ⭐</td>
                        <td>{{ $r->review ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
