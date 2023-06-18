@extends('layouts.sideNav')

@section('content')
<h4>KPI Allowance</h4>

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<script src="{{ asset('frontend') }}/js/dataTables.bootstrap4.js"></script>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>



<!-- to display the alert message if the record has been deleted -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<div class="card">
    <div class="card-body">

        <!-- Count month from the database -->

        <div class="row">
            <div class="col-md-6">
                <label for="selected_month">Select Month:</label>
                <input type="month" id="selected_month" name="selected_month" class="form-control" required>

                <label for="attendance_count">Attendance Count:</label>
                <input type="text" id="attendance_count" name="attendance_count" class="form-control" value="{{ $attendanceCount }}" readonly>
            </div>
        </div>

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
                            <td>{{$staffDisplay->name}}</td>
                            <td colspan="2">{{$staffDisplay->position}}</td>
                            <td colspan="2">{{$staffDisplay->basicPay}}</td>
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
                                <td><input type="number" id="overtimeHours" class="form-control" placeholder="hours" style="width: 100%" required></td>
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
                    <a class="btn btn-primary" style="float: left; width:50%;" role="button" href="{{ url()->previous() }}">Cancel</a>
                </div>
                <div class="col">
                    <a id="payrollGenerateLink" class="btn btn-primary" style="float: right; width:50%;" role="button">Proceed Payroll</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Assuming you have retrieved $staffDisplay['basicPay'] from the database
$overtimeRate = $staffDisplay->basicPay / $attendanceCount;
?>

<script>
    function calculateAllowance() {
        var overtimeHours = parseInt(document.getElementById('overtimeHours').value);
        var ticketCount = parseInt(document.getElementById('ticket').value);

        var overtimeRate = <?php echo $overtimeRate; ?>;
        var hourlyRate = overtimeRate / 8;
        var overtimeAllowance = hourlyRate * overtimeHours * 1.5;
        var ticketAllowance = ticketCount * 0.5;
        var totalAllowance = overtimeAllowance + ticketAllowance;

        document.getElementById('overtimeCalculation').innerText = overtimeAllowance.toFixed(2);
        document.getElementById('ticketCalculation').innerText = ticketAllowance.toFixed(2);
        document.getElementById('totalAllowance').innerText = totalAllowance.toFixed(2);

        // Get the selected month value
        var selectedMonth = document.getElementById('selected_month').value;

        // Update the href attribute of the "Proceed Payroll" button
        var payrollGenerateLink = document.getElementById('payrollGenerateLink');
        payrollGenerateLink.href = "{{ route('payrollGenerate', $staffDisplay->currID) }}" + "?totalAllowance=" + totalAllowance.toFixed(2) + "&selectedMonth=" + selectedMonth;

    }
</script>
                        <script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>

@endsection