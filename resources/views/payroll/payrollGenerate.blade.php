@extends('layouts.sideNav')

@section('content')
<h4>REVIEW PAYSLIP</h4>


<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<script src="{{ asset('frontend') }}/js/dataTables.bootstrap4.js"></script>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script>
    // to search 
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
                            <th colspan="2">IT MINES EXPERT RESOURCES</th>
                            <th colspan="2" style="text-align: right">PAY SLIP JANUARY 2023</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="row{{$staffInfo->id}}">
                            <td>Name :</td>
                            <td>{{ $staffInfo->name}}</td>
                            <td>EPF NO :</td>
                            <td>{{ $staffInfo->epfNo }}</td>
                        </tr>
                        <tr>
                            <td>Position :</td>
                            <td>{{ $staffInfo->position}}</td>
                            <td>SOCSO NO :</td>
                            <td>{{ $staffInfo->socsoNo}}</td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th colspan="2">Earnings</th>
                            <th colspan="2">Deductions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Basic Pay</td>
                            <td style="text-align: right">{{ $staffInfo->basicPay }}</td>
                            <td>EPF <input type="checkbox" id="epfCheckbox">~9%</td>
                            <td style="text-align: right" id="epfDeduction"></td>
                        </tr>
                        <tr>
                            <td>Allowance</td>
                            <td id="totalAllowance" style="text-align: right">{{ request('totalAllowance') }}</td>
                            <td>SOCSO <input type="checkbox" id="socsoCheckbox">~0.5%</td>
                            <td style="text-align: right" id="socsoDeduction"></td>
                        </tr>
                        <tr>
                            <td>Gross Pay</td>
                            <td style="text-align: right" id="grossPay"></td>
                            <td>Total Deductions</td>
                            <td style="text-align: right" id="totalDeductions"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Net Pay</td>
                            <td colspan="2" style="text-align: right" id="netPay"></td>
                            <br>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <center><button type="button" class="btn btn-info" onclick="calculatePayroll()">Generate Payroll</button></center>
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
                <center><a class="btn btn-primary" style="width:10%;" role="button" href="{{ route('payrollReview', $staffInfo->id) }}">Save</a> </center>
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

        document.getElementById('epfDeduction').innerText = epfDeduction.toFixed(2);
        document.getElementById('socsoDeduction').innerText = socsoDeduction.toFixed(2);
        document.getElementById('totalDeductions').innerText = totalDeductions.toFixed(2);
        document.getElementById('grossPay').innerText = grossPay.toFixed(2);
        document.getElementById('netPay').innerText = netPay.toFixed(2);
    }
</script>

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>

@endsection