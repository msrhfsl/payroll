@extends('layouts.sideNav')

@section('content')
<h4>KPI Allowance</h4>

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

    // filter PAYROLL FORM
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
                            <th colspan="4">P1 (Pay for Position)</th>
                        </tr>
                        <tr>
                            <th colspan="2">Position</th>
                            <th colspan="2">Basic Pay (RM)</th>
                        </tr>
                   </thead>
                    <tbody>
                            <td colspan="2">Technician</td>
                            <td colspan="2">900</td>                        
                    </tbody>
                    <thead>
                        <tr>
                            <th colspan="2">P2 (Pay for Personal Competence)</th>
                            <th colspan="2">P3 (Pay for Performance)</th>
                        </tr>
                   </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">Overtime (Hours)</td>
                            <td colspan="2">Total ticket managed in a month</td>
                        </tr>
                        <tr>
                            <td>36 Hours</td>
                            <td>108.00</td>
                            <td>20 Ticket</td>
                            <td>20.00</td>
                        </tr>
                        <tr>
                        <td colspan="2">Total Allowance (RM)</td>
                        <td colspan="2"><input type="text" number="allowance" class="form-control" placeholder="100.00" style="width: 30%" required ></td>
                        <br>
                        </tr>
                        <tr>
                        <td colspan="4">
                        <center><button type="button" class="btn btn-info" onclick="">Calculate Allowance</button></a></center>
                        </td>
                        </tr>
                    </tbody>

                    
                </table>
                @endif
                <!-- FOR TECHNICIAN TO VIEW RECORD REPAIR FORM LIST END -->
            </div>
        </div>

        <div class="row">
            <div class="col">
                <a class="btn btn-primary" style="float: left; width:50%;" role="button"
                            href="{{ route('payrollGenerate') }}">Cancel</a>    
                </div>
                <div class="col">
                <a class="btn btn-primary" style="float: right; width:50%;" role="button"
                            href="{{ route('payrollGenerate') }}">Proceed Payroll</a>    
            </div>
        </div>
        
    </div>
    </div>

   


</div>

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>

@endsection