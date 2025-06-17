@extends('layouts.app')
@section('content')
<h3>Edit Karyawan</h3>
<form action="{{ route('karyawan.update', $employee->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" value="{{ $employee->name }}" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $employee->email }}" required>
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
