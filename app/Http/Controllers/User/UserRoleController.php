<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class UserRoleController extends Controller
{
    //Hiển thị danh sách user và role
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('admin.index_role', compact('users', 'roles'));
    }



    public function removeRole(User $user, $roleId)
    {
        if ((int) $roleId === 1) { // chỉ cho xoá role admin
            $user->roles()->detach(1);
            return back()->with('success', 'Đã xoá quyền admin cho user.');
        }
        return back()->with('error', 'Bạn không thể xoá role này.');
    }
    public function addRole(Request $request, User $user)
    {
        if ((int) $request->role_id === 1 && !$user->roles->contains(1)) {
            $user->roles()->attach(1);
            return back()->with('success', 'Đã thêm quyền admin cho user.');
        }

        return back()->with('error', 'Không thể thêm role này hoặc đã tồn tại.');
    }

}
