@extends('admin.layout.master')
@section('myProject', 'active')
@section('title', 'My Project')
@section('content')
    <div class="px-4 mt-5">
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
            // datatable
            let table = new DataTable('#datatablesSimple', {
                ajax: 'dataTable/myProject',
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
