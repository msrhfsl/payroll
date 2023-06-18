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
                            <th colspan="2" style="text-align: right">PAY SLIP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="row{{$display->id}}">
                            <td>Name :</td>
                            <td>{{ $display->name}}</td>
                            <td>EPF NO :</td>
                            <td>{{ $display->epfNo }}</td>
                        </tr>
                        <tr>
                            <td>Position :</td>
                            <td>{{ $display->position}}</td>
                            <td>SOCSO NO :</td>
                            <td>{{ $display->socsoNo}}</td>
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
                            <td>{{ $display->basicPay}}</td>
                            <td>EPF</td>
                            <td>{{ $display->epfRate}}</td>
                        </tr>
                        <tr>
                            <td>Allowance</td>
                            <td>{{ $display->allowancePay}}</td>
                            <td>SOCSO</td>
                            <td>{{ $display->socsoRate}}</td>
                        </tr>
                        <tr>
                            <td>Gross Pay</td>
                            <td>{{ $display->grossPay}}</td>
                            <td>Total Deductions</td>
                            <td>{{ $display->deductions}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Net Pay</td>
                            <td>{{ $display->netPay}}</td>
                        </tr>
                    </tbody>
                </table>
                @endif
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div style="float: left;">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </div>
            <div style="float: right;">
                <button type="button" id="printBtn" class="btn btn-dark">Print</button>
            </div>

        </div>
    </div>

</div>

<script>
    document.getElementById("printBtn").addEventListener("click", function() {
        var cardContent = document.querySelector(".card-body").outerHTML;

        // Open a new window
        var win = window.open("", "_blank");

        // Write the card content to the new window
        win.document.write("<html><head><title>Invoice Payslip</title></head><body>" + cardContent + "</body></html>");

        // Add CSS styles for A4 size
        win.document.write('<style>@page { size: A4; }</style>');
        win.document.write('<style>body { margin: 0; }</style>');

        // Add CSS styles
        var linkTags = document.getElementsByTagName("link");
        for (var i = 0; i < linkTags.length; i++) {
            var linkTag = linkTags[i].cloneNode(true);
            win.document.head.appendChild(linkTag);
        }

        // Add inline styles
        var styleTags = document.getElementsByTagName("style");
        for (var j = 0; j < styleTags.length; j++) {
            var styleTag = styleTags[j].cloneNode(true);
            win.document.head.appendChild(styleTag);
        }

        // Hide buttons in the new window
        win.document.getElementById("cancel").style.display = "none";
        win.document.getElementById("printBtn").style.display = "none";

        // Print the window content
        win.print();
    });
</script>

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>

@endsection