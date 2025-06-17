<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap 5 + icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <style>
        body { background: #f8fafc; }
        .sidebar {
            min-width: 220px;
            min-height: 100vh;
            background: #fff;
            border-right: 1px solid #e5e7eb;
        }
        .sidebar .btn {
            text-align: left;
        }
        .sidebar .btn.active, .sidebar .btn:hover {
            background: #2563eb;
            color: #fff;
        }
        @media (max-width: 768px) {
            .sidebar { min-width: 100px; }
        }
        main.container {
            min-height: 75vh;
        }
        .card {
            background: #fff;
            max-width: 1250px;
            min-height: 80vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="d-flex flex-nowrap">
    @include('layouts.partials.sidebar', ['menuTree' => $menuTree])
    <div class="flex-grow-1">
        @include('layouts.partials.navbar')
        <main class="container mt-4">
            <div class="card shadow-sm rounded-4 p-3">
                @yield('content')
            </div>
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<!-- jQuery (wajib) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
@stack('scripts')
</body>
</html>
