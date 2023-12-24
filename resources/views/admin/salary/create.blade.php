@extends('admin.layout.master')
@section('salary', 'active')
@section('title', 'salary Create')
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
                                {{ $errors }}
                                <form action="{{ route('salary.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    {{--  Name --}}
                                    <div class=" mb-3">
                                        <label for="" class=" mb-2">Employee name</label>
                                        <select name="user_id" class=" select2 form-control" id="">
                                            <option value="">--Choose employee---</option>
                                            @foreach ($user as $u)
                                                <option value="{{ $u->id }}">{{ $u->name }}</option>
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
                                            <option value="01">Jan</i></option>
                                            <option value="02">Feb</i></option>
                                            <option value="03">Mar</i></option>
                                            <option value="04">Apr</i></option>
                                            <option value="05">May</i></option>
                                            <option value="06">Jun</i></option>
                                            <option value="07">Jul</i></option>
                                            <option value="08">Aug</i></option>
                                            <option value="09">Sep</i></option>
                                            <option value="10">Oct</i></option>
                                            <option value="11">Nov</i></option>
                                            <option value="12">Dec</i></option>
                                        </select>
                                    </div>
                                    {{-- year --}}
                                    <div class=" mb-3">
                                        <select name="year" class=" form-control year " id="">
                                            @for ($i = 0; $i < 5; $i++)
                                                <option value="{{ now()->addYears($i)->format('Y-m-d') }}">
                                                    {{ now()->addYears($i)->format('Y') }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    {{-- salary amount --}}
                                    <div class=" mb-3">
                                        <label for="">Amount</label>
                                        <input type="integer" class=" form-control" name="amount">
                                        @error('amount')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <button class=" btn btn-success">Create Salary <i
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
