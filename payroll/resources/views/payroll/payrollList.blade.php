@extends('layouts.sideNav')

@section('content')
<h4>PAYROLL STATUS</h4>


<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<script src="{{ asset('frontend') }}/js/dataTables.bootstrap4.js"></script>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script>
// to search the REPAIR FORM 
$(document).ready(function() {
    $('#dataTable').DataTable({
        "order": [
            [0, "asc"]
        ],
        "language": {
            search: '<i class="fa fa-search" aria-hidden="true"></i>',
            searchPlaceholder: 'Search By Staff Name'
        }
    });

    // filter REPAIR FORM
    $('.dataTables_filter input[type="search"]').css({
        'width': '300px',
        'display': 'inline-block',
        'font-size': '15px',
        'font-weight': '400'
    });
});
</script>

<!-- to display the alert message if the record has been deleted -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<div class="card">
    <div class="card-body">
        <div class=" {{  auth()->user()->category== 'Admin' ? 'col-lg-10 col-md-10 col-sm-10' : (request()->routeIs('payrollList') ? 'col-lg-10 col-md-10 col-sm-10' : 'col-lg-12 col-md-12 col-sm-12') }}">
            <div class="overflow-auto" style="overflow:auto;">
                <div class="table-responsive">
                    @if( auth()->user()->category== "Admin")
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($payList as $data)
                            <tr id="row{{$data->id}}">
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td><a class="btn btn-primary" style="float: center; width:50%;" role="button"
                            href="{{ route('payrollAllowance',$data->id) }}">
                            <i class="fas fa-plus"></i>&nbsp; Create Payroll</a></td>
                                    <td>Pending</td>
                            @endforeach
                                
                        </table>
                    @endif
                    <!-- FOR TECHNICIAN TO VIEW RECORD REPAIR FORM LIST END -->
                </div>
            </div>
        </div>
    </div>


</div>

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>

@endsection