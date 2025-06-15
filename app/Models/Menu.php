<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Menu
{
    // Ambil semua menu aktif (bisa pakai parameter kalau mau filter lain)
    public static function getAllActive()
    {
        return DB::select("
            SELECT * FROM menus
            WHERE is_active = 1
            ORDER BY parent_id, `order`
        ");
    }

    // Helper: Build menu tree dari array result raw query
    public static function buildMenuTree($menus, $parentId = null)
    {
        $branch = [];
        foreach ($menus as $menu) {
            if ($menu->parent_id == $parentId) {
                $children = self::buildMenuTree($menus, $menu->id);
                $menu->children = $children;
                $branch[] = $menu;
            }
        }
        return $branch;
    }
}
