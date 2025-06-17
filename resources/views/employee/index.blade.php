@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Karyawan</h3>
    <a href="{{ route('karyawan.create') }}" class="btn btn-primary">Tambah Karyawan</a>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered" id="datatable-karyawan">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Dibuat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $emp)
        <tr>
            <td>{{ $emp->name }}</td>
            <td>{{ $emp->email }}</td>
            <td>{{ $emp->created_at }}</td>
            <td>
                <a href="{{ route('karyawan.edit', $emp->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('karyawan.destroy', $emp->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus karyawan ini?')" class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#datatable-karyawan').DataTable({
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya"
            }
        }
    });
});
</script>
@endpush
