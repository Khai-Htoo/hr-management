@extends('admin.layout.master')
@section('permission', 'active')
@section('title', 'Permission Create')
@section('content')
    <div class="container-fluid px-4">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <a class=" pt-2 px-3 text-dark" href="{{ route('permission.index') }}"><i
                                    class=" fas fa-angle-left"></i></a>
                            <div class="card-body">
                                <form action="{{ route('permission.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    {{--  Name --}}
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('name') is-invalid @enderror " type="text"
                                            placeholder="" name="name" />
                                        <label>Name</label>
                                        @error('name')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <button class=" btn btn-success">Create Permission <i
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
