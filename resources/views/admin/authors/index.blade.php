@extends('layouts.admin')

@section('title', 'Pengarang')
@section('page_title', 'Manajemen Pengarang')

@section('content')
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">

        <!-- Add Author Button -->
        <div style="margin-bottom: 20px;">
            <a href="{{ route('admin.authors.create') }}"
               style="display: inline-block; padding: 10px 16px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 6px; font-weight: 600;">
                + Tambah Pengarang
            </a>
        </div>

        <!-- Alert -->
        @if(session('success'))
            <div style="margin-bottom: 16px; padding: 12px; background: #dcfce7; color: #166534; border-radius: 6px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- List Authors -->
        <div style="background:#fff; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,.04); flex: 1; overflow-y: auto;">
            <div style="padding:20px;">

            @forelse($authors as $author)
                <div style="display:flex; justify-content:space-between; align-items:center; padding:16px 0; border-bottom:1px solid #e5e7eb;">
                    <div>
                        <strong>{{ $author->name }}</strong><br>
                        <small style="color:#6b7280;">Lahir: {{ $author->birth_date?->format('d F Y') ?? '-' }}</small><br>
                        <small style="color:#6b7280;">{{ $author->books_count }} buku</small>
                    </div>

                    <div style="display:flex; gap:8px;">
                        <button class="btn-toggle-books"
                            data-id="{{ $author->id }}"
                            style="flex:0 0 140px; padding:8px 12px; background:#10b981; color:#fff; border:none; border-radius:4px; font-weight:600; font-size:12px; text-align:center; cursor:pointer;">
                            📚 Lihat ({{ $author->books->count() }})
                        </button>

                        <a href="{{ route('admin.authors.edit', $author) }}"
                           style="flex:0 0 80px; padding:8px 12px; background:#2563eb; color:#fff; border-radius:4px; text-decoration:none; font-weight:600; font-size:12px; text-align:center;">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('admin.authors.destroy', $author) }}"
                              onsubmit="return confirm('Yakin hapus?')" style="flex:0 0 80px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                style="width:100%; padding:8px 12px; background:#dc2626; color:#fff; border:none; border-radius:4px; font-weight:600; font-size:12px; cursor:pointer;">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Books Section for this Author -->
                <div id="books-{{ $author->id }}" style="display:none; background:#f8fafc; padding:16px 0; border-bottom:1px solid #e5e7eb;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; padding:0 16px;">
                        <div>
                            <strong style="font-size:16px;">Buku oleh {{ $author->name }}</strong>
                            <p style="margin:4px 0 0; font-size:14px; color:#6b7280;">
                                Total: <strong style="color:#2563eb;">{{ $author->books->count() }}</strong> buku terdaftar
                            </p>
                        </div>
                    </div>
                    @if($author->books->count() > 0)
                        <div style="display:grid; grid-template-columns:repeat(4, 1fr); gap:16px; padding:0 16px;">
                            @foreach($author->books as $book)
                                <a href="{{ route('admin.books.show', $book->id) }}" style="text-decoration: none; color: inherit;">
                                    <div style="border:1px solid #e5e7eb; border-radius:8px; overflow:hidden; cursor:pointer; transition:all 0.3s ease; height:100%;" onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'; this.style.transform='translateY(-4px)'; this.style.borderColor='#2563eb';" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'; this.style.borderColor='#e5e7eb';">
                                        <div style="width:100%; height:150px; background:#e5e7eb; display:flex; align-items:center; justify-content:center;">
                                            @if($book->cover_image)
                                                <img src="{{ asset('storage/' . $book->cover_image) }}" style="width:100%; height:100%; object-fit:cover;">
                                            @else
                                                <div style="font-size:32px;">📖</div>
                                            @endif
                                        </div>
                                        <div style="padding:12px;">
                                            <h4 style="margin:0 0 4px; font-size:14px;">{{ $book->name }}</h4>
                                            <p style="margin:0; font-size:12px; color:#6b7280;">
                                                Penerbit: {{ $book->publisher?->name ?? '-' }}
                                            </p>
                                            <p style="margin:0; font-size:12px; color:#6b7280;">
                                                {{ $book->publication_date?->format('d M Y') ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p style="color:#6b7280; font-style:italic; padding:0 16px;">Belum ada buku ditulis oleh pengarang ini</p>
                    @endif
                </div>
            @empty
                <p style="text-align:center; color:#6b7280;">Belum ada pengarang</p>
            @endforelse

            </div>
        </div>

    </div>
</div>

<script>
document.querySelectorAll('.btn-toggle-books').forEach(btn => {
    btn.onclick = () => {
        const el = document.getElementById('books-' + btn.dataset.id);
        el.style.display = el.style.display === 'block' ? 'none' : 'block';
    }
});
</script>
@endsection
