@extends('layouts.admin')

@section('title', 'Penerbit')
@section('page_title', 'Manajemen Penerbit')

@section('content')
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">

        <!-- Add Publisher Button -->
        <div style="margin-bottom: 20px;">
            <a href="{{ route('admin.publishers.create') }}"
               style="display: inline-block; padding: 10px 16px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 6px; font-weight: 600;">
                + Tambah Penerbit
            </a>
        </div>

@if(session('success'))
<div style="margin-bottom:16px;padding:12px;background:#dcfce7;color:#166534;border-radius:6px">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div style="margin-bottom:16px;padding:12px;background:#fee2e2;color:#991b1b;border-radius:6px">
    {{ session('error') }}
</div>
@endif

{{-- ===== KOTAK PUTIH JIKA BELUM ADA PENERBIT ===== --}}
@if($publishers->count() === 0)
<div style="
    background:#fff;
    border-radius:10px;
    padding:32px;
    text-align:center;
    color:#6b7280;
    border:1px solid #e5e7eb;
">
    Belum ada penerbit
</div>
@else

{{-- ===== LIST PENERBIT ===== --}}
@foreach($publishers as $publisher)
<div style="background:#fff;border-radius:10px;margin-bottom:16px;border:1px solid #e5e7eb">

<div style="padding:16px;display:flex;justify-content:space-between;align-items:center;background:#f8fafc">
    <div>
        <h3 style="margin:0;color:#0f172a">{{ $publisher->name }}</h3>
        <p style="margin:4px 0;color:#6b7280;font-size:14px">
            {{ data_get($publisher,'address','-') }}
        </p>
        <p style="margin:0;color:#6b7280;font-size:14px">
            {{ data_get($publisher,'phone','-') }} |
            {{ data_get($publisher,'email','-') }}
        </p>
        <small style="color:#6b7280">
            {{ $publisher->books->count() }} buku
        </small>
    </div>

    <div style="display:flex;gap:8px">
        <button class="btn-toggle-books"
            data-id="{{ $publisher->id }}"
            style="flex:0 0 140px;padding:8px 12px;background:#10b981;color:#fff;border:none;border-radius:4px;font-size:12px;font-weight:600;cursor:pointer;">
            📚 Lihat ({{ $publisher->books->count() }})
        </button>

        <a href="{{ route('admin.publishers.edit',$publisher) }}"
           style="flex:0 0 80px;padding:8px 12px;background:#2563eb;color:#fff;border-radius:4px;font-size:12px;text-decoration:none;text-align:center;font-weight:600;">
           Edit
        </a>

        <form method="POST" action="{{ route('admin.publishers.destroy',$publisher) }}" style="flex:0 0 80px;">
            @csrf @method('DELETE')
            <button onclick="return confirm('Hapus penerbit?')"
                style="width:100%;padding:8px 12px;background:#dc2626;color:#fff;border:none;border-radius:4px;font-size:12px;font-weight:600;cursor:pointer;">
                Hapus
            </button>
        </form>
    </div>
</div>

<div id="books-{{ $publisher->id }}" style="display:none;margin-top:16px;background:#fff;border-radius:10px;padding:20px;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
        <div>
            <strong style="font-size:16px;">Buku {{ $publisher->name }}</strong>
            <p style="margin:4px 0 0;font-size:14px;color:#6b7280;">
                Total: <strong style="color:#2563eb;">{{ $publisher->books->count() }}</strong> buku terdaftar
            </p>
        </div>
        <button onclick="document.getElementById('books-{{ $publisher->id }}').style.display='none'"
            style="background:#e5e7eb;border:none;padding:6px 12px;border-radius:4px;cursor:pointer;">
            Tutup
        </button>
    </div>

    @if($publisher->books->count() > 0)
        <div style="display:grid;grid-template-columns:repeat(4, 1fr);gap:16px;">
            @foreach($publisher->books as $book)
                <a href="{{ route('admin.books.show', $book->id) }}" style="text-decoration: none; color: inherit;">
                    <div style="border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;cursor:pointer;transition:all 0.3s ease;height:100%;" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)';this.style.transform='translateY(-4px)';this.style.borderColor='#2563eb';" onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)';this.style.borderColor='#e5e7eb';">
                        <div style="width:100%;height:150px;background:#e5e7eb;display:flex;align-items:center;justify-content:center;">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div style="font-size:32px;">📖</div>
                            @endif
                        </div>
                        <div style="padding:12px;">
                            <h4 style="margin:0 0 4px;font-size:14px;">{{ $book->name }}</h4>
                            <p style="margin:0;font-size:12px;color:#6b7280;">
                                Penulis: {{ $book->author?->name ?? '-' }}
                            </p>
                            <p style="margin:0;font-size:12px;color:#6b7280;">
                                {{ $book->publication_date?->format('d M Y') ?? '-' }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <p style="color:#6b7280;font-style:italic;">Belum ada buku diterbitkan oleh penerbit ini</p>
    @endif
</div>

</div>
@endforeach
@endif

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-toggle-books').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const el = document.getElementById('books-' + id);
            el.style.display = el.style.display === 'none' || el.style.display === '' ? 'block' : 'none';
        });
    });
});
</script>
@endsection
