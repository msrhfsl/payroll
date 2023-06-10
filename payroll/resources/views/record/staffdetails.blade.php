@extends('layouts.sideNav')

@section('content')
<h4>Staff Registration</h4>
<h6>Update Staff Details</h6>

<!-- message box if the new waste has been added -->
@if(session()->has('message'))
<div class="alert alert-success">   
    {{ session()->get('message') }}
</div>
@endif

<div class="card">
    <div class="card-body">
        <!-- form add waste -->
        <form method="POST" action="{{ route('insertStaff', $staffID->id) }}" enctype="multipart/form-data" id="staff">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="col">
                                <label>Phone Number</label>
                                <input type="text" name="phoneNum" class="form-control" placeholder="01123456898" required>
                            </div>
                        </div>
                        <div class="col">
                            <label>Bank</label>
                            <select class="form-control" name="bank">
                                <option value="Maybank Berhad">MAYBANK</option>
                                <option value="Bank Islam Malaysia Berhad">BANK ISLAM MALAYSIA BERHAD</option>
                                <option value="RHB Bank">RHB BANK</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Home Address</label>
                            <input type="text" name="homeAdd" class="form-control" placeholder="Jalan Melor" required>
                        </div>
                        </div>
                        <div class="col">
                            <label>Account Number</label>
                            <input type="text" name="accNum" class="form-control" placeholder="Account Number" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Gender</label>
                            <select class="form-control" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>                        </div>
                        </div>
                        <div class="col">
                            <label>EPF Number</label>
                            <input type="number" name="epfNo" class="form-control" placeholder="EPF account number" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Position</label>
                            <select class="form-control" name="position">
                                <option value="Sales">Sales</option>
                                <option value="Technician">Technician</option>
                            </select>                        </div>
                        </div>
                        <div class="col">
                            <label>SOCSO Number</label>
                            <input type="number" name="socsoNo" class="form-control" placeholder="SOCSO account number" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label>Basic Pay</label>
                            <input type="number" name="basicPay" class="form-control" placeholder="Basic Pay" required>
                        </div>
                    </div>
                    <br>
                </div>
                
            </div>
            <input type="submit" name="Submit" class="btn btn-primary" id="regform" style="float: right;">
            
        </form>
    </div>

</div>
<script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@endsection