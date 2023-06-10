@extends('layouts.sideNav')

@section('content')
<h4>PAYROLL RECORD</h4>


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
            searchPlaceholder: 'Search By Payroll Period'
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
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                @if( auth()->user()->category== "Admin")
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Period</th>
                            <th>GrossPay</th>
                            <th>Deductions</th>
                            <th>Net Pay</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            <td>January</td>
                            <td>1028.00</td>
                            <td>181.68</td>
                            <td>846.36</td>
                            <td><a class="btn btn-primary" style="float: center; width:50%;" role="button"
                    href="{{ route('payrollAllowance') }}">View Details</a></td>
                    </tbody>
                    <tbody>
                            <td>February</td>
                            <td>1030.00</td>
                            <td>165.68</td>
                            <td>870.36</td>
                            <td><a class="btn btn-primary" style="float: center; width:50%;" role="button"
                    href="{{ route('payrollAllowance') }}">View Details</a></td>                    
                    </tbody>
                    <tbody>
                            <td>March</td>
                            <td>1000.00</td>
                            <td>105.68</td>
                            <td>885.36</td>
                            <td><a class="btn btn-primary" style="float: center; width:50%;" role="button"
                    href="{{ route('payrollAllowance') }}">View Details</a></td>
                    </tbody>
                    
                </table>
                @endif
                <!-- FOR TECHNICIAN TO VIEW RECORD REPAIR FORM LIST END -->
            </div>
        </div>
    </div>


</div>

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>

@endsection