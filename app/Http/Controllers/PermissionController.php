<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\support\Facades\Validator;



class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'desc')->paginate(10);
        return view('permissions.index', compact('permissions'));
    }
    public function store(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name|min:3',
        ]);

        if ($Validator->passes()) {
            Permission::create(['name' => $request->name]);
            return response()->json(['success' => true, 'message' => 'Permission created successfully!']);
        } else {
            return response()->json(['success' => false, 'errors' => $Validator->errors()]);
        }
    }

    public function update(Request $request, $id)
    {

        $permission = Permission::where('id', $id)->first();
        if (!$permission) {
            return redirect()->back()->with('error', 'Permission not found.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name,' . $id . '|min:3',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $permission->name = $request->name;
        $permission->save();

        return redirect()->back()->with('success', 'permission updated successfully.');
    }
    public function delete(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'id' => 'required|exists:permissions,id',
        ]);

        if ($Validator->passes()) {
            $permission = Permission::find($request->id);
            $permission->delete();
            return response()->json(['success' => true, 'message' => 'Permission deleted successfully!']);
        } else {
            return response()->json(['success' => false, 'errors' => $Validator->errors()]);
        }
    }
}
