@extends('layouts.sideNav')

@section('content')
<h4>PAY SLIP HISTORY</h4>


<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<script src="{{ asset('frontend') }}/js/dataTables.bootstrap4.js"></script>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script>
// to search 
$(document).ready(function() {
    $('#dataTable').DataTable({
        "order": [
            [0, "asc"]
        ],
        "language": {
            search: '<i class="fa fa-search" aria-hidden="true"></i>',
            searchPlaceholder: 'Search By Month'
        }
    });

    // filter REPAIR FORM
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
                @if( auth()->user()->category== "Staff")
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Period</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            <td>15/01/2023</td>
                            <td>JANUARY 2023</td>
                            <td><a class="btn btn-primary" style="float: center; width:50%;" role="button"
                    href="{{ route('payslip') }}">
                    <i class="fas fa-plus"></i>&nbsp; View Details</a></td>
                        
                    </tbody>
                    <tbody>
                            <td>15/02/2023</td>
                            <td>FEBRUARY 2023</td>
                            <td><a class="btn btn-primary" style="float: center; width:50%;" role="button"
                    href="{{ route('payslip') }}">
                    <i class="fas fa-plus"></i>&nbsp; View Details</a></td>
                        
                    </tbody>
                    <tbody>
                            <td>15/03/2023</td>
                            <td>MARCH 2023</td>
                            <td><a class="btn btn-primary" style="float: center; width:50%;" role="button"
                    href="{{ route('payslip') }}">
                    <i class="fas fa-plus"></i>&nbsp; View Details</a></td>
                        
                    </tbody>
                    
                </table>
                @endif
            </div>
        </div>
    </div>


</div>

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>

@endsection