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
                            <a class=" pt-2 px-3 text-dark" href="{{ route('companySetting.show',1) }}"><i
                                    class=" fas fa-angle-left"></i></a>
                            <div class="card-body">
                                <form action="{{ route('companySetting.update',1) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    {{--  Name --}}
                                    <div class="form-floating mb-3">
                                        <input value="{{ $company->company_name }}"
                                            class="form-control @error('company_name') is-invalid @enderror " type="text"
                                            placeholder="" name="company_name" />
                                        <label>Company Name</label>
                                        @error('company_name')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{--  email --}}
                                    <div class="form-floating mb-3">
                                        <input value="{{ $company->company_email }}"
                                            class="form-control @error('company_email') is-invalid @enderror " type="text"
                                            placeholder="" name="company_email" />
                                        <label>Company Email</label>
                                        @error('company_email')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{--  address --}}
                                    <div class="form-floating mb-3">
                                        <input value="{{ $company->company_address }}"
                                            class="form-control @error('company_address') is-invalid @enderror " type="text"
                                            placeholder="" name="company_address" />
                                        <label>Company Address</label>
                                        @error('company_address')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{--  Phone --}}
                                    <div class="form-floating mb-3">
                                        <input value="{{ $company->company_phone }}"
                                            class="form-control @error('company_phone') is-invalid @enderror " type="text"
                                            placeholder="" name="company_phone" />
                                        <label>Company Phone</label>
                                        @error('company_phone')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                     {{--  contact person --}}
                                     <div class="form-floating mb-3">
                                        <input value="{{ $company->contact_person }}"
                                            class="form-control @error('contact_person') is-invalid @enderror " type="text"
                                            placeholder="" name="contact_person" />
                                        <label>Contact Person</label>
                                        @error('contact_person')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{-- company start time --}}
                                    <div class="form-floating mb-3">
                                        <input value="{{ $company->office_start_time }}"
                                            class="form-control @error('office_start_time') is-invalid @enderror " type="text"
                                            placeholder="" name="office_start_time" />
                                        <label>Office Start time</label>
                                        @error('office_start_time')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                     {{-- company stop time --}}
                                     <div class="form-floating mb-3">
                                        <input value="{{ $company->office_end_time }}"
                                            class="form-control @error('office_end_time') is-invalid @enderror " type="text"
                                            placeholder="" name="office_end_time" />
                                        <label>Office end time</label>
                                        @error('office_end_time')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{-- break start time --}}
                                    <div class="form-floating mb-3">
                                        <input value="{{ $company->break_start_time }}"
                                            class="form-control @error('break_start_time') is-invalid @enderror " type="text"
                                            placeholder="" name="break_start_time" />
                                        <label>Break start time</label>
                                        @error('break_start_time')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>


                                    {{-- break end time --}}
                                    <div class="form-floating mb-3">
                                        <input value="{{ $company->break_end_time }}"
                                            class="form-control @error('break_end_time') is-invalid @enderror " type="text"
                                            placeholder="" name="break_end_time" />
                                        <label>Break end time</label>
                                        @error('break_end_time')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <button type="submit" class=" btn btn-success">Update Department <i
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
