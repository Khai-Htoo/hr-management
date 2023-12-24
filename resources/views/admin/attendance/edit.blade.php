@extends('admin.layout.master')
@section('userList', 'active')
@section('title', 'User Edit')
@section('content')
    <div class="container-fluid px-4">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <a class=" pt-2 px-3 text-dark" href="{{ route('attendance.index') }}"><i
                                    class=" fas fa-angle-left"></i></a>
                            <div class="card-body">
                                <form action="{{ route('attendance.update', $check->id) }}" method="post">
                                    @csrf
                                    @method('PATCH')

                                    {{--  Name --}}
                                    <div class="mb-3">
                                        <select name="user_id" class=" form-control select2">
                                            @foreach ($user as $u)
                                                <option value="{{ $u->id }}" @if ($u->id==$check->user_id) selected @endif >{{ $u->employee_id }}({{ $u->name }})</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                     {{--  date --}}
                                     <div class="mb-3">
                                        <label for="">Date</label>
                                        <input type="date" name="date"  class=" form-control" value="{{ $check->date }}">
                                        @error('date')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                     {{--  check in --}}
                                     <div class="mb-3">
                                        <label for="">Checkin</label>
                                        <input type="time" name="check_in" value="{{ $check->check_in }}" class=" form-control">
                                        @error('check_in')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                     {{--  check out --}}
                                     <div class="mb-3">
                                        <label for="">Checkout</label>
                                        <input type="time" name="check_out" value="{{ $check->check_out }}" class=" form-control">
                                        @error('check_out')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <button class=" btn btn-success">Create Department <i
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
