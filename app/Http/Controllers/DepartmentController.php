<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('admin.department.index');
    }

    // dataTable
    public function dataTable()
    {
        $department = Department::query();
        return DataTables::of($department)

            ->addColumn('action', function ($each) {
                return '<a  class="delete-btn" data-id="'.$each->id.'"><button class="btn btn-danger mx-2 btn-sm "><i class="fas fa-trash-alt"></i></button></a>' .
                '<a href="' . route('department.edit', $each->id) . '"><button class="btn btn-info mx-2 btn-sm "><i class="fas fa-edit"></i></button></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:departments,name'
        ]);
        Department::create(['name' => $request->name]);
        return redirect()->route('department.index')->with(['success' => 'Department is successfully created']);
    }



    public function edit(string $id)
    {
        $department = Department::where('id', $id)->first();
        return view('admin.department.edit',compact('department'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|unique:departments,name,'.$id
        ]);
        Department::where('id',$id)->update(['name'=>$request->name]);
        return redirect()->route('department.index')->with(['success'=>'Department Data updated!']);
    }

    public function destroy(string $id)
    {
       Department::where('id',$id)->delete();
       return 'success';
    }

}
