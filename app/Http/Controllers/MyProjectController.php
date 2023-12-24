<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class MyProjectController extends Controller
{
    public function index()
    {
        return view('admin.project.myproject');
    }

    // dataTable
    public function dataTable()
    {
        $project = Project::with('teamLeader', 'teamMember')
            ->whereHas('teamLeader', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->orWhereHas('teamMember', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->get();
        return DataTables::of($project)
            ->editColumn('priority', function ($each) {
                if ($each->priority == 'high') {
                    return '<span class=" btn btn-sm btn-danger">high</span>';
                }
                if ($each->priority == 'middle') {
                    return '<span class=" btn btn-sm btn-warning">middle</span>';
                }
                if ($each->priority == 'low') {
                    return '<span class=" btn btn-sm btn-info">low</span>';
                }
            })
            ->editColumn('status', function ($each) {
                if ($each->status == 'in_progress') {
                    return '<span class=" btn btn-sm btn-info">In_progress</span>';
                }
                if ($each->status == 'pending') {
                    return '<span class=" btn btn-sm btn-warning">Pending</span>';
                }
                if ($each->status == 'complete') {
                    return '<span class=" btn btn-sm btn-success">Complete</span>';
                }
            })
            ->editColumn('description', function ($each) {
                return Str::substr($each->description, 0, 20);
            })
            ->addColumn('team_leader', function ($each) {
                $output = '';
                foreach ($each->teamLeader as $leader) {
                    $output .= '<img class="img-thumbnail" style="width : 50px ;height : 50px ;border-radius : 100%" src="' . asset('storage/' . $leader->image) . '"/>';
                }
                return $output;
            })
            ->addColumn('team_member', function ($each) {
                $output = '';
                foreach ($each->teamMember as $member) {
                    $output .= '<img class="img-thumbnail @endif" style="width : 50px ;height : 50px ;border-radius : 100%" src="' . asset('storage/' . $member->image) . '"/>';
                }
                return $output;
            })
            ->addColumn('action', function ($each) {
                return '<a href="' . route('myProject.show', $each->id) . '"><button class="btn btn-secondary mx-2 btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></button></a>';
            })
            ->rawColumns(['action', 'priority', 'status', 'team_member', 'team_leader'])
            ->make(true);
    }

    public function show($id)
    {
        $project = Project::where('id', $id)->with('teamLeader', 'teamMember', 'task')->first();
        return view('admin.project.myprojectShow', compact('project'));
    }
}
