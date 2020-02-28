@extends('layouts.app')
@section('title', 'User-List')

@section('content')
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<section class="content-header">
    <h1>
        Service List
        <div class="pull-right">
             <a class="btn btn-success" href="{{ url('add_subscription?id='.$id) }}"> Create New Service</a>
        </div>
    </h1>
</section>
<section class="content-header">
    <div class="row">
        <div class="col-md-3">
            <h4>Vertical Name : {{$detail->vertical_name}}</h4>
        </div>
        <div class="col-md-3">
            <h4>Category Name : {{$detail->category_name}}</h4>
        </div>
        <div class="col-md-6">
            <h4>Subscription  Name : {{$detail->service_name}}</h4>
        </div>
    </div>
   
</section>

@if (Session::has('alert-success'))
<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">Success!</h4>
    {{ Session::get('alert-success') }}
</div>
@endif

<section class="content">
    <div class="box">

 <?php $i = 0; ?>
        <div class="box-body" >
            <table id="example1" class="table table-bordered table-striped" border="1">
                <thead>
                    <tr>
                        <th>#</th>
                        <!--<th>Service Name</th>-->
                        <th>Name</th>    
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x = 1; ?>
                    @foreach($subscript_list as $det)
                   <tr>
                        <td>{{$x++}}</td>
                        <!--<td>Service1</td>-->
                        <td>{{$det->subscription_name}}</td>  
                        <td>{{$det->subscription_price}}</td>
                        <td><img src="subscription_img/{{$det->subscription_image}}" style="width: 80px;height: 80px;"></td> 
                        <td width="280px">
                            <a class="btn btn-primary" href="{{url('edit_subscription?id='.$det->id)}}">Edit</a>
                            <a class="btn btn-primary" href="{{url('client_form?id='.$det->id)}}">Client Form</a>
                            <a class="btn btn-primary" href="{{url('office_form?id='.$det->id)}}">Office Form</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>   
</section>
<!-- END PAGE CONTENT WRAPPER -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function () {
//    alert();
    $(".delete").on("click", function () {
        return confirm('Are you sure to delete user');
    });
});
$(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': false
    })
})
</script>
@endsection
        
