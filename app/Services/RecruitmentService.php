<?php

namespace App\Services;

use App\Models\Application;
use App\Models\ApplicationAnswer;
use App\Models\ApplicationDocument;
use Illuminate\Support\Facades\DB;

class RecruitmentService
{
    // Step 1: Save data diri & cv
    public function saveStepOne($data, $jobUuid, $sessionApplicationId = null)
    {
        // Upload CV (kalau ada)
        if(isset($data['cv_file']) && is_object($data['cv_file'])) {
            $cv_path = $data['cv_file']->store('uploads/cv');
            $data['cv_file'] = $cv_path;
        }
        $data['job_vacancy_id'] = $jobUuid;
        return Application::saveStep($data, 1, $sessionApplicationId);
    }

    // Step 2: Save jawaban pertanyaan
    public function saveStepTwo($applicationId, $answers)
    {
        ApplicationAnswer::saveAnswers($applicationId, $answers);
        Application::saveStep([], 2, $applicationId);
    }

    // Step 3: Save dokumen & expected salary
    public function saveStepThree($applicationId, $documents, $expectedSalary)
    {
        // Upload dokumen
        $saveDocs = [];
        foreach($documents as $type => $file) {
            if(is_object($file)) {
                $path = $file->store('uploads/dokumen');
                $saveDocs[$type] = $path;
            } else {
                $saveDocs[$type] = $file;
            }
        }
        ApplicationDocument::saveDocuments($applicationId, $saveDocs);
        Application::saveStep(['expected_salary' => $expectedSalary], 3, $applicationId);
        Application::finalize($applicationId);
        Application::updateStatus($applicationId, 'completed');
    }
}
