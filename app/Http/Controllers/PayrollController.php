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

class PayrollController extends Controller
{
    //  payroll
    public function overview(){
        return view('admin.payroll.index');
    }

     //my payroll overview
     public function overviewTable(Request $request){
        $month = $request->month;
        $year = $request->year;
        $startTime = $year.'-'.$month.'-'.'01';
        $dayInMonth = Carbon::parse( $startTime)->daysInMonth;
        $endTime = Carbon::parse($startTime)->endOfMonth()->format('Y-m-d');
        $workingDay = Carbon::parse($startTime)->diffInDaysFiltered(function(Carbon $date){
            return $date->isWeekday();
        },Carbon::parse($endTime));
        $workingDay =  $workingDay+1;
        $offDay = $dayInMonth-$workingDay;
        $period = new CarbonPeriod($startTime,  $endTime);
        $user = User::orderBy('employee_id')->get();
        $company = CompanyData::where('id',1)->first();
        $attendances = Check::whereMonth('date',$month)->whereYear('date',$year)->get();
        return view('components.payroll',compact('period','month','year','user','company','attendances','dayInMonth','workingDay','offDay'))->render();
    }


}
