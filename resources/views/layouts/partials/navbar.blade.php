<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 py-2 mb-3">
    <div class="container-fluid justify-content-between">
        <span class="navbar-brand mb-0 h5">@yield('pagetitle', 'Dashboard')</span>
        <div>
            <span class="me-3">{{ Auth::user()->name ?? '' }}</span>
            {{-- Bisa tambah notifikasi, avatar, dsb di sini --}}
        </div>
    </div>
</nav>
