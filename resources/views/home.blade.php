@extends('layouts.app')

@section('content')


<form action="{{route('user')}}" method="GET" id="#search-form">
<div class="col-md-offset-4 col-md-6">
   Name: <input type="text" name= "name" id="name" class="form-control"><br><br>
Email:<input type="text" name="email" id="email" class="form-control"><br>
<input type="submit" value="Submit" class="btn btn-primary" >
</div>
</form>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">Dashboard</div>
                <table class="table myTable" id="myTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            {{--  <th>Intro</th>  --}}
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js">
</script> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
<script type="textscript">
    $(function() {
 
    var oTable = $('.mytable').DataTable({debugger;
        
        processing: true,
        serverSide: true,
        ajax: {
            url: '{!!route('user1')!!}',
            data: function (d) {
                d.name = $('#name').val();
                d.email = $('#email').val();
                
            }
        },
        alert();
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'}
        ]
    });
   
    $('#search-form').on('submit', function(e) {
        oTable.draw();
        
    });
});
</script>

@endpush
