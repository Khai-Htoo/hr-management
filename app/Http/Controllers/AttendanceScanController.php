<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Check;
use App\Models\CompanyData;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AttendanceScanController extends Controller
{
    //attendance scan
    public function scan()
    {
        return view('admin.scan');
    }

    // attendance qr scan
    public function attendance(Request $request)
    {
        if (Hash::check(date('Y-m-d'), $request->date)) {
            $check = Check::firstOrCreate([
                'user_id' => Auth::user()->id,
                'date' => now()->format('Y-m-d'),
            ]);

            if(now()->format('D') == 'Sat' || now()->format('D') == 'Sun'){
                return ['status' => 'fail', 'msg' => 'Today is OffDay'];
            }

            if ($check->check_in == null) {
                Check::where('user_id', Auth::user()->id)->update(['check_in' => now()->format('H:i:s')]);
                return ['status' => 'success', 'msg' => 'Successfully Check In' . now()];
            } elseif (is_null($check->check_out)) {
                Check::where('user_id', Auth::user()->id)->update(['check_out' => now()->format('H:i:s')]);
                return ['status' => 'success', 'msg' => 'Successfully Check Out' . now()];
            }

            if ($check->check_in != null && $check->check_out != null) {
                return ['status' => 'fail', 'msg' => 'Already check in check out'];
            }

        }

        return ['status' => 'fail', 'msg' => 'Qr Scan incorrect!'];

    }

    // attendance-overview
    public function overview(Request $request){
       return view('admin.overview');
    }

    // attendance overview table
    public function overviewTable(Request $request){
        $month = $request->month;
        $year = $request->year;
        $startTime = $year.'-'.$month.'-'.'01';
        $endTime = Carbon::parse($startTime)->endOfMonth()->format('Y-m-d');
        $period = new CarbonPeriod($startTime,  $endTime);
        $user = User::orderBy('employee_id')->where('name','like','%'.$request->name.'%')->get();
        $company = CompanyData::where('id',1)->first();
        $attendances = Check::whereMonth('date',$month)->whereYear('date',$year)->get();
        return view('components.overViewTabel',compact('period','user','company','attendances'))->render();
    }
}
