<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.permission.index');
    }

    // dataTable
    public function dataTable()
    {
        $permission = Permission::query();
        return DataTables::of($permission)

            ->addColumn('action', function ($each) {
                return '<a  class="delete-btn" data-id="' . $each->id . '"><button class="btn btn-danger mx-2 btn-sm "><i class="fas fa-trash-alt"></i></button></a>' .
                '<a href="' . route('permission.edit', $each->id) . '"><button class="btn btn-info mx-2 btn-sm "><i class="fas fa-edit"></i></button></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);
        Permission::create(['name' => $request->name]);
        return redirect()->route('permission.index')->with(['success' => 'Permission is successfully created']);
    }

    public function edit(string $id)
    {
        $permission = Permission::where('id', $id)->first();
        return view('admin.permission.edit', compact('permission'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
        ]);
        Permission::where('id', $id)->update(['name' => $request->name]);
        return redirect()->route('permission.index')->with(['success' => 'Permission Data updated!']);
    }

    public function destroy(string $id)
    {
        Permission::where('id', $id)->delete();
        return 'success';
    }

}
