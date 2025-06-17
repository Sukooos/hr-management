<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Menu
{
    // Ambil semua menu aktif (bisa pakai parameter kalau mau filter lain)
    public static function getMenuTree()
    {
        // Ambil semua menu aktif, urut parent_id & order
        $menus = DB::select('SELECT * FROM menus WHERE is_active = 1 ORDER BY parent_id, `order`');

        // Convert ke array (biar gampang diolah)
        $menus = json_decode(json_encode($menus), true);

        // Build tree recursive
        return self::buildTree($menus);
    }

    private static function buildTree($items, $parentId = null)
    {
        $branch = [];
        foreach ($items as $item) {
            if ($item['parent_id'] == $parentId) {
                $children = self::buildTree($items, $item['id']);
                if ($children) {
                    $item['children'] = $children;
                }
                $branch[] = (object) $item; // kembalikan sebagai object, biar enak di blade
            }
        }
        return $branch;
    }


}
