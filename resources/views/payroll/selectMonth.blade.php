@extends('layouts.sideNav')

@section('content')
<h4>Select Month for Payroll Calculation</h4>

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
        <form method="POST" action="{{ route('payrollAllowance', ['id' => request()->route('id')]) }}">
            @csrf
            <div class="{{ auth()->user()->category == 'Admin' ? 'col-lg-12 col-md-12 col-sm-12' : (request()->routeIs('payrollList') ? 'col-lg-12 col-md-12 col-sm-12' : 'col-lg-12 col-md-12 col-sm-12') }}">
                <!-- Select month -->
                <div class="row">
                    <div class="col-md-12">
                        <label for="selected_month">Select Month:</label>
                        <input type="month" id="selected_month" name="selected_month" class="form-control" required>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary" style="float: right; width:50%;">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>

@endsection
