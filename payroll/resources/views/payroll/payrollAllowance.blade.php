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
        <div class=" {{  auth()->user()->category== 'Admin' ? 'col-lg-12 col-md-12 col-sm-12' : (request()->routeIs('payrollAllowance') ? 'col-lg-12 col-md-12 col-sm-12' : 'col-lg-12 col-md-12 col-sm-12') }}">
            <div class="overflow-auto" style="overflow:auto;">
                <div class="table-responsive">
                    @if( auth()->user()->category== "Admin")
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th colspan="4">P1 (Pay for Position)</th>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <th colspan="2">Position</th>
                                <th colspan="2">Basic Pay (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>{{$staffInfo->name}}</td>
                            <td colspan="2">{{$staffInfo->position}}</td>
                            <td colspan="2">{{$staffInfo->basicPay}}</td>
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
                                <td><input type="text" id="overtimeHours" class="form-control" placeholder="hours" style="width: 100%" required></td>
                                <td id="overtimeCalculation"></td>
                                <td><input type="text" id="ticket" class="form-control" placeholder="ticket" style="width: 100%" required></td>
                                <td id="ticketCalculation"></td>
                            </tr>
                            <tr>
                                <td colspan="2">Total Allowance (RM)</td>
                                <td colspan="2" id="totalAllowance" colspan="2"></td>

                                <br>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <center><button type="button" class="btn btn-info" onclick="calculateAllowance()">Calculate Allowance</button></a></center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <a class="btn btn-primary" style="float: left; width:50%;" role="button" href="{{ route('payrollGenerate') }}">Cancel</a>
                </div>
                <div class="col">
                    <a class="btn btn-primary" style="float: right; width:50%;" role="button" href="{{ route('payrollGenerate') }}">Proceed Payroll</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function calculateAllowance() {
        var overtimeHours = parseInt(document.getElementById('overtimeHours').value);
        var ticketCount = parseInt(document.getElementById('ticket').value);

        var overtimeRate = {{ $staffInfo->basicPay / 26 }};
        var hourlyRate = overtimeRate / 8;
        var overtimeAllowance = hourlyRate * overtimeHours * 1.5;
        var ticketAllowance = ticketCount * 0.5;

        var totalAllowance = overtimeAllowance + ticketAllowance;

        document.getElementById('overtimeCalculation').innerText = overtimeAllowance.toFixed(2);
        document.getElementById('ticketCalculation').innerText = ticketAllowance.toFixed(2);
        document.getElementById('totalAllowance').innerText = totalAllowance.toFixed(2);
    }
</script>

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>

@endsection