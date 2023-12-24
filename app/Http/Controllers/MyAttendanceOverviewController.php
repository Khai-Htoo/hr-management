<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Check;
use Carbon\CarbonPeriod;
use App\Models\CompanyData;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyAttendanceOverviewController extends Controller
{
    //my attendance overview
    public function overviewTable(Request $request){
        $month = $request->month;
        $year = $request->year;
        $startTime = $year.'-'.$month.'-'.'01';
        $endTime = Carbon::parse($startTime)->endOfMonth()->format('Y-m-d');
        $period = new CarbonPeriod($startTime,  $endTime);
        $user = User::orderBy('employee_id')->where('id',Auth::user()->id)->get();
        $company = CompanyData::where('id',1)->first();
        $attendances = Check::whereMonth('date',$month)->where('user_id',Auth::user()->id)->whereYear('date',$year)->get();
        return view('components.overViewTabel',compact('period','user','company','attendances'))->render();
    }

     // dataTable
     public function dataTable(Request $request)
     {
         $check = Check::where('user_id',Auth::user()->id);
         if($request->month){
            $check = $check->whereMonth('date',$request->month);
         }
         if($request->year){
            $check = $check->whereYear('date',$request->year);
         }
         return DataTables::of($check)
             ->addColumn('name',function($each){
                 return $each->user ? $each->user->name : '-';
             })
             ->rawColumns([])
             ->make(true);
     }

}
