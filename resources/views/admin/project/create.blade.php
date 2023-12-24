@extends('admin.layout.master')
@section('project', 'active')
@section('title', 'Project Create')
@section('content')
    <div class="container-fluid px-4">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <a class=" pt-2 px-3 text-dark" href="{{ route('project.index') }}"><i
                                    class=" fas fa-angle-left"></i></a>
                            <div class="card-body">
                                <form action="{{ route('project.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    {{--  title --}}
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('title') is-invalid @enderror " type="text"
                                            placeholder="" name="title" />
                                        <label>Title</label>
                                        @error('title')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{--  description --}}
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('description') is-invalid @enderror "
                                            type="text" placeholder="" name="description" />
                                        <label>Description</label>
                                        @error('description')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{-- image --}}
                                    <div class="mb-3">
                                        <label for="">Image</label>
                                        <input multiple accept="image/*" type="file" class=" form-control" id="image" name="image[]">
                                        <div class="previewImg mb-2"></div>
                                        @error('image')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{-- file --}}
                                    <div class="mb-3">
                                        <label for="">File</label>
                                        <input accept=".pdf, .xls, .xlsx" multiple type="file" class=" form-control" id="image" name="files[]">
                                        @error('files')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{-- team leader --}}
                                    <div class="mb-3">
                                        <label for="">Team Leader</label>
                                        <select multiple name="team_leader[]" class=" form-control select2">
                                            <option value="">--Choose--</option>
                                            @foreach ($user as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('team_leader')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{-- team menber --}}
                                    <div class="mb-3">
                                        <label for="">Team Member</label>
                                        <select multiple name="team_menber[]" class=" form-control select2">
                                            <option value="">--Choose--</option>
                                            @foreach ($user as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('team_menber')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>


                                    {{-- starttime --}}
                                    <div class="mb-3">
                                        <label for="">Starttime</label>
                                        <input type="date" class=" form-control" name="start_date">
                                        @error('start_date')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{-- deadline --}}
                                    <div class="mb-3">
                                        <label for="">Deadline</label>
                                        <input type="date" class=" form-control" name="deadline">
                                        @error('deadline')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{-- Priority --}}
                                    <div class="mb-3">
                                        <label for="">Priority</label>
                                        <select name="priority" class=" form-control select2">
                                            <option value="">--Choose--</option>
                                            <option value="high">High</option>
                                            <option value="middle">Middle</option>
                                            <option value="low">Low</option>
                                        </select>
                                        @error('priority')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{-- status --}}
                                    <div class="mb-3">
                                        <label for="">Status</label>
                                        <select name="status" class=" form-control select2">
                                            <option value="">--Choose--</option>
                                            <option value="pending">Pending</option>
                                            <option value="in_progress">In Progress</option>
                                            <option value="complete">Complete</option>
                                        </select>
                                        @error('status')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <button class=" btn btn-success">Create Project <i
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
            $('#image').on('change',function(){
            let imgLength = document.getElementById('image').files.length
            $('.previewImg').html('')
            for(var i = 0;i < imgLength;i++){
                $('.previewImg').append(`<img class=" img-thumbnail" src="${URL.createObjectURL(event.target.files[i])}">`)
            }
           })
        })
    </script>
@endsection
