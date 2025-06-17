<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobVacancy;
use App\Models\Department;

class JobVacancyController extends Controller
{
    public function index()
    {
        $vacancies = JobVacancy::all();
        return view('job_vacancy.index', compact('vacancies'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('job_vacancy.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|string|exists:departments,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $id = JobVacancy::create($request->only(['department_id', 'title', 'description']));
        return redirect()->route('jobvacancies.index')->with('success', 'Lowongan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $vacancy = JobVacancy::find($id);
        $departments = Department::all();
        return view('job_vacancy.edit', compact('vacancy', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'department_id' => 'required|string|exists:departments,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        JobVacancy::updateById($id, $request->only(['department_id', 'title', 'description']));
        return redirect()->route('jobvacancies.index')->with('success', 'Lowongan berhasil diupdate!');
    }

    public function destroy($id)
    {
        JobVacancy::softDelete($id);
        return redirect()->route('jobvacancies.index')->with('success', 'Lowongan berhasil dihapus!');
    }

    // Tampilkan link rekrutmen unik
    public function showLink($id)
    {
        $vacancy = JobVacancy::find($id);
        $link = JobVacancy::getRecruitmentLink($id);
        return view('job_vacancy.show_link', compact('vacancy', 'link'));
    }
}
