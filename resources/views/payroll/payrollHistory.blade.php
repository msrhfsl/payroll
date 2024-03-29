@extends('layouts.sideNav')

@section('content')
<h4>PAY SLIP HISTORY</h4>


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
        <div class=" {{  auth()->user()->category== 'Staff' ? 'col-lg-12 col-md-12 col-sm-12' : (request()->routeIs('payrollHistory') ? 'col-lg-12 col-md-12 col-sm-12' : 'col-lg-12 col-md-12 col-sm-12') }}">
            <div class="overflow-auto" style="overflow:auto;">
                <div class="table-responsive">
                    @if( auth()->user()->category== "Staff")
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Issued Payroll Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payList as $data)
                            <tr>
                                <td>{{ $data->created_at }}</td>
                                <td><a class="btn btn-primary" style="float: center; width:50%;" role="button" href="{{ route('payslip', $data->id) }}">View Details</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>

@endsection