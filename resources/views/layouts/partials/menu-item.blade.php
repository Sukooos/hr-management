@php
    $hasChildren = isset($menu->children) && count($menu->children) > 0;
    $isActive = request()->is(ltrim($menu->url ?? '', '/')) ? 'active' : '';
    $menuId = 'menu-' . $menu->id;
@endphp

@if(!$hasChildren)
    <a href="{{ $menu->url ?? '#' }}" class="btn btn-outline-primary w-100 text-start mb-1 {{ $isActive }}">
        @if($menu->icon)<i class="{{ $menu->icon }}"></i> @endif
        {{ $menu->name }}
    </a>
@else
    <div class="accordion" id="{{ $menuId }}">
        <button
            class="btn btn-outline-primary d-flex justify-content-between align-items-center w-100 text-start mb-1"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapse-{{ $menuId }}"
            aria-expanded="false">
            <span>
                @if($menu->icon)<i class="{{ $menu->icon }}"></i> @endif
                {{ $menu->name }}
            </span>
            <i class="bi bi-chevron-down ms-2"></i>
        </button>
        <div
            id="collapse-{{ $menuId }}"
            class="collapse"
            data-bs-parent="#{{ $menuId }}">
            <div class="ms-3">
                @foreach($menu->children as $child)
                    @include('layouts.partials.menu-item', ['menu' => $child])
                @endforeach
            </div>
        </div>
    </div>
@endif