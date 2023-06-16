@extends('layouts.sideNav')

@section('content')

<h4>Staff Registration</h4>
<h6>Add New Staff</h6>

<!-- message box if the new waste has been added -->
@if(session()->has('message'))
<div class="alert alert-success">   
    {{ session()->get('message') }}
</div>
@endif

<div class="card">
    <div class="card-body">
        <!-- form add waste -->
        <form method="POST" action="{{ route('insertNewStaff') }}" enctype="multipart/form-data" id="staff">
            @csrf
            <div class="row">
                <div class="col">

                    <div class="row">
                        <div class="col">
                            <div class="col">
                                <label>FULLNAME</label>
                                <input type="text" name="name" class="form-control" placeholder="name"required>
                            </div>
                        </div>
                        
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <div class="col">
                                <label>EMAIL ADDRESS</label>
                                <input type="text" name="email" class="form-control" placeholder="email" required>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="col">
                                <label>PASSWORD</label>
                                <input type="password" name="password" class="form-control" placeholder="password" required>
                            </div>
                        </div>
                        
                    </div>

                    <br>
                </div>

            </div>
            <input type="submit" name="submit" class="btn btn-primary" id="regForm" style="float: right;">

        </form>
    </div>

</div>
<script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'>
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@endsection