<table id="datatablesSimple" class="text-center  table-bordered" style=" width:100%">
    <thead>
        <tr>
            <th>Employee</th>
            <th>Role</th>
            <th>Day of month</th>
            <th>Working Day</th>
            <th>Off Day</th>
            <th>Attendance Day</th>
            <th>Leave</th>
            <th>Per Day (mmk)</th>
            <th>Total (mmk)</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($user as $u)
        @php
        $attendanceDays = 0;
        $salary = collect($u->salary)->where('month',$month)->where('year',$year)->first();
        $perDay = $salary ? ($salary->amount/$workingDay) : 0;
    @endphp
    @foreach ($period as $p)
        @php
            $attendance = collect($attendances)
                ->where('user_id',$u->id)
                ->where('date', $p->format('Y-m-d'))
                ->first();
            if ($attendance) {
                if ($attendance->check_in < $company->office_start_time) {
                    $attendanceDays += 0.5;
                } elseif ($attendance->check_in > $company->office_start_time && $attendance->check_in < $company->break_start_time) {
                    $attendanceDays += 0.5;
                } elseif ($attendance->check_in > $company->break_start_time) {
                    $attendanceDays += 0;
                }
            }
            $attendance = collect($attendances)
            ->where('user_id',$u->id)
                ->where('date', $p->format('Y-m-d'))
                ->first();
            if ($attendance) {
                if ($attendance->check_out < $company->break_end_time) {
                    $attendanceDays += 0;
                } elseif ($attendance->check_out >= $company->office_end_time) {
                    $attendanceDays += 0.5;
                } elseif ($attendance->check_out < $company->office_end_time) {
                    $attendanceDays += 0.5;
                }
            }
        @endphp

        @php
            $total = $perDay*$attendanceDays
        @endphp

    @endforeach
            <tr>
                <td>{{ $u->name }}</td>
                <td>{{ implode(',', $u->roles->pluck('name')->toArray()) }}</td>
                <td>{{ $dayInMonth }}</td>
                <td>{{ $workingDay }}</td>
                <td>{{ $offDay }}</td>
                <td>{{ $attendanceDays }}</td>
                <td>{{ $workingDay-$attendanceDays }}</td>
                <td>{{ number_format($perDay)}}</td>
                <td>{{ number_format($total) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
