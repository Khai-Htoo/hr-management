<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\TeamLeader;
use App\Models\TeamMenber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.project.index');
    }

    // dataTable
    public function dataTable()
    {
        $project = Project::with('teamLeader')->with('teamMember')->get();
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
                    $output .= '<img class="img-thumbnail" style="width : 50px ;height : 50px ;border-radius : 100%" src="' . asset('storage/' . $member->image) . '"/>';
                }
                return $output;
            })
            ->addColumn('action', function ($each) {
                return '<a  class="delete-btn" data-id="' . $each->id . '"><button class="btn btn-danger mx-2 btn-sm "><i class="fas fa-trash-alt"></i></button></a>' .
                '<a href="' . route('project.edit', $each->id) . '"><button class="btn btn-info mx-2 btn-sm "><i class="fas fa-edit"></i></button></a>' .
                '<a href="' . route('project.show', $each->id) . '"><button class="btn btn-secondary mx-2 btn-sm "><i class="fa fa-eye" aria-hidden="true"></i></button></a>';
            })
            ->rawColumns(['action', 'priority', 'status', 'team_member', 'team_leader'])
            ->make(true);
    }

    public function create()
    {
        $user = User::get();
        return view('admin.project.create', compact('user'));
    }

    public function store(Request $request)
    {
        // validate
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'files' => 'required',
            'start_date' => 'required',
            'priority' => 'required',
            'status' => 'required',
        ]);

        $data = $this->projectData($request);
        // image upload
        $imageUpload = [];
        foreach ($request->file('image') as $image) {
            $imageFile = uniqid() . $image->getClientOriginalName();
            $image->storeAs('public', $imageFile);
            $imageUpload[] = $imageFile;
        }
        $data['image'] = $imageUpload;

        // pdf upload
        $pdf = [];
        foreach ($request->file('files') as $file) {
            $files = uniqid() . $file->getClientOriginalName();
            $file->storeAs('public', $files);
            $pdf[] = $files;
        }
        $data['files'] = $pdf;

        $project = Project::create($data);

        //create team leader
        $project->teamLeader()->sync($request->team_leader);
        // create team menber
        $project->teamMember()->sync($request->team_menber);
        return redirect()->route('project.index')->with(['success' => 'Project is successfully created']);
    }

    public function show($id)
    {
        $project = Project::where('id', $id)->with('teamLeader')->with('teamMember')->first();
        return view('admin.project.show', compact('project'));
    }

    public function edit(string $id)
    {
        $user = User::get();
        $project = Project::where('id', $id)->with('teamLeader')->with('teamMember')->first();
        return view('admin.project.edit', compact('project', 'user'));
    }

    public function update(Request $request, string $id)
    {
        // validate
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'priority' => 'required',
            'status' => 'required',
        ]);
        $project = Project::where('id', $id)->first();
        $data = $this->projectData($request);
        // image upload
        if ($request->hasFile('image')) {
            $imageUpload = [];
            foreach ($request->file('image') as $image) {
                $imageFile = uniqid() . $image->getClientOriginalName();
                $image->storeAs('public', $imageFile);
                $imageUpload[] = $imageFile;
            }
            $data['image'] = $imageUpload;
        } else {
            $data['image'] = $project->image;
        }

        // pdf upload
        if ($request->hasFile('files')) {
            $pdf = [];
            foreach ($request->file('files') as $file) {
                $files = uniqid() . $file->getClientOriginalName();
                $file->storeAs('public', $files);
                $pdf[] = $files;
            }
            $data['files'] = $pdf;
        } else {
            $data['files'] = $project->files;
        }

        Project::where('id', $id)->update($data);

        //create team leader
        $project->teamLeader()->sync($request->team_leader);
        // create team menber
        $project->teamMember()->sync($request->team_menber);

        return redirect()->route('project.index')->with(['success' => 'Project is successfully updated']);
    }

    public function destroy(string $id)
    {
        Project::where('id', $id)->delete();
        TeamLeader::where('project_id', $id)->delete();
        TeamMenber::where('project_id', $id)->delete();
        return 'success';
    }

    // data for project create
    private function projectData($request)
    {
        return [
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'priority' => $request->priority,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ];
    }

}
