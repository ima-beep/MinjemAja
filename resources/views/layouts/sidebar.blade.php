@auth
<style>
    .sidebar-nav a {
        padding: 12px 16px;
        border-radius: 8px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #6b7280;
        transition: all 0.2s;
    }

    .sidebar-nav a.active {
        background: #eff6ff;
        color: #2563eb;
        font-weight: 600;
    }
</style>

<aside style="width: 250px; background: #ffffff; padding: 0; min-height: 100vh; position: fixed; left: 0; top: 0; overflow-y: auto; box-shadow: 2px 0 10px rgba(0,0,0,.05); border-right: 1px solid #e5e7eb;">
    <div style="padding: 16px 24px; border-bottom: 2px solid #e5e7eb; position: sticky; top: 0; background: #ffffff;">
        <a href="{{ route('dashboard') }}" class="logo" style="display: flex; align-items: center; gap: 8px;">
            <span>📚</span>
            <span>MinjemAja</span>
        </a>
    </div>
    <div style="padding: 24px;">
        <nav style="display: flex; flex-direction: column; gap: 8px;" class="sidebar-nav">
            @if(Auth::user()->role === 'admin')
                <!-- MENU ADMIN (sebelumnya: GURU) -->
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span style="font-size: 18px;">📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.books.index') }}" class="{{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                    <span style="font-size: 18px;">📖</span>
                    <span>Kelola Buku</span>
                </a>
                <a href="{{ route('admin.publishers.index') }}" class="{{ request()->routeIs('admin.publishers.*') ? 'active' : '' }}">
                    <span style="font-size: 18px;">🏢</span>
                    <span>Penerbit</span>
                </a>
                <a href="{{ route('admin.reviews.index') }}" class="{{ request()->routeIs('admin.reviews.*') || request()->routeIs('admin.reviews.index') ? 'active' : '' }}">
                    <span style="font-size: 18px;">⭐</span>
                    <span>Rating / Review</span>
                </a>
                <a href="{{ route('admin.authors.index') }}" class="{{ request()->routeIs('admin.authors.*') ? 'active' : '' }}">
                    <span style="font-size: 18px;">✍️</span>
                    <span>Pengarang</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <span style="font-size: 18px;">🏷️</span>
                    <span>Kategori</span>
                </a>
            @else
                <!-- MENU SISWA -->
                <a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                    <span style="font-size: 18px;">📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('student.books.index') }}" class="{{ request()->routeIs('student.books.*') ? 'active' : '' }}">
                    <span style="font-size: 18px;">📖</span>
                    <span>Kumpulan Buku</span>
                </a>
                <a href="{{ route('student.loans.index') }}" class="{{ request()->routeIs('student.loans.*') ? 'active' : '' }}">
                    <span style="font-size: 18px;">📋</span>
                    <span>Peminjaman</span>
                </a>
                <a href="{{ route('student.fines.index') }}" class="{{ request()->routeIs('student.fines.*') ? 'active' : '' }}">
                    <span style="font-size: 18px;">💰</span>
                    <span>Denda</span>
                </a>
                <a href="{{ route('student.reviews.index') }}" class="{{ request()->routeIs('student.reviews.*') ? 'active' : '' }}">
                    <span style="font-size: 18px;">⭐</span>
                    <span>Rating / Review</span>
                </a>
            @endif
        </nav>
    </div>
</aside>
@endauth
