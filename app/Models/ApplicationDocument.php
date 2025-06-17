<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class ApplicationDocument
{
    public static function saveDocuments($applicationId, $documents)
    {
        foreach ($documents as $type => $file_path) {
            // Sama: cek sudah ada
            $exists = DB::selectOne("SELECT id FROM application_documents WHERE application_id = ? AND file_type = ?", [$applicationId, $type]);
            if ($exists) {
                DB::update("UPDATE application_documents SET file_path = ?, created_at = NOW() WHERE id = ?", [$file_path, $exists->id]);
            } else {
                DB::insert("INSERT INTO application_documents (id, application_id, file_type, file_path, created_at) VALUES (UUID(), ?, ?, ?, NOW())",
                    [$applicationId, $type, $file_path]);
            }
        }
    }

    public static function getByApplication($applicationId)
    {
        return DB::select("SELECT * FROM application_documents WHERE application_id = ?", [$applicationId]);
    }
}
