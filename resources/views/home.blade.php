@extends('layouts.app')
@section('pagetitle', 'Dashboard')
@section('content')
    <h2>Welcome, {{ Auth::user()->name }}</h2>
    <div class="alert alert-success mt-4">Selamat datang di HR Management System.</div>
@endsection
