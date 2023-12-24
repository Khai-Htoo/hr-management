@extends('admin.layout.master')
@section('project', 'active')
@section('title', 'Project')
@section('content')
    <div class="px-4 mt-5">
        <ol class="breadcrumb mb-4">
            <a href="{{ route('project.create') }}" class=" btn btn-success">Create Project <i class=" fas fa-plus"></i></a>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple" class=" tabel-striped " style=" width:100%">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Team Leader</th>
                            <th>Team Member</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>Deadline</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class=" table-striped "></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // delete
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete',
                    reverseButtons: true
                }).then((result) => {
                    let id = $(this).data('id')
                    $.ajax({
                        type: "DELETE",
                        url: `/project/${id}`,
                    }).done(function(msg) {
                        table.ajax.reload()
                    });

                })
            })
            // datatable
            let table = new DataTable('#datatablesSimple', {
                ajax: 'dataTable/project',
                processing: true,
                responsive: true,
                serverSide: true,
                columns: [
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'team_leader',
                        name: 'team_leader'
                    },
                    {
                        data: 'team_member',
                        name: 'team_member'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'deadline',
                        name: 'deadline'
                    },
                    {
                        data: 'priority',
                        name: 'priority'
                    }
                    ,
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }
                ]
            });

        })
    </script>
@endsection
