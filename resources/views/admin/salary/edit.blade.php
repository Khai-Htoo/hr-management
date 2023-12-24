@extends('admin.layout.master')
@section('salary', 'active')
@section('title', 'Salary Update')
@section('content')
    <div class="container-fluid px-4">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <a class=" pt-2 px-3 text-dark" href="{{ route('salary.index') }}"><i
                                    class=" fas fa-angle-left"></i></a>
                            <div class="card-body">
                                <form action="{{ route('salary.update',$salary->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    {{--  Name --}}
                                    <div class=" mb-3">
                                        <label for="" class=" mb-2">Employee name</label>
                                        <select name="user_id" class=" select2 form-control" id="">
                                            <option value="">--Choose employee---</option>
                                            @foreach ($user as $u)
                                                <option value="{{ $u->id }}" @if ($u->id == $salary->user->id) selected @endif>{{ $u->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('name')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    {{-- month --}}
                                    <div class="mb-3">
                                        <label for="">Month</label>
                                        <select name="month" class=" form-control month">
                                            <option value="01" @if($salary->month == '01') selected @endif >Jan</i></option>
                                            <option value="02" @if($salary->month == '02') selected @endif >Feb</i></option>
                                            <option value="03" @if($salary->month == '03') selected @endif >Mar</i></option>
                                            <option value="04" @if($salary->month == '04') selected @endif >Apr</i></option>
                                            <option value="05" @if($salary->month == '05') selected @endif >May</i></option>
                                            <option value="06" @if($salary->month == '06') selected @endif >Jun</i></option>
                                            <option value="07" @if($salary->month == '07') selected @endif >Jul</i></option>
                                            <option value="08" @if($salary->month == '08') selected @endif >Aug</i></option>
                                            <option value="09" @if($salary->month == '09') selected @endif >Sep</i></option>
                                            <option value="10" @if($salary->month == '10') selected @endif >Oct</i></option>
                                            <option value="11" @if($salary->month == '11') selected @endif >Nov</i></option>
                                            <option value="12" @if($salary->month == '12') selected @endif >Dec</i></option>
                                        </select>
                                    </div>
                                    {{-- year --}}
                                    <div class=" mb-3">
                                        <select name="year" class=" form-control year " id="">
                                            @for ($i = 0; $i < 5; $i++)
                                                <option value="{{ now()->addYears($i)->format('Y-m-d') }}" @if($salary->year == now()->addYears($i)->format('Y-m-d')) selected @endif>
                                                    {{ now()->addYears($i)->format('Y') }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    {{-- salary amount --}}
                                    <div class=" mb-3">
                                        <label for="">Amount</label>
                                        <input type="integer" class=" form-control" value="{{ $salary->amount }}" name="amount">
                                        @error('amount')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <button class=" btn btn-success">Update Salary <i
                                            class=" fas fa-plus-circle"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

        })
    </script>
@endsection
