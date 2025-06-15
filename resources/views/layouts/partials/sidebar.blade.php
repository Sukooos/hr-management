<div class="sidebar py-4 px-3 bg-light border-end" style="width: 250px;">
    <div class="mb-4 fs-5 fw-bold">HR Management</div>
    <div class="accordion" id="sidebarMenu">
        @foreach($menuTree as $menu)
            @include('layouts.partials.menu-item', ['menu' => $menu])
        @endforeach
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-outline-danger w-100 text-start mt-3">Logout</button>
    </form>
</div>