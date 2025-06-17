<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::getAll();
        return view('department.index', compact('departments'));
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        Department::create($request->only('name'));
        return redirect()->route('departments.index')->with('success', 'Department berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $department = Department::getById($id);
        return view('department.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        Department::updateById($id, $request->only('name'));
        return redirect()->route('departments.index')->with('success', 'Department berhasil diupdate!');
    }

    public function destroy($id)
    {
        Department::softDelete($id);
        return redirect()->route('departments.index')->with('success', 'Department berhasil dihapus!');
    }
}
