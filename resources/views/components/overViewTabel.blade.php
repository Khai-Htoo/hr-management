<table id="datatablesSimple" class="text-center  table-bordered" style=" width:100%">
    <thead>
        <tr>
            <th>Employee</th>
            @foreach ($period as $p)
                <th class=" @if ($p->format('D')== 'Sat' || $p->format('D')== 'Sun') offday @endif">{{ $p->format('d') }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $u)
            <tr>
                <td>{{ $u->name }}</td>
                @foreach ($period as $p)
                    @php
                        $check_in_icon = '';
                        $attendance = collect($attendances)
                            ->where('user_id', $u->id)
                            ->where('date', $p->format('Y-m-d'))
                            ->first();
                        if ($attendance) {
                            if ($attendance->check_in < $company->office_start_time) {
                                $check_in_icon = '<i class=" fas fa-check-circle text-success"></i>';
                            } elseif ($attendance->check_in > $company->office_start_time && $attendance->check_in < $company->break_start_time) {
                                $check_in_icon = '<i class=" fas fa-check-circle text-warning"></i>';
                            } elseif ($attendance->check_in > $company->break_start_time) {
                                $check_in_icon = '<i class="fa-regular fa-circle-xmark text-danger"></i>';
                            }
                        }
                        $check_out_icon = '';
                        $attendance = collect($attendances)
                            ->where('user_id', $u->id)
                            ->where('date', $p->format('Y-m-d'))
                            ->first();
                        if ($attendance) {
                            if ($attendance->check_out < $company->break_end_time) {
                                $check_out_icon = '<i class="fa-regular fa-circle-xmark text-danger"></i>';
                            } elseif ($attendance->check_out >= $company->office_end_time) {
                                $check_out_icon = '<i class=" fas fa-check-circle text-success"></i>';
                            } elseif ($attendance->check_out < $company->office_end_time) {
                                $check_out_icon = '<i class="fa-regular fa-circle-xmark text-danger"></i>';
                            }
                        }
                    @endphp
                    <td>
                        {!! $check_in_icon !!} <br>
                        {!! $check_out_icon !!}
                    </td>

                    {{-- <td>{{ $attendance->check_in }}</td> --}}
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
