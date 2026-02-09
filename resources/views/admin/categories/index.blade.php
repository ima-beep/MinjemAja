@extends('layouts.admin')

@section('title', 'Kategori')
@section('page_title', 'Manajemen Kategori')

@section('content')
<div style="width: 76vw; min-height: 100vh; display: flex; flex-direction: column; background: #f8fafc; margin: 0; padding: 0; overflow-x: hidden;">
    <div style="flex: 1; display: flex; flex-direction: column; padding: 20px 0; margin: 0;">
        <!-- Add Category Button -->
        <div style="margin-bottom: 20px;">
            <a href="{{ route('admin.categories.create') }}"
               style="display: inline-block; padding: 10px 16px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 6px; font-weight: 600;">
                + Tambah Kategori
            </a>
        </div>

        <!-- Content Card -->
        <div style="background:#fff; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,.04); flex: 1; overflow-y: auto;">
            <div style="padding:20px;">

        @if($categories->count() > 0)

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #e5e7eb; background: #f9fafb;">
                        <th style="padding: 12px; text-align: left;">Nama Kategori</th>
                        <th style="padding: 12px; text-align: left;">Deskripsi</th>
                        <th style="padding: 12px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px;"><strong>{{ $category->name }}</strong></td>
                            <td style="padding: 12px;">{{ $category->description ?? '-' }}</td>
                            <td style="padding: 12px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       style="padding: 6px 12px; background: #3b82f6; color: #fff; border-radius: 4px; text-decoration: none; font-size: 12px; font-weight: 600;">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                style="padding: 6px 12px; background: #ef4444; color: #fff; border: none; border-radius: 4px; font-size: 12px; font-weight: 600; cursor: pointer;"
                                                onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @else
            {{-- ISI KOTAK PUTIH --}}
            <div style="
                text-align: center;
                color: #6b7280;
                padding: 32px 0;
            ">
                Belum ada kategori
            </div>
        @endif

            </div>
        </div>

    </div>
</div>

@endsection
