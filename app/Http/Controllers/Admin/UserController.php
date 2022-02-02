<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    private $userRepository;
    private $perPage = 15;
    private $defaultPassword = 'firdaus';

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $data = $this->userRepository->all()
            ->orderBy('u.created_at', 'desc')
            ->paginate($this->perPage);
        $title = 'User';
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
            $sortBy = $request->get('sortBy');
            $data = $this->userRepository->all()
                ->when($q ?? false, function ($query) use ($q) {
                    return $query->where('u.id', 'like', '%' . $q . '%')
                        ->orWhere('u.name', 'like', '%' . $q . '%')
                        ->orWhere('u.username', 'like', '%' . $q . '%')
                        ->orWhere('u.email', 'like', '%' . $q . '%')
                        ->orWhere('u.status', 'like', '%' . $q . '%')
                        ->orWhere('r.name', 'like', '%' . $q . '%');
                })
                ->orderBy('u.created_at', $sortBy)
                ->paginate($this->perPage);
            return view('admin.user.fetch', compact('data'))->render();
        }
    }

    public function updateStatus(User $user)
    {
        $status = $user->status == 'aktif' ? 'tidak aktif' :  'aktif';
        $user->update(['status' => $status]);
        activity('mengubah status user ' . $this->namaUser($user->id) . ' menjadi ' . $user->status);
        return response()->json([
            'message' => 'Status user berhasil diubah',
            'url' => route('user.index')
        ], 200);
    }

    public function resetPassword(User $user)
    {
        $user->update(['password' => bcrypt($this->defaultPassword)]);

        activity('Mereset password user ' . $this->namaUser($user->id));

        return response()->json([
            'message' => 'Password user berhasil direset',
        ], 200);
    }

    public function create()
    {
        $title = 'Tambah User';
        $roles = $this->roles();
        $permissions = $this->permissions();
        return view('admin.user.create', compact(
            'title',
            'roles',
            'permissions'
        ));
    }

    public function store(UserRequest $request)
    {
        // Insert ke table user
        $attr = $request->all();

        DB::transaction(function () use ($attr) {
            $permissions = $attr['permissions'];
            $role = $attr['role'];
            $attr['password'] = bcrypt($this->defaultPassword);
            $user = User::create($attr);

            $profile = Profile::create(['user_id' => $user->id]);

            $user->assignRole($role);
            $user->givePermissionTo([$permissions]);
            $role = Role::where('name', $role)->first();
            $role->givePermissionTo([$permissions]);

            activity('menambahkan user ' . $this->namaUser($user->id));
        });
        return response()->json([
            'url' => route('user.index'),
            'message' => 'Tambah user atas nama ' . $attr['name'] . ' berhasil!'
        ], 200);
    }

    public function edit(User $user)
    {
        $title = 'Ubah User';
        $roles = $this->roles();
        $permissions = $this->permissions();
        return view('admin.user.edit', compact(
            'title',
            'roles',
            'permissions',
            'user'
        ));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'permissions' => 'required',
            'role' => 'required',
        ]);

        $request_user = $request->all();
        DB::transaction(
            function () use ($request_user, $user) {
                $role = $request_user['role'];
                $permissions = $request_user['permissions'];

                $user->update($request_user);
                $user->syncRoles($role);
                $user->syncPermissions($permissions);

                activity('mengubah data user ' . $this->namaUser($user->id));
            }
        );
        return response()->json([
            'url' => route('user.index'),
            'message' => 'Update user berhasil!'
        ], 200);
    }

    public function namaUser($user_id)
    {
        $user = User::find($user_id);
        return $user->name;
    }

    public function delete(User $user)
    {
        // DB::transaction(function () use ($user) {
        // $role = $user->getRoleNames();
        // $permission = $user->getPermissionNames();

        // $user->revokePermissionTo($permission);
        // $user->removeRole($role);

        activity('menghapus data user ' . $this->namaUser($user->id));

        $user->delete();

        return response()->json([
            'url' => route('user.index'),
            'message' => 'User berhasil dihapus!'
        ]);
        // });
    }
}
