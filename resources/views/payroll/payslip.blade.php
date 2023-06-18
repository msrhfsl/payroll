@extends('layouts.sideNav')

@section('content')
<h4>REVIEW PAY SLIP</h4>


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
        <div class=" {{  auth()->user()->category== 'Admin' ? 'col-lg-12 col-md-12 col-sm-12' : (request()->routeIs('updatePayroll') ? 'col-lg-12 col-md-12 col-sm-12' : 'col-lg-12 col-md-12 col-sm-12') }}">

            <div class="overflow-auto" style="overflow:auto;">
                <div class="table-responsive">
                    @if( auth()->user()->category== "Staff")
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
                <div class="col">
                    <a class="btn btn-primary" style="float: center; width:50%;" role="button" href="#">Print</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>

@endsection