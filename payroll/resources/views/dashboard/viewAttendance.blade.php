@extends('layouts.sideNav')
@section('content')

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<script src="{{ asset('frontend') }}/js/dataTables.bootstrap4.js"></script>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>


<!-- Page Header -->
<div class="page-header row no-gutters pb-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0 d-flex">
        <h1 class="page-title ml-3">STAFF ATTENDANCE</h1>
    </div>
</div>



<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<div class="container bootstrap snippet">

    <br>
    <!-- FOR Admin TO VIEW List of Staff Before View Attendance -->


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <div class="overflow-auto" style="overflow:auto;">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    <br><br>
                        <div class="table-responsive">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="float: left;">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Staff Name</th>
                                            <th>Date</th>
                                            <th>Check-in</th>
                                            <th>Check-out</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($staffAttendance as $index => $data)
                                        <tr id="row{{$data->id}}">
                                            <td>{{ $data->name}}</td>
                                            <td>{{ $data->date }}</td>
                                            <td>{{ $data->check_in }}</td>
                                            <td>{{ $data->check_out }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                                <!-- FOR Admin TO VIEW RECORD Staff ATTENDANCE LIST END -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
    <script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'>
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    @endsection