<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SalaryController extends Controller
{

    public function index()
    {
        return view('admin.salary.index');
    }

    // dataTable
    public function dataTable()
    {
        $salary = Salary::with('user')->get();
        return DataTables::of($salary)
            ->addColumn('name', function ($each) {
                return $each->user->name;
            })
            ->editColumn('month',function($each){
                $month = '2023'.$each->month.'01';
                $m = new DateTime($month);
                return $m->format('F');
            })
            ->editColumn('year', function ($each) {
                $year = new DateTime($each->year);
                return $year->format('Y');
            })
            ->addColumn('action', function ($each) {
                return '<a  class="delete-btn" data-id="' . $each->id . '"><button class="btn btn-danger mx-2 btn-sm "><i class="fas fa-trash-alt"></i></button></a>' .
                '<a href="' . route('salary.edit', $each->id) . '"><button class="btn btn-info mx-2 btn-sm "><i class="fas fa-edit"></i></button></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $user = User::get();
        return view('admin.salary.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'month' => 'required',
            'year' => 'required',
            'amount' => 'required',
        ]);
        $year =Carbon::parse( $request->year)->format('Y');
        Salary::create([
            'user_id'=>$request->user_id,
             'month'=>$request->month,
             'year'=>$year,
             'amount'=>$request->amount
            ]);
        return redirect()->route('salary.index')->with(['success' => 'Salary is successfully created']);
    }

    public function edit(string $id)
    {
        $salary = Salary::where('id', $id)->first();
        $user = User::get();
        return view('admin.salary.edit', compact('salary','user'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required',
            'month'=>'required',
            'year'=>'required',
            'amount'=>'required'
        ]);
        Salary::where('id', $id)->update($request->only('user_id','month','year','amount'));
        return redirect()->route('salary.index')->with(['success' => 'Salary Data updated!']);
    }

    public function destroy(string $id)
    {
        Salary::where('id', $id)->delete();
        return 'success';
    }

}
