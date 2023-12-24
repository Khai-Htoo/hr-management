@extends('admin.layout.master')
@section('role', 'active')
@section('title', 'Role')
@section('content')
    <div class="container px-4 mt-5">
        <ol class="breadcrumb mb-4">
            <a href="{{ route('role.create') }}" class=" btn btn-success">Create Role <i class=" fas fa-plus"></i></a>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple" class=" tabel-striped" style=" width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Permission</th>
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
                        url: `/role/${id}`,
                    }).done(function(msg) {
                        location.reload();
                    });

                })
            })
            // datatable
            new DataTable('#datatablesSimple', {
                ajax: 'dataTable/role',
                processing: true,
                responsive: true,
                serverSide: true,
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'permission',
                        name: 'permission'
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
