@extends('layouts.sideNav')
@section('content')

<!-- Page Header -->
<div class="page-header row no-gutters pb-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0 d-flex">
        <h1 class="page-title ml-3">RECORD ATTENDANCE</h1>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <form action="{{ route('attendRecord') }}" method="POST">
                @csrf
                <label for="reason">Reason:</label>
                <input type="text" name="reason" id="reason" required>

                <label for="check_in">Check-in:</label>
                <input type="datetime-local" name="check_in" id="check_in" required>

                <label for="check_out">Check-out:</label>
                <input type="datetime-local" name="check_out" id="check_out" required>

                <button type="submit" class="btn btn-primary" href="{{ route('attendRecord') }}" style="background-color: #145956; border-radius: 20px; border: none; width: 150px; color: white; font-size: 15px">Record Attendance</button>
            </form>
            
        </div>
    </div>
</div>
@endsection