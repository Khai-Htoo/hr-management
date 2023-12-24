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
                            <a class=" pt-2 px-3 text-dark" href="{{ route('project.index') }}"><i
                                    class=" fas fa-angle-left"></i></a>
                            <div class="card-body">
                                <form action="{{ route('project.update', $project->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')

                                    {{--  title --}}
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('title') is-invalid @enderror " type="text"
                                            value="{{ $project->title }}" placeholder="" name="title" />
                                        <label>Title</label>
                                        @error('title')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{--  description --}}
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('description') is-invalid @enderror "
                                            value="{{ $project->description }}" type="text" placeholder=""
                                            name="description" />
                                        <label>Description</label>
                                        @error('description')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{-- image --}}
                                    <div class="mb-3">
                                        <label for="">Image</label> <br>
                                        <div class="previewImg">
                                            @foreach ($project->image as $p)
                                                <img src="{{ asset('storage/' . $p) }}" class=" img-thumbnail mb-2"
                                                    style="width : 50px ;  height : 50px">
                                            @endforeach
                                        </div>
                                        <input  multiple accept="image/*" type="file" class=" form-control" id="image"
                                            name="image[]">
                                        @error('image')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{-- file --}}
                                    <div class="mb-3">
                                        <label for="">File</label>
                                        <input accept=".pdf, .xls, .xlsx" multiple type="file" class=" form-control"
                                            id="image" name="files[]">
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
                                                    <option value="{{ $u->id }}"
                                                        @if (in_array($u->id,collect($project->teamLeader)->pluck('id')->toArray())) selected @endif>
                                                        {{ $u->name }}</option>
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
                                                    <option value="{{ $u->id }}"
                                                        @if (in_array($u->id,collect($project->teamMember)->pluck('id')->toArray())) selected @endif>
                                                        {{ $u->name }}</option>
                                                @endforeach
                                        </select>
                                        @error('team_menber')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>


                                    {{-- starttime --}}
                                    <div class="mb-3">
                                        <label for="">Start Date</label>
                                        <input type="date" class=" form-control" name="start_date" value="{{ $project->start_date }}">
                                        @error('start_date')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{-- deadline --}}
                                    <div class="mb-3">
                                        <label for="">Deadline</label>
                                        <input type="date" class=" form-control" name="deadline" value="{{ $project->deadline }}">
                                        @error('deadline')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    {{-- Priority --}}
                                    <div class="mb-3">
                                        <label for="">Priority</label>
                                        <select name="priority" class=" form-control select2">
                                            <option value="">--Choose--</option>
                                            <option value="high" @if ($project->priority == 'high') selected @endif>High</option>
                                            <option value="middle" @if ($project->priority == 'middle') selected @endif>Middle</option>
                                            <option value="low" @if ($project->priority == 'low') selected @endif>Low</option>
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
                                            <option value="pending" @if ($project->status == 'pending') selected @endif>Pending</option>
                                            <option value="in_progress" @if ($project->status == 'in_prograss') selected @endif>In Progress</option>
                                            <option value="complete" @if ($project->status == 'complete') selected @endif>Complete</option>
                                        </select>
                                        @error('status')
                                            <strong class=" text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>


                                    <button type="submit" class=" btn btn-success">Update Project <i
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
