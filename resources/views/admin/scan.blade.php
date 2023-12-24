@extends('admin.layout.master')
@section('title', 'Attendance Scan')
@section('scan', 'active')
@section('content')
    {{-- scan --}}
    <div class="mx-5 justify-content-center mt-5 mb-5">
        <div class=" card">
            <div class="card-body">
                <div class=" text-center">
                    <img src="{{ asset('image/qr-code-monochromatic.svg') }}" style=" width:100%; height :300px"
                        alt=""> <br>
                    <p>Please Scan Attendance QR</p>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Scan
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Scan & Qr Pay</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <video id="scan" style="width: 100% ; height : 300px"></video>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="close"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- overview --}}
    <div class="card mb-2 mx-5">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <select name="" class=" form-control month">
                        <option value="">Filter by month </i></option>
                        <option value="01" @if (now()->format('m') == '01') selected @endif>Jan</i></option>
                        <option value="02" @if (now()->format('m') == '02') selected @endif>Feb</i></option>
                        <option value="03" @if (now()->format('m') == '03') selected @endif>Mar</i></option>
                        <option value="04" @if (now()->format('m') == '04') selected @endif>Apr</i></option>
                        <option value="05" @if (now()->format('m') == '05') selected @endif>May</i></option>
                        <option value="06" @if (now()->format('m') == '06') selected @endif>Jun</i></option>
                        <option value="07" @if (now()->format('m') == '07') selected @endif>Jul</i></option>
                        <option value="08" @if (now()->format('m') == '08') selected @endif>Aug</i></option>
                        <option value="09" @if (now()->format('m') == '09') selected @endif>Sep</i></option>
                        <option value="10" @if (now()->format('m') == '10') selected @endif>Oct</i></option>
                        <option value="11" @if (now()->format('m') == '11') selected @endif>Nov</i></option>
                        <option value="12" @if (now()->format('m') == '12') selected @endif>Dec</i></option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="" class=" form-control year " id="">
                        <option value="">Filter by year </option>
                        @for ($i = 0; $i < 5; $i++)
                            <option value="{{ now()->subYear($i)->format('Y') }}"
                                @if (now()->format('Y') ==
                                        now()->subYear($i)->format('Y')) selected @endif>{{ now()->subYear($i)->format('Y') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-1">
                    <button class=" filter"> <i class="fa-solid fa-filter"></i></button>
                </div>
            </div>
        </div>
    </div>
    {{-- attendance --}}
    <div class="card mb-4 mx-5">
        <div class="card-body">
            <h4 class=" mb-2">Attendance Overview</h4>
            <div class="table-responsive">

            </div>
        </div>
    </div>
    {{-- payroll --}}
    <div class="card mb-4 mx-5">
        <div class="card-body">
            <h4 class=" mb-2">Payroll Overview</h4>
            <div class="payroll">

            </div>
        </div>
    </div>
    {{-- datatable --}}
    <div class="mx-5 px-4 mt-5">
        <div class="card mb-4">
            <div class="card-body">
                <h3 class=" mb-2">Attendance Datatable</h3>
                <table id="datatablesSimple" class=" tabel-striped" style=" width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                        </tr>
                    </thead>
                    <tbody class=" table-striped "></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/scan/qr-scanner.umd.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // datatable
            var table = new DataTable('#datatablesSimple', {
                ajax: 'dataTable/myAttendance',
                processing: true,
                responsive: true,
                serverSide: true,
                columns: [{
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
                    }
                ]
            });

            @if (session('fail'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ session('fail') }}",
                })
            @endif

            // overview
            overviewTbale()

            function overviewTbale() {
                var month = $('.month').val()
                var year = $('.year').val()
                $.ajax({
                    url: `my-attendance-overview?month=${month}&year=${year}`,
                    type: 'GET',
                    success: function(res) {
                        $('.table-responsive').html(res)
                    }
                })
            }

            // payroll
            payroll()
             function payroll(){
                var month = $('.month').val()
                var year = $('.year').val()
                var name = $('.name').val()
                 $.ajax({
                    url : `my-payroll?month=${month}&year=${year}`,
                    type : 'GET',
                    success : function(res){
                        $('.payroll').html(res)
                    }
                 })
             }
             $('.filter').on('click',function(e){
                e.preventDefault();
                overviewTbale()
                payroll()
             })

            $('.filter').on('click', function(e) {
                var month = $('.month').val()
                var year = $('.year').val()
                e.preventDefault();
                overviewTbale()
                table.ajax.url(`dataTable/myAttendance?month=${month}&&year=${year}`).load();
            })

            // qr scanner

            let videoElem = document.getElementById('scan')
            const qrScanner = new QrScanner(
                videoElem,
                function(result) {
                    if (result) {
                        qrScanner.stop();
                        $.ajax({
                            type: 'POST',
                            url: "/attendance",
                            data: {
                                'date': result
                            },
                            success: function(res) {
                                if (res.status == 'success') {
                                    const Toast = Swal.mixin({
                                        position: 'top-center',
                                    })

                                    Toast.fire({
                                        icon: 'success',
                                        title: res.msg
                                    })
                                    $('.pincode-input-text').val('')
                                }
                                if (res.status == 'fail') {
                                    const Toast = Swal.mixin({
                                        position: 'top-center',
                                    })

                                    Toast.fire({
                                        icon: 'error',
                                        title: res.msg
                                    })
                                    $('.pincode-input-text').val('')
                                }
                            }
                        });
                    }
                },
            );
            $('#exampleModal').on('shown.bs.modal', function(event) {
                qrScanner.start();
            })

            $('#exampleModal').on('hidden.bs.modal', function(event) {
                qrScanner.stop();
            })

        })
    </script>
@endsection
