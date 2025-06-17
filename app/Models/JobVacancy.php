<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class JobVacancy
{
    public static function all()
    {
        return DB::select("SELECT * FROM job_vacancies WHERE is_active = 1 ORDER BY created_at DESC");
    }

    public static function find($id)
    {
        return DB::selectOne("SELECT * FROM job_vacancies WHERE id = ?", [$id]);
    }

    public static function create($data)
    {
        $id = DB::selectOne("SELECT UUID() as uuid")->uuid;
        $link = url('/recruitment/' . $id); // link unik
        DB::insert("INSERT INTO job_vacancies (id, department_id, title, description, link_unique, is_active, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, 1, NOW(), NOW())",
            [$id, $data['department_id'], $data['title'], $data['description'], $link]);
        return $id;
    }

    public static function updateById($id, $data)
    {
        return DB::update("UPDATE job_vacancies SET department_id = ?, title = ?, description = ?, updated_at = NOW()
                           WHERE id = ?", [
            $data['department_id'], $data['title'], $data['description'], $id
        ]);
    }

    public static function softDelete($id)
    {
        return DB::update("UPDATE job_vacancies SET is_active = 0, updated_at = NOW() WHERE id = ?", [$id]);
    }

    // Untuk show link unik rekrutmen
    public static function getRecruitmentLink($id)
    {
        $job = self::find($id);
        return $job ? $job->link_unique : null;
    }
}

