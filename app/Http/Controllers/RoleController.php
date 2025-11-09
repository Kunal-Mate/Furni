<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\Facades\Validator;
use Illuminate\Validation\Rule;



class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        // dd($user);

        if ($user->userType === 'admin') {
            $roles = Role::where('adminId', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }
        if ($user->userType === 'superAdmin') {
            $roles = Role::where('adminId', $user->id)
                ->where('name', '!=', 'superAdmin')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        $permission = Permission::orderBy('created_at', 'ASC')->get();
        // $roles = Role::where('admin_id' )->orderBy('created_at', 'desc')->paginate(10);
        return view('roles.index', compact('roles', 'permission'));
    }


    public function create()
    {
        $user = Auth::user();
        $permission = Permission::orderBy('created_at', 'ASC')->get();
        $groupedPermissions = [];
        foreach ($permission as $perm) {
            if (preg_match('/^(\w+):(\w+)\s(.+)$/', $perm->name, $matches)) {
                $mainModule = $matches[1];
                $action = $matches[2];
                $module = $matches[3];
                $groupedPermissions[$mainModule][$module][$action] = true;
            }
        }

        // dd($permission);
        return view('roles.create', compact('permission', 'groupedPermissions'));
    }

    public function store(Request $request)
    {
        $admin = Auth::user();

        // Manually validate so you can handle passes() logic

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                Rule::unique('roles')->where(function ($query) use ($admin) {
                    return $query->where('adminId', $admin->id)
                        ->where('guard_name', 'admin');
                }),
            ],
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('success', false);
        }

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'admin',
            'adminId' => $admin->id,
            'description' => $request->description,
        ]);

        if (!empty($request->permission)) {
            $validPermissions = Permission::whereIn('name', $request->permission)
                ->where('guard_name', 'admin')
                ->pluck('name')
                ->toArray();

            $role->syncPermissions($validPermissions);
        }

        return redirect()->route('roles')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permission = Permission::orderBy('created_at', 'ASC')->get();
        $hasPermissions = $role->permissions->pluck('name');
        $groupedPermissions = [];
        foreach ($permission as $perm) {
            if (preg_match('/^(\w+):(\w+)\s(.+)$/', $perm->name, $matches)) {
                $mainModule = $matches[1];
                $action = $matches[2];
                $module = $matches[3];
                $groupedPermissions[$mainModule][$module][$action] = true;
            }
        }
        // dd($groupedPermissions);
        return view('roles.edit', compact('role', 'permission', 'hasPermissions', 'groupedPermissions'));

    }
    public function update($id, Request $request)
    {
        // dd($request->all());

        $user = Auth::user();
        $role = Role::findOrFail($id);
        if (!$role) {
            return redirect()->back()->with('error', 'Roles not found.');
        }
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'min:3',
                Rule::unique('roles', 'name')->where(function ($query) {
                    return $query->where('adminId', auth()->id());
                })->ignore($id),
            ],
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('success', false);
        }
        if ($validator->passes()) {
            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();

            if (!empty($request->permission)) {
                foreach ($request->permission as $permName) {
                    $perm = Permission::where('name', $permName)->first();
                    if (!$perm) {
                        dd("Permission not found", $permName);
                    }
                }

                $role->syncPermissions($request->permission);
            } else {
                $role->syncPermissions([]);
            }
            // if (!empty($request->permission)) {
            //     $role->syncPermissions($request->permission);
            // } else {
            //     $role->syncPermissions([]);
            // }
            return redirect()->route('roles')->with('success', 'Roles updated successfully.');
        } else {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('success', false);
        }
    }

    public function delete(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'id' => 'required|exists:roles,id',
        ]);

        if ($Validator->passes()) {
            $role = Role::find($request->id);
            $role->delete();
            return response()->json(['success' => true, 'message' => 'role deleted successfully!']);
        } else {
            return response()->json(['success' => false, 'errors' => $Validator->errors()]);
        }
    }
}
