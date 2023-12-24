@extends('admin.layout.master')
@section('company', 'active')
@section('title', 'Company')
@section('content')
    <div class="container-fluid px-4">
        <main>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                     <div class="card text-secondary">
                        <div class=" card-header"><h2>Company Setting</h2></div>
                        <div class="card-body px-5">
                           <h4 class=" mt-3">Company Name : {{ $company->company_name }}</h4>
                           <h4 class=" mt-3">Company Email : {{ $company->company_email }}</h4>
                           <h4 class=" mt-3">Company Phone : {{ $company->company_phone }}</h4>
                           <h4 class=" mt-3">Company Address : {{ $company->company_address }}</h4>
                           <h4 class=" mt-3">Contact Person : {{ $company->contact_person }}</h4>
                           <h4 class=" mt-3">Office Start Time : {{ $company->office_start_time }}</h4>
                           <h4 class=" mt-3">Office end Time : {{ $company->office_end_time }}</h4>
                           <h4 class=" mt-3">Break Start Time : {{ $company->break_start_time }}</h4>
                           <h4 class=" mt-3">Break end Time : {{ $company->break_end_time }}</h4>
                        </div>
                        <a href="{{ route('companySetting.edit',1) }}" class="p-3">
                        <button class=" btn btn-primary">Edit Company Setting</button>
                    </a>
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

        })
    </script>
@endsection
