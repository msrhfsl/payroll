@extends('layouts.sideNav')

@section('content')
<h4>REVIEW PAY SLIP</h4>


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
                            <th colspan="2">IT MINES EXPERT RESOURCES</th>
                            <th colspan="2" style="text-align: right">PAY SLIP JANUARY 2023</th>
                        </tr>
                   </thead>
                    <tbody>
                        <tr>
                            <td>Name :</td>
                            <td>Afiqah Jamil</td>
                            <td>EPF NO :</td>
                            <td>000507020116</td> 
                        </tr>
                        <tr>
                            <td>Position :</td>
                            <td>Technician</td>
                            <td>SOCSO NO :</td>
                            <td>000810028765</td> 
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
                            <td style="text-align: right">900.00</td>
                            <td>EPF</td>
                            <td style="text-align: right">139.00</td>
                        </tr>
                        <tr>
                            <td>Allowance</td>
                            <td style="text-align: right">128.00</td>
                            <td>SOCSO</td>
                            <td style="text-align: right">15.59</td>
                        </tr>
                        <tr>
                            <td>Gross Pay</td>
                            <td style="text-align: right">1028.00</td>
                            <td>Total Deductions</td>
                            <td style="text-align: right">181.59</td>
                        </tr>
                        <tr>
                        <td></td>
                        <td></td>    
                        <td>Net Pay</td>
                        <td style="text-align: right">846.36</td>
                        </tr>
                    </tbody>
                </table>
                @endif
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col">
                <a class="btn btn-primary" style="float: left; width:50%;" role="button"
                            href="{{ route('payrollGenerate') }}">Print</a>    
            </div>
            <div class="col">
                <a class="btn btn-primary" style="float: right; width:50%;" role="button"
                            href="{{ route('payrollGenerate') }}">Submit</a>    
            </div>
        </div>
    </div>

</div>

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>

@endsection