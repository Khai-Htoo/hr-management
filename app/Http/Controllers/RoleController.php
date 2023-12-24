<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.role.index');
    }

    // dataTable
    public function dataTable()
    {
        $role = Role::query();
        return DataTables::of($role)
            ->addColumn('permission', function ($each) {
                $output = '';
                foreach ($each->permissions as $p) {
                    $output .= '<span class="btn btn-sm btn-secondary my-1 mx-1">' . $p->name . '</span>';
                }
                return $output;
            })
            ->addColumn('action', function ($each) {
                return '<a  class="delete-btn" data-id="' . $each->id . '"><button class="btn btn-danger mx-2 btn-sm "><i class="fas fa-trash-alt"></i></button></a>' .
                '<a href="' . route('role.edit', $each->id) . '"><button class="btn btn-info mx-2 btn-sm "><i class="fas fa-edit"></i></button></a>';
            })
            ->rawColumns(['action', 'permission'])
            ->make(true);
    }

    public function create()
    {
        $permission = Permission::get();
        return view('admin.role.create', compact('permission'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);
        $role = Role::create(['name' => $request->name]);
        $role->givePermissionTo($request->permission);
        return redirect()->route('role.index')->with(['success' => 'Role is successfully created']);
    }

    public function edit(string $id)
    {
        $permission = Permission::get();
        $role = Role::where('id', $id)->first();
        $oldPermission = $role->permissions->pluck('name')->toArray();
        return view('admin.role.edit', compact('role', 'permission', 'oldPermission'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
        ]);
          $role = Role::find($id);
          $role->name = $request->name;
          $role->update();
        $oldPermission = $role->permissions;
        $role->revokePermissionTo($oldPermission);
        $role->givePermissionTo($request->permission);
        return redirect()->route('role.index')->with(['success' => 'Role Data updated!']);
    }

    public function destroy(string $id)
    {
        Role::where('id', $id)->delete();
        return 'success';
    }

}
