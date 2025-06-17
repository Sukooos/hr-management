<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Department
{
    // Ambil semua departemen
    public static function getAll()
    {
        return DB::select("SELECT * FROM departments ORDER BY name");
    }

    // Ambil departemen berdasarkan
    public static function getById($id)
    {
        return DB::selectOne("SELECT * FROM departments WHERE id = ?", [$id]);
    }

        public static function create($data)
    {
        DB::insert("INSERT INTO departments (name, created_at, updated_at) VALUES (?, NOW(), NOW())", [
            $data['name']
        ]);
        return $data['name'];
    }

    public static function updateById($id, $data)
    {
        return DB::update("UPDATE departments SET name = ?, updated_at = NOW() WHERE id = ?", [
            $data['name'], $id
        ]);
    }

    public static function softDelete($id)
    {
        return DB::update("UPDATE departments SET deleted_at = NOW() WHERE id = ?", [$id]);
    }

}