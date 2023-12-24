<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class CheckController extends Controller
{
    //check page
    public function check()
    {
        $date = Hash::make(date('Y-m-d'));
        return view('check',compact('date'));
    }

    // check in check out
    public function checkin(Request $request)
    {
        $user = User::where('pin_code', $request->pin_code)->first();
        if (!$user) {
            return ['status' => 'fail', 'msg' => 'Pin code incorrect!'];
        }

        $check = Check::firstOrCreate([
            'user_id'=>$user->id,
            'date'=>now()->format('Y-m-d')
        ]);

        if($check->check_in == NULL){
            Check::where('user_id',$user->id)->update(['check_in'=>now()->format('H:i:s')]);
            return ['status'=>'success','msg'=>'Successfully Check In'.now()];
        }elseif(is_null($check->check_out)){
            Check::where('user_id',$user->id)->update(['check_out'=>now()->format('H:i:s')]);
            return ['status'=>'success','msg'=>'Successfully Check Out'.now()];
        }

        if($check->check_in != NULL && $check->check_out != NULL){
            return ['status'=>'fail','msg'=>'Already check in check out'];
        }
    }

    public function index()
    {
        return view('admin.attendance.index');
    }

    // dataTable
    public function dataTable()
    {
        $check = Check::query();
        return DataTables::of($check)
            ->addColumn('name',function($each){
                return $each->user ? $each->user->name : '-';
            })
            ->addColumn('action', function ($each) {
                return '<a  class="delete-btn" data-id="'.$each->id.'"><button class="btn btn-danger mx-2 btn-sm "><i class="fas fa-trash-alt"></i></button></a>' .
                '<a href="' . route('attendance.edit', $each->id) . '"><button class="btn btn-info mx-2 btn-sm "><i class="fas fa-edit"></i></button></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $user = User::get();
        return view('admin.attendance.create',compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'date'=> 'required',
        ]);

        if(Check::where('user_id',$request->user_id)->where('date',$request->date)->exists()){
             return redirect()->route('attendance.index')->with(['fail' => 'attendance is defined']);
        }

        if(now()->format('D') == 'Sat' || now()->format('D') == 'Sun'){
            return ['status' => 'fail', 'msg' => 'Today is OffDay'];
        }


        Check::create([
            'user_id' => $request->user_id,
            'date'=>$request->date,
            'check_in'=>$request->check_in,
            'check_out'=>$request->check_out
        ]);
        return redirect()->route('attendance.index')->with(['success' => 'attendance is successfully created']);
    }



    public function edit(string $id)
    {
        $user = User::get();
        $check = Check::where('id', $id)->first();
        return view('admin.attendance.edit',compact('check','user'));
    }

    public function update(Request $request, string $id)
    {
        $check = Check::where('id',$id)->first();
        if(Check::where('date',$request->date)->where('user_id',$request->user_id)->where('id','!=',$check->id)->exists()){
            return redirect()->route('attendance.index')->with(['fail' => 'attendance is defined']);
        }
        Check::where('id',$id)->update([
            'user_id' => $request->user_id,
            'date'=>$request->date,
            'check_in'=>$request->check_in,
            'check_out'=>$request->check_out
        ]);
        return redirect()->route('attendance.index')->with(['success'=>'attendance Data updated!']);
    }

    public function destroy(string $id)
    {
       Check::where('id',$id)->delete();
       return 'success';
    }

}
