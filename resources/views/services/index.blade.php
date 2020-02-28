@extends('layouts.app')
@section('title', 'User-List')

@section('content')
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<section class="content-header">
    <div class="row">
        <div class="col-md-3">
            <h3>Subscription List</h3>
        </div>
        <div class="col-md-3">
            <h4>Vertical Name : 
                <?php if(isset($_GET['id'])){ 
                        $vertical = DB::table('tbl_category')
                                  ->select('tbl_vertical.vertical_name')
                                  ->leftjoin('tbl_vertical','tbl_vertical.id','tbl_category.vertical_id')
                                  ->where(['tbl_category.id'=>$_GET['id']])
                                  ->first(); echo $vertical->vertical_name; } ?> </h4>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Categories</label>
                <div class="col-sm-8">
                  <select class="form-control select2" style="width: 100%;" name="cat_id" id="cat_id">
                      <option value="">-- Select Category --</option>
                      @foreach($category as $cat)
                      <option value="{{$cat->id}}" <?php  if(isset($_GET['id'])){ if($_GET['id'] == $cat->id) echo "selected"; } ?>>{{$cat->category_name}}</option>
                      @endforeach
                  </select>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="pull-right">
            <?php $id = ""; if(isset($_GET['id']))   $id = "?id=".$_GET['id']; ?>
            <a class="btn btn-success" href="{{ url('add_service') }}"> Create New Subscription</a>
            </div>
        </div>
    </div>
<!--    <h1>
       Service List
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('add_vertical') }}"> Create New Service</a>
        </div>
    </h1>-->
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
                        <!--<th>Vertical Name</th>-->
                        <!--<th>Category Name</th>-->
                        <th>Subscription Name</th>
                        <th>Short Desc.</th>    
                        <th>Long Desc.</th>
                        <th>Type Of Subscription</th>
                        <th>Image</th>
                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x =1; ?>
                    @foreach($service as $serv)
                   <tr>
                        <td>{{$x++}}</td>
                        <td>{{$serv->service_name}}</td>
                        <td>{{$serv->short_desc}}</td> 
                        <td>{{$serv->long_desc}}</td> 
                        <td>{{$serv->type_of_service}}</td>
                        <td><img src="{{asset('service_img/'.$serv->upload_img)}}" style="width: 80px;height: 80px;"></td> 
                        <td width="280px">
                            <a class="btn btn-primary" href="{{url('edit_service?id='.$serv->id)}}">Edit</a>
                            <a class="btn btn-primary" href="{{url('subscription?id='.$serv->id)}}">Services</a>
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
    $('select').select2();
//    alert();
    $(".delete").on("click", function () {
        return confirm('Are you sure to delete user');
    });
    
    $("#cat_id").on("change",function(){
        var id = $(this).val();
        location.href = 'services?id='+id;
    })
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
        
