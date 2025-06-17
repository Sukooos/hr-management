<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search', '');
        $sort = $request->input('sort', 'created_at');
        $order = $request->input('order', 'desc');
        $page = $request->input('page', 1);
        $perPage = 10; // Bisa diubah

        $result = \App\Models\Employee::getList($search, $sort, $order, $perPage, $page);
        $employees = $result['data'];
        $total = $result['total'];

        return view('employee.index', compact('employees', 'search', 'sort', 'order', 'page', 'perPage', 'total'));
    }

    public function create() {
        return view('employee.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
        ]);
        Employee::store($request->only(['name', 'email']));
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    public function edit($id) {
        $employee = Employee::find($id);
        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,'.$id.',id',
        ]);
        Employee::updateById($id, $request->only(['name', 'email']));
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diupdate!');
    }

    public function destroy($id) {
        Employee::softDelete($id);
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus!');
    }
}
