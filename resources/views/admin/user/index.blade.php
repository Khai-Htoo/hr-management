@extends('admin.layout.master')
@section('userList', 'active')
@section('title', 'User Management')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">User List</h1>
        <ol class="breadcrumb mb-4">
            <a href="{{ route('user.create') }}" class=" btn btn-success">Create User <i class=" fas fa-plus"></i></a>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple" class=" tabel-striped" style=" width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Profile</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Nrc Number</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Is Present?</th>
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
                        url: `/user/${id}`,
                    }).done(function(msg) {
                        location.reload();
                    });

                })
            })
            // datatable
            new DataTable('#datatablesSimple', {
                ajax: 'dataTable/user',
                processing: true,
                responsive: true,
                serverSide: true,
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        searchable: true,
                    },
                    {
                        data: 'email',
                        name: 'eamil',
                        searchable: false,
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        sortable: false
                    },
                    {
                        data: 'nrc_number',
                        name: 'nrc_number',
                        sortable: false
                    },
                    {
                        data: 'department_name',
                        name: 'department_name',
                        sortable: false
                    },
                    {
                        data: 'role',
                        name: 'role',
                        sortable: false
                    },
                    {
                        data: 'is_present',
                        name: 'is_present',
                        sortable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        sortable: false
                    }
                ]
            });

        })
    </script>
@endsection
