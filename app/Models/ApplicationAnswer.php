<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class ApplicationAnswer
{
    // Simpan/update jawaban per application_id & question
    public static function saveAnswers($applicationId, $answers)
    {
        foreach ($answers as $question => $answer) {
            // Cek sudah ada belum (bisa pakai ON DUPLICATE KEY UPDATE kalau ada unique key di (application_id, question))
            $exists = DB::selectOne("SELECT id FROM application_answers WHERE application_id = ? AND question = ?", [$applicationId, $question]);
            if ($exists) {
                DB::update("UPDATE application_answers SET answer = ?, created_at = NOW() WHERE id = ?", [$answer, $exists->id]);
            } else {
                DB::insert("INSERT INTO application_answers (id, application_id, question, answer, created_at) VALUES (UUID(), ?, ?, ?, NOW())",
                    [$applicationId, $question, $answer]);
            }
        }
    }

    public static function getByApplication($applicationId)
    {
        return DB::select("SELECT * FROM application_answers WHERE application_id = ?", [$applicationId]);
    }
}

