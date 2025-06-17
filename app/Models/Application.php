<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Application
{
    // Simpan/Update data step (multi-step)
    public static function saveStep($data, $step, $applicationId = null)
    {
        if ($applicationId) {
            DB::update("UPDATE applications SET 
                full_name = COALESCE(?, full_name), 
                email = COALESCE(?, email), 
                phone = COALESCE(?, phone), 
                ktp = COALESCE(?, ktp), 
                cv_file = COALESCE(?, cv_file), 
                expected_salary = COALESCE(?, expected_salary), 
                step = ?, 
                updated_at = NOW()
                WHERE id = ?",
                [
                    $data['full_name'] ?? null,
                    $data['email'] ?? null,
                    $data['phone'] ?? null,
                    $data['ktp'] ?? null,
                    $data['cv_file'] ?? null,
                    $data['expected_salary'] ?? null,
                    $step, 
                    $applicationId
                ]
            );
            return $applicationId;
        } else {
            $id = DB::selectOne("SELECT UUID() as uuid")->uuid;
            DB::insert("INSERT INTO applications 
                (id, job_vacancy_id, full_name, email, phone, ktp, cv_file, step, status, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'applied', NOW(), NOW())",
                [
                    $id, $data['job_vacancy_id'], $data['full_name'], $data['email'],
                    $data['phone'], $data['ktp'], $data['cv_file'], $step
                ]
            );
            return $id;
        }
    }

    // Update status aplikasi
    public static function updateStatus($applicationId, $status)
    {
        return DB::update("UPDATE applications SET status = ?, updated_at = NOW() WHERE id = ?", [$status, $applicationId]);
    }

    // Finalize aplikasi (set is_finalized true)
    public static function finalize($applicationId)
    {
        return DB::update("UPDATE applications SET is_finalized = 1, updated_at = NOW() WHERE id = ?", [$applicationId]);
    }

    public static function getById($id)
    {
        return DB::selectOne("SELECT * FROM applications WHERE id = ?", [$id]);
    }
}
