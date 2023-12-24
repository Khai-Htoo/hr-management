@extends('admin.layout.master')
@section('checks', 'active')
@section('title', 'Check in/Check out')
@section('content')
    <div class="container px-4 mt-5">
        <ol class="breadcrumb mb-4">
            <a href="{{ route('attendance.create') }}" class=" btn btn-success">Create Attendance <i class=" fas fa-plus"></i></a>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple" class=" tabel-striped" style=" width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
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
                        url: `/attendance/${id}`,
                    }).done(function(msg) {
                        location.reload();
                    });

                })
            })
            // datatable
            new DataTable('#datatablesSimple', {
                ajax: 'dataTable/attendance',
                processing: true,
                responsive: true,
                serverSide: true,
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'check_in',
                        name: 'check_in'
                    },
                    {
                        data: 'check_out',
                        name: 'check_out'
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
