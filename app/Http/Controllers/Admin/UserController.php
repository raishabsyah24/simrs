<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\Interfaces\UserInterface;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $data = DB::table('users')
            ->selectRaw('name, username, email, status, created_at')
            ->orderByDesc('created_at')
            ->paginate(12);
        $title = 'Managemen User';
        $total = User::count();
        $badge = $this->badge();
        return view('admin.user.index', compact(
            'title',
            'data',
            'total',
            'badge'
        ));
    }

    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $q = $request->get('query');
            $badge = $this->badge();
            $sortBy = $request->get('sortBy');
            $data = DB::table('users')
                ->selectRaw('id, name, username, email, status, created_at')
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('id', 'like', '%' . $q . '%')
                        ->orWhere('name', 'like', '%' . $q . '%')
                        ->orWhere('username', 'like', '%' . $q . '%')
                        ->orWhere('email', 'like', '%' . $q . '%')
                        ->orWhere('status', 'like', '%' . $q . '%');
                })
                ->orderBy('created_at', $sortBy)
                ->paginate(12);
            return view('admin.user._fetch_user', compact('data', 'badge'))->render();
        }
    }

    public function data(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'username',
            3 => 'email',
            4 => 'status',
        ];

        // dd($request->all());

        $totalData = $this->userRepository->all()->count();
        $search = $request->input('search.value');
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $layanan = $this->userRepository->all()
            ->when(
                $search ?? false,
                fn ($query, $search) =>
                $query->where('l.id', 'LIKE', "%{$search}%")
                    ->orWhere('l.name', 'LIKE', "%{$search}%")
                    ->orWhere('l.username', 'LIKE', "%{$search}%")
                    ->orWhere('l.email', 'LIKE', "%{$search}%")
                    ->orWhere('l.status', 'LIKE', "%{$search}%")
            )
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $totalFiltered = $this->userRepository->all()
            ->when(
                $search ?? false,
                fn ($query, $search) =>
                $query->where('l.id', 'LIKE', "%{$search}%")
                    ->orWhere('l.name', 'LIKE', "%{$search}%")
                    ->orWhere('l.username', 'LIKE', "%{$search}%")
                    ->orWhere('l.email', 'LIKE', "%{$search}%")
                    ->orWhere('l.status', 'LIKE', "%{$search}%")
            )
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->count();

        $data = [];
        if (!empty($layanan)) {
            foreach ($layanan as $record) {
                $item['id'] = $record->id;
                $item['name'] = $record->name;
                $item['username'] = $record->username;
                $item['email'] = $record->email;
                $item['status'] = $record->status;
                $data[] = $item;
            }
        }

        return response()->json([
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        ]);
    }

    public function createUser()
    {
        $title = 'Tambah User';
        $roles = Role::select('name')->get();
        $permissions = Permission::select('name')->get();
        return view('admin.user.create', compact(
            'title',
            'roles',
            'permissions'
        ));
    }

    public function storeUser(Request $request)
    {
        dd($request->all());

        // Insert ke table user
        $user = $request->all();
        $permissions = $user['permissions'];
        $role = $user['role'];
        $user['password'] = bcrypt('admin');
        $user = User::create($user);

        $user->assignRole($role);
        $user->givePermissionTo([$permissions]);
        $role = Role::where('name', $role)->first();
        $role->givePermissionTo([$permissions]);

        // Insert ke table dokter
        // $dokter = Dokter::create([
        //     'user_id' => $user->id,
        //     'nik' => $request->nik,
        //     'nama' => $request->nama,
        //     'spesialis' => $request->spesialis,
        //     'no_str' => $request->no_str,
        //     'tempat_lahir' => $request->tempat_lahir,
        //     'tanggal_lahir' => $request->tanggal,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        //     'no_hp' => $request->no_hp,
        //     'email' => $request->email,
        //     'alamat' => $request->alamat
        // ]);

        return redirect()->back();

        // return response()->json([
        //     'url' => route('user.store'),
        //     'message' => 'Tambah' . $user->name . ' berhasil!'
        // ], 200);
    }
}
