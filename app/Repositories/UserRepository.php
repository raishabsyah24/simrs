<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\UserInterface;

class UserRepository implements UserInterface
{
    public function all()
    {
        return DB::table('users as u')
            ->selectRaw('
            u.id, u.name, u.username, u.email, u.status, r.name as role, u.created_at
        ')
            ->join('model_has_roles as mhs', 'mhs.model_id', '=', 'u.id')
            ->join('roles as r', 'r.id', '=', 'mhs.role_id')
            ->whereNull('u.deleted_at');
    }

    public function detailUser(int $user_id)
    {
        return DB::table('users as u')
            ->selectRaw('
            u.id, u.name, u.username, u.email, u.status, r.name as role, u.created_at
        ')
            ->join('model_has_roles as mhs', 'mhs.model_id', '=', 'u.id')
            ->join('roles as r', 'r.id', '=', 'mhs.role_id')
            ->where('u.id', $user_id)
            ->first();
    }
}
