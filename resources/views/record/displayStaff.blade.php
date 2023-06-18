@extends('layouts.sideNav')

@section('content')
<h4>Staff Details</h4>

<!-- message box if the new waste has been added -->
@if(session()->has('message'))
<div class="alert alert-success">   
    {{ session()->get('message') }}
</div>
@endif

<div class="card">
    <div class="card-body">        
        
        <form method="POST" enctype="multipart/form-data" id="updateStaff" action="{{ route('updateStaff' , $staffDisplay->id) }}">
            @csrf
            
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="col">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $staffDisplay->name }}">
                            </div>
                        </div>
                        <div class="col">
                            <label>Email</label>
                            <input class="form-control" name="email" value="{{ $staffDisplay->email }}">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="col">
                                <label>Phone Number</label>
                                <input type="text" name="phoneNum" class="form-control" value="{{ $staffDisplay->phoneNum }}">
                            </div>
                        </div>
                        <div class="col">
                            <label>Bank</label>
                            <input class="form-control" name="bank" value="{{ $staffDisplay->bank }}">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Home Address</label>
                            <input type="text" name="homeAdd" class="form-control" value="{{ $staffDisplay->homeAdd }}">
                        </div>
                        </div>
                        <div class="col">
                            <label>Account Number</label>
                            <input type="text" name="accNum" class="form-control" value="{{ $staffDisplay->accNum }}">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Gender</label>
                            <input class="form-control" name="gender" value="{{ $staffDisplay->gender }}">                        
                        </div>
                        </div>
                        <div class="col">
                            <label>EPF Number</label>
                            <input type="number" name="epfNo" class="form-control" value="{{ $staffDisplay->epfNo }}"  >
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                        <div class="col">
                            <label>Position</label>
                            <input class="form-control" name="position" value="{{ $staffDisplay->position }}"  >                       
                        </div>
                        </div>
                        <div class="col">
                            <label>SOCSO Number</label>
                            <input type="number" name="socsoNo" class="form-control" value="{{ $staffDisplay->socsoNo }}">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label>Basic Pay</label>
                            <input type="number" name="basicPay" class="form-control" value="{{ $staffDisplay->basicPay }}">
                        </div>
                    </div>
                    <br>
                </div>
                
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>

            <button type="submit" class="btn btn-primary" id="updateStaff"><span class="nav-link-text">Update</span></button>
         
        </form>
        
    </div>

</div>

<script>
    function updateData(e) {

var link = e.getAttribute('data-link')
var idform = e.getAttribute('data-idform')
var successLink = e.getAttribute('data-successLink')
var btnBefore = e.innerHTML
var btnNameChange = e.getAttribute('data-btnNameChange')

var input = $("#" + idform + " :input").serialize();

$.ajax({
    type: 'POST',
    url: link,
    data: input,
    beforeSend: function() {
        e.disabled = true;
        e.innerHTML = "<i class='fas fa-spinner fa-spin text-white'></i> <span class = 'nav-link-text' > " + btnNameChange + " </span>";
        //$('.ajax-loader').css("visibility", "visible");
    },

    success: function(data) {
        if (data.dataError == null) {
            if (successLink != null) {
                loadInPage(successLink);
            }
        } else {
            alert(data.title, data.text, 'warning', successLink)
        }

    },

    complete: function() {

        //dismiss loder
        e.disabled = false;
        e.innerHTML = btnBefore;
        //$('.ajax-loader').css("visibility", "hidden");
    },
    error: function(request, status, error) {
        //console.log(request.responseText);
    }

});
}
</script>
<script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@endsection