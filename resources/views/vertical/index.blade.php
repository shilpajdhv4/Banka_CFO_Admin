@extends('layouts.app')
@section('title', 'User-List')

@section('content')
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<section class="content-header">
    <h1>
       Vertical List
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('add_vertical') }}"> Create New Vertical</a>
        </div>
    </h1>
</section>

@if (Session::has('alert-success'))
<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">Success!</h4>
    {{ Session::get('alert-success') }}
</div>
@endif

<section class="content">
    <div class="box">

 <?php $i = 1; ?>
        <div class="box-body" >
            <table id="example1" class="table table-bordered table-striped" border="1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Vertical Name</th>
                        <th>Short Desc.</th>    
                        <th>Long Desc.</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vartical as $row)
                   <tr>
                        <td>{{$i++}}</td>
                        <td>{{$row->vertical_name}}</td>
                        <td>{{ $row->short_desc}}</td> 
                        <td>{{$row->long_desc}}</td> 
                        <td><img src="vertical_img/{{$row->upload_img}}" style="width: 80px;height: 80px;"></td> 
                        <th width="280px">
                            <a class="btn btn-primary" href="{{url('edit_vertical?id='.$row->id)}}">Edit</a>
                            <a class="btn btn-primary" href="{{url('category?id='.$row->id)}}">Categories</a>
                        </th>
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
        
