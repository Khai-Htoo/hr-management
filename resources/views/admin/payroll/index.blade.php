@extends('admin.layout.master')
@section('payroll', 'active')
@section('title', 'Payroll Overview')
@section('content')
    <div class="container-fluid px-4 mt-5">
        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <select name="" class=" form-control month" >
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
                            @for ($i=0;$i<5;$i++)
                            <option value="{{ now()->subYear($i)->format('Y') }}" @if (now()->format('Y')==now()->subYear($i)->format('Y')) selected @endif>{{ now()->subYear($i)->format('Y') }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                      <input type="text" placeholder="Search name..." class="name form-control">
                    </div>
                    <div class="col-md-1">
                        <button class="filter"> <i class="fa-solid fa-filter"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            overviewTbale()
             function overviewTbale(){
                var month = $('.month').val()
                var year = $('.year').val()
                var name = $('.name').val()
                 $.ajax({
                    url : `payroll-overview-table?name=${name}&month=${month}&year=${year}`,
                    type : 'GET',
                    success : function(res){
                        $('.table-responsive').html(res)
                    }
                 })
             }
             $('.filter').on('click',function(e){
                e.preventDefault();
                overviewTbale()
             })
        })
    </script>
@endsection
