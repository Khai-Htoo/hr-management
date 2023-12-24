@extends('admin.layout.master')
@section('role', 'active')
@section('title', 'Role Create')
@section('content')
    <div class="container-fluid px-4">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <a class=" pt-2 px-3 text-dark" href="{{ route('role.index') }}"><i
                                    class=" fas fa-angle-left"></i></a>
                            <div class="card-body">
                                <form action="{{ route('role.store') }}" method="post" enctype="multipart/form-data">
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
                                    <div class="row mb-3">
                                        @foreach ($permission as $p)
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="permission[]" type="checkbox" value="{{ $p->name }}"
                                                        id="{{ $p->id }}">
                                                    <label class="form-check-label" for="{{ $p->id }}">
                                                        {{ $p->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class=" btn btn-success">Create Role <i
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
