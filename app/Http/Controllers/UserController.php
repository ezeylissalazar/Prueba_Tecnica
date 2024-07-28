<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\DatabaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['name', 'email', 'role', 'companyOwner']);
        $users = User::with('roles')->filter($filters)->get();

        return view('users.index', compact('users'));
    }

    public function update_role($id)
    {
        $users = User::find($id);
        $roles = Role::all();
        $associateRole = $users->getRoleId($id);

        return view('users.role', compact('users', 'roles', 'associateRole'));
    }
    public function update_role_store(UserRequest $request, $id)
    {

        try {
            DB::beginTransaction();
            $idRol = (int) $request->role;
            $user = User::find($id);
            $role = Role::find($idRol);
            $user->syncRoles($role);
            DB::commit();
            return redirect()->route('users')->with('success', 'Successfully Updated Role');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
