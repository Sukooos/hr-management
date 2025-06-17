<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Employee 
{
    public static function getList($search = '', $sort = 'created_at', $order = 'desc', $perPage = 10, $page = 1)
    {
        $offset = ($page - 1) * $perPage;
        $searchLike = '%' . $search . '%';
        $validSort = in_array($sort, ['users.name', 'users.email', 'employees.created_at']) ? $sort : 'employees.created_at';
        $order = strtolower($order) === 'asc' ? 'asc' : 'desc';

        // Hitung total
        $total = DB::table('employees')
            ->join('users', 'employees.user_id', '=', 'users.id')
            ->whereNull('employees.deleted_at')
            ->where(function($query) use ($searchLike) {
                $query->where('users.name', 'like', $searchLike)
                    ->orWhere('users.email', 'like', $searchLike);
            })->count();

        // Ambil data join
        $list = DB::select("
            SELECT employees.*, users.name, users.email, users.role_id, roles.name as role_name
            FROM employees
            JOIN users ON employees.user_id = users.id
            JOIN roles ON users.role_id = roles.id
            WHERE employees.deleted_at IS NULL
            AND (users.name LIKE ? OR users.email LIKE ?)
            ORDER BY $validSort $order
            LIMIT ? OFFSET ?
        ", [$searchLike, $searchLike, $perPage, $offset]);

        return [
            'data' => $list,
            'total' => $total,
            'perPage' => $perPage,
            'page' => $page,
        ];
    }

    public static function find($id)
    {
        return DB::selectOne('
            SELECT employees.*, users.name, users.email, users.role_id
            FROM employees
            JOIN users ON employees.user_id = users.id
            WHERE employees.id = ?
        ', [$id]);
    }

    public static function store($data)
    {
        return DB::insert('INSERT INTO employees (id, name, email, created_at, updated_at) VALUES (UUID(), ?, ?, NOW(), NOW())', [
            $data['name'], $data['email']
        ]);
    }

    public static function updateById($id, $data)
    {
        return DB::update('UPDATE employees SET name = ?, email = ?, updated_at = NOW() WHERE id = ?', [
            $data['name'], $data['email'], $id
        ]);
    }

    public static function softDelete($id)
    {
        return DB::update('UPDATE employees SET deleted_at = NOW() WHERE id = ?', [$id]);
    }
}