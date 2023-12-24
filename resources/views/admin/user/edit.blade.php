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
                            <a class=" pt-2 px-3 text-dark" href="{{ route('user.index') }}"><i
                                    class=" fas fa-angle-left"></i></a>
                            <div class="card-body">
                                <form action="{{ route('user.update', $user->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    {{-- employee id --}}
                                    <div class="form-floating mb-3">
                                        <input value="{{ $user->employee_id }}"
                                            class="form-control @error('employee_id') is-invalid @enderror " type="text"
                                            placeholder="" name="employee_id" />
                                        <label>Employee ID</label>
                                        @error('employee_id')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{--  Name --}}
                                    <div class="form-floating mb-3">
                                        <input value="{{ $user->name }}"
                                            class="form-control @error('name') is-invalid @enderror " type="text"
                                            placeholder="" name="name" />
                                        <label>Name</label>
                                        @error('name')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{--  Email --}}
                                    <div class="form-floating mb-3">
                                        <input value="{{ $user->email }}"
                                            class="form-control @error('email') is-invalid @enderror " type="text"
                                            placeholder="" name="email" />
                                        <label>Email</label>
                                        @error('email')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{--  Phone --}}
                                    <div class="form-floating mb-3">
                                        <input value="{{ $user->phone }}"
                                            class="form-control @error('phone') is-invalid @enderror " type="number"
                                            placeholder="" name="phone" />
                                        <label>Phone</label>
                                        @error('phone')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{--  Phone --}}
                                    <div class="form-floating mb-3">
                                        <input value="{{ $user->pin_code }}"
                                            class="form-control @error('pin_code') is-invalid @enderror " type="number"
                                            placeholder="" name="pin_code" />
                                        <label>Pin Code</label>
                                        @error('pin_code')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    {{-- image --}}
                                    <div class="previewImg">
                                        @if ($user->image)
                                            <img class=" mb-2" src="{{ asset('storage/' . $user->image) }}"
                                                alt="">
                                        @else
                                            <img src="{{ asset('storage/man.png') }}" alt="">
                                        @endif
                                    </div>
                                    <input type="file" name="image" class="form-control mb-3">

                                    {{--  Address --}}
                                    <div class="form-floating mb-3">
                                        <input value="{{ $user->address }}"
                                            class="form-control @error('address') is-invalid @enderror " type="text"
                                            placeholder="" name="address" />
                                        <label>Address</label>
                                        @error('address')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{--  nrc number --}}
                                    <div class="form-floating mb-3">
                                        <input value="{{ $user->nrc_number }}"
                                            class="form-control @error('nrc_number') is-invalid @enderror " type="text"
                                            placeholder="" name="nrc_number" />
                                        <label>NRC Number</label>
                                        @error('nrc_number')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{-- role --}}
                                    <div class=" mb-3">
                                        <label for="">Role</label>
                                        <select name="role[]" class="form-control select2" multiple>
                                            @foreach ($role as $r)
                                                <option value="{{ $r->id }}"
                                                    @if (in_array($r->id, $oldRole)) selected @endif>{{ $r->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{--  gender --}}
                                    <div class=" mb-3">
                                        <label for="">Gender</label>
                                        <select name="gender" class=" form-control @error('gender') is-invalid @enderror ">
                                            <option @if ($user->gender == 'male') selected @endif value="male">Male
                                            </option>
                                            <option @if ($user->gender == 'female') selected @endif value="female">Female
                                            </option>
                                        </select>
                                        @error('gender')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{--  department --}}
                                    <div class=" mb-3">
                                        <label for="">Department</label>
                                        <select name="department_id"
                                            class=" form-control @error('department_id') is-invalid @enderror ">
                                            @foreach ($department as $d)
                                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{--  birthday --}}
                                    <div class=" mb-3">
                                        <label>Birthday</label>
                                        <input value="{{ $user->birthday }}"
                                            class="form-control @error('birthday') is-invalid @enderror " type="date"
                                            name="birthday" />
                                        @error('birthday')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{--  join date --}}
                                    <div class=" mb-3">
                                        <label>Join Date</label>
                                        <input value="{{ $user->join_date }}"
                                            class="form-control @error('join_date') is-invalid @enderror " type="date"
                                            name="join_date" />
                                        @error('join_date')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <button type="submit" class=" btn btn-success">Update User <i
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
            $('#image').on('change', function() {
                let imgLength = document.getElementById('image').files.length
                $('.previewImg').html('')
                for (let i = 0; i < imgLength; i++) {
                    $('.previewImg').append(`<img src="${URL.createObjectURL(event.target.files[i])}" >`)
                }
            })
        })
    </script>
@endsection
