@extends('layouts.sideNav')

@section('content')
<h4>REVIEW PAYSLIP</h4>


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
        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                @if( auth()->user()->category== "Admin")
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="2">IT MINES EXPERT RESOURCES</th>
                            <th colspan="2" style="text-align: right">PAY SLIP {{ request('selectedMonth') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="row{{$staffInfo->id}}">
                            <td>Name :</td>
                            <td><input type="text" value="{{ $staffInfo->name }}" class="form-control" readonly></td>
                            <td>EPF NO :</td>
                            <td><input type="text" value="{{ $staffInfo->epfNo }}" class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <td>Position :</td>
                            <td><input type="text" value="{{ $staffInfo->position }}" class="form-control" readonly></td>
                            <td>SOCSO NO :</td>
                            <td><input type="text" value="{{ $staffInfo->socsoNo }}" class="form-control" readonly></td>
                        </tr>
                    </tbody>

                    <form method="POST" action="{{ route('insertPayroll', $staffInfo->id ) }}" id="payrollForm">
                        @csrf
                        <thead>
                            <tr>
                                <th colspan="2">Earnings</th>
                                <th colspan="2">Deductions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Basic Pay</td>
                                <td style="text-align: right"><input type="text" value="{{ $staffInfo->basicPay }}" class="form-control" readonly></td>
                                <td>EPF <input type="checkbox" id="epfCheckbox">~9%</td>
                                <td style="text-align: right" id="epfDeduction"><input type="text" name="epfDeduction" class="form-control" readonly></td>
                                <!-- Hidden input field for epfRate -->

                            </tr>
                            <tr>
                                <td>Allowance</td>
                                <td id="totalAllowance" style="text-align: right"><input type="text" name="totalAllowance" value="{{ request('totalAllowance') }}" class="form-control" readonly></td>
                                <td>SOCSO <input type="checkbox" id="socsoCheckbox">~0.5%</td>
                                <td style="text-align: right" id="socsoDeduction"><input type="text" name="socsoDeduction" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <td>Gross Pay</td>
                                <td style="text-align: right" id="grossPay"><input type="text" name="grossPay" class="form-control" readonly></td>
                                <td>Total Deductions</td>
                                <td style="text-align: right" id="totalDeductions"><input type="text" name="totalDeductions" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="2">Net Pay</td>
                                <td colspan="2" style="text-align: right" id="netPay"><input type="text" name="netPay" class="form-control" readonly></td>
                                <br>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <center><button type="button" class="btn btn-info" onclick="calculatePayroll()">Generate Payroll</button></center>
                                    <center><input type="submit" name="SubmitPayroll" class="btn btn-primary btn-bg-color btn-sm col-xs-2 margin-right" id="payrollForm" style="float: right; background:#000066;"></center>
                                </td>
                            </tr>
                        </tbody>
                    </form>
                </table>
                @endif
                <!-- FOR TECHNICIAN TO VIEW RECORD REPAIR FORM LIST END -->
            </div>
        </div>
    </div>
</div>


</div>

</div>

<script>
    function calculatePayroll() {
        var basicPay = parseFloat("{{ $staffInfo->basicPay }}");
        var totalAllowance = parseFloat("{{ request('totalAllowance') }}");

        var epfRate = document.getElementById('epfCheckbox').checked ? 0.09 : 0;
        var socsoRate = document.getElementById('socsoCheckbox').checked ? 0.005 : 0;

        var epfDeduction = basicPay * epfRate;
        var socsoDeduction = basicPay * socsoRate;
        var totalDeductions = epfDeduction + socsoDeduction;
        var grossPay = basicPay + totalAllowance;
        var netPay = grossPay - totalDeductions;

        document.getElementById('epfDeduction').firstElementChild.value = epfDeduction.toFixed(2);
        document.getElementById('socsoDeduction').firstElementChild.value = socsoDeduction.toFixed(2);
        document.getElementById('totalDeductions').firstElementChild.value = totalDeductions.toFixed(2);
        document.getElementById('grossPay').firstElementChild.value = grossPay.toFixed(2);
        document.getElementById('netPay').firstElementChild.value = netPay.toFixed(2);

        // Get the selected month value
        var selectedMonth = "{{ request('selectedMonth') }}";

    }
</script>
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
@endsection