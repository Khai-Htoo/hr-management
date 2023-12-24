@extends('admin.layout.master')
@section('project', 'active')
@section('title', 'Project')
@section('content')
    <div class="px-4 mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4>{{ $project->title }}</h4>
                        <div class=" d-flex mt-3">
                            <h5>Start Date :<span class=" text-muted mx-2">{{ $project->start_date }}</span></h5>
                            <h5>Deadline :<span class=" text-muted">{{ $project->deadline }}</span></h5>
                        </div>
                        <div class=" d-flex mt-2">
                            <h5 class="">Priority : <span
                                    class="
                                 @if ($project->priority == 'high') btn btn-sm btn-danger @endif
                                 @if ($project->priority == 'middle') btn btn-sm btn-warning @endif
                                   @if ($project->priority == 'low') btn btn-sm btn-info @endif
                                 ">{{ $project->priority }}</span>
                            </h5>
                            <h5 class=" mx-3">Status : <span
                                    class="
                             @if ($project->status == 'pending') btn btn-sm btn-warning @endif
                             @if ($project->status == 'in_progress') btn btn-sm btn-info @endif
                               @if ($project->status == 'complete') btn btn-sm btn-success @endif
                             ">{{ $project->status }}</span>
                            </h5>
                        </div>
                        <div class="">
                            <h5>Description</h5>
                            <span>{{ $project->description }}</span>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <label for="">Images</label> <br>
                        <div id="images">
                            @foreach ($project->image as $image)
                                <img class="img-thumbnail" src="{{ asset('storage/' . $image) }}"
                                    style="width:100px;height:100px">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <label for="">Images</label> <br>
                        @foreach ($project->files as $file)
                            <a href="{{ asset('storage/' . $file) }}" class=" text-dark img-thumbnail"><i
                                    class="fa-solid fa-file-pdf" style=" width:50px;height:80px"></i></a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>Team Leader</h5>
                        @foreach ($project->teamLeader as $leader)
                            <img src="{{ asset('storage/' . $leader->image) }}" class=" img-thumbnail"
                                style=" width:100px;height:100px;border-radius:100%">
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5>Team Member</h5>
                        @foreach ($project->teamMember as $member)
                            <img src="{{ asset('storage/' . $member->image) }}" class=" img-thumbnail"
                                style=" width:100px;height:100px;border-radius:100%">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            new Viewer(document.getElementById('images'));
        })
    </script>
@endsection
