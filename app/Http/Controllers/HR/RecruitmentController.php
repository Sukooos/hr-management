<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ApplicationAnswer;
use App\Models\ApplicationDocument;
use App\Models\JobVacancy;
use App\Services\RecruitmentService; // Asumsi ada service untuk logika bisnis

class RecruitmentController extends Controller
{
    protected $service;
    public function __construct(RecruitmentService $service)
    {
        $this->service = $service;
    }
    // Step 1: Data Diri
    public function step1(Request $request, $jobUuid)
    {
        $job = JobVacancy::getByUuid($jobUuid);
        $application = null;
        if ($request->session()->has('application_id')) {
            $application = Application::getById($request->session()->get('application_id'));
        }
        return view('recruitment.step1', compact('application', 'job'));
    }

    public function saveStep1(Request $request, $jobUuid)
    {
        $applicationId = $this->service->saveStepOne(
            $request->validated(),
            $jobUuid,
            $request->session()->get('application_id')
        );
        $request->session()->put('application_id', $applicationId);
        return redirect()->route('recruitment.step2', [$jobUuid]);
    }

    // Step 2: Pertanyaan
    public function step2(Request $request, $jobUuid)
    {
        $applicationId = $request->session()->get('application_id');
        $answers = ApplicationAnswer::getByApplication($applicationId);
        // Siapkan daftar pertanyaan dari DB/config, misal $questions
        $questions = [
            'Mengapa Anda melamar posisi ini?',
            'Pengalaman kerja terkait?',
            // dst.
        ];
        return view('recruitment.step2', compact('answers', 'questions', 'jobUuid'));
    }

    public function saveStep2(Request $request, $jobUuid)
    {
        $applicationId = $request->session()->get('application_id');
        $this->service->saveStepTwo($applicationId, $request->input('answers'));
        return redirect()->route('recruitment.step3', [$jobUuid]);
    }

    // Step 3: Dokumen & Expected Salary
    public function step3(Request $request, $jobUuid)
    {
        $applicationId = $request->session()->get('application_id');
        $documents = ApplicationDocument::getByApplication($applicationId);
        $application = Application::getById($applicationId);
        return view('recruitment.step3', compact('documents', 'application', 'jobUuid'));
    }

    public function saveStep3(Request $request, $jobUuid)
    {
        $applicationId = $request->session()->get('application_id');
        $this->service->saveStepThree(
            $applicationId,
            $request->file('documents'),
            $request->input('expected_salary')
        );
        return redirect()->route('recruitment.finish', [$jobUuid]);
    }

    public function finish(Request $request, $jobUuid)
    {
        return view('recruitment.finish', compact('jobUuid'));
    }
}
