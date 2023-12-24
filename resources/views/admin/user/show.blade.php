@extends('admin.layout.master')
@section('profile', 'active')
@section('title', 'User profile')
@section('content')
    <div class="container px-4 py-5">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-center text-secondary dash">
                        <img src="{{ asset('storage/' . $user->image) }}"
                            style=" width : 200px ; height : 200px ; border-radius : 100%" class="mb-3 pp-img img-thumbnail">
                        <h4>Employee-id : {{ $user->employee_id }}</h4>
                        <h4>Phone :{{ $user->phone }}</h4>
                        <h4 class=" text-success">{{ $user->department->name }}</h4>
                    </div>
                    <div class="col-md-6 p-3 px-5">
                        <h4 class=" mb-3">Email : {{ $user->email }}</h4>
                        <h4 class=" mb-3">NRC Number : {{ $user->nrc_number }}</h4>
                        <h4 class=" mb-3">Gender : {{ $user->gender }}</h4>
                        <h4 class=" mb-3">Birthday : {{ $user->birthday }}</h4>
                        <h4 class=" mb-3">Address : {{ $user->address }}</h4>
                        <h4 class=" mb-3">Join-Date : {{ $user->join_date }}</h4>
                        <h4 class=" mb-3">is-present :
                            @if ($user->is_present == 1)
                                <span class=' btn btn-sm btn-success'>present</span>
                            @else
                                <span class=' btn btn-sm btn-danger'>Leave</span>
                            @endif

                        </h4>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {



        })
    </script>
@endsection
