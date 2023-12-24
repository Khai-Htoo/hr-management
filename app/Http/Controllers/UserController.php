<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\Http\Requests\updateUser;
use App\Http\Requests\UserUpdate;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function index()
    {
        return view('admin.user.index');
    }

    // dataTable
    public function dataTable()
    {
        $user = User::with('department');
        return DataTables::of($user)
            ->addColumn('role',function($each){
                $output = '';
                foreach ($each->roles as $p) {
                    $output .= '<span class="btn btn-sm btn-secondary my-1 mx-1">' . $p->name . '</span>';
                }
                return $output;
            })
            ->addColumn('image', function ($each) {

                return '<img class="dtImage" src="' . asset('storage/' . $each->image) . '" alt=""> <p class="employee">' . $each->employee_id . '</p>';
            })
            ->addColumn('department_name', function ($each) {
                return $each->department ? $each->department->name : '-';
            })
            ->addColumn('action', function ($each) {
                return '<a  class="delete-btn" data-id="' . $each->id . '"><button class="btn btn-danger mx-2 btn-sm "><i class="fas fa-trash-alt"></i></button></a>' .
                '<a href="' . route('user.edit', $each->id) . '"><button class="btn btn-info mx-2 btn-sm "><i class="fas fa-edit"></i></button></a>';
            })
            ->editColumn('is_present', function ($each) {
                if ($each->is_present == 1) {
                    return " <span class='btn btn-sm  btn-success '>present</span> ";
                } else {
                    return " <span class=' btn btn-sm btn-danger'>Leave</span> ";
                }
            })
            ->rawColumns(['is_present', 'action', 'image','role'])
            ->make(true);
    }

    public function create()
    {
        $role = Role::all();
        $department = Department::get();
        return view('admin.user.create', compact('department', 'role'));
    }

    public function store(CreateUser $request)
    {
        $user = $this->createUser($request);
        $image = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $image);
        $user['image'] = $image;
        $data = User::create($user);
        $data->syncRoles($request->role);
        return redirect()->route('user.index')->with(['success' => 'User is successfully created']);
    }

    public function show(string $id)
    {
        $user = User::where('id', Auth::user()->id)->with('department')->first();
        return view('admin.user.show', compact('user'));
    }

    public function edit(string $id)
    {
        $department = Department::get();
        $role = Role::all();
        $department = Department::get();
        $user = User::where('id', $id)->first();
        $oldRole = $user->roles->pluck('id')->toArray();
        return view('admin.user.edit', compact('department', 'user', 'role', 'oldRole'));
    }

    public function update(UserUpdate $request, string $id)
    {
        $user = User::where('id', $id)->first();
        $data = $this->updateUser($request);

        $data['password'] = $user->password;

        $role = User::find($id);
        $role->name = $request->name;
        $role->email = $request->email;
        $role->phone = $request->phone;
        if ($request->file('image')) {
            $image = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/', $image);
            $role->image = $image;
        }else{
            $role->image = $user->image;
        }
        $role->nrc_number = $request->nrc_number;
        $role->birthday = $request->birthday;
        $role->gender = $request->gender;
        $role->address = $request->address;
        $role->employee_id = $request->employee_id;
        $role->department_id = $request->department_id;
        $role->join_date = $request->join_date;
        $role->update();
        $role->syncRoles($request->role);

        return redirect()->route('user.index')->with(['success' => 'User Data updated!']);
    }

    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return 'success';
    }

    // create data
    private function createUser($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'pin_code'=>$request->pin_code,
            'nrc_number' => $request->nrc_number,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'address' => $request->address,
            'employee_id' => $request->employee_id,
            'department_id' => $request->department_id,
            'join_date' => $request->join_date,
        ];
    }

    // create data
    private function updateUser($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'nrc_number' => $request->nrc_number,
            'pin_code'=>$request->pin_code,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'address' => $request->address,
            'employee_id' => $request->employee_id,
            'department_id' => $request->department_id,
            'join_date' => $request->join_date,
        ];
    }

}
