@extends('layouts.app')
@section('title', 'User-List')
@section('content')
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<section class="content-header">
    <div class="row">
        <div class="col-md-3">
            <h3>Categories List</h3>
        </div>
<!--        <div class="col-md-3">
            <h4>Vertical Name : Vertical1</h4>
        </div>-->
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Type Of Service</label>
                <div class="col-sm-8">
                  <select class="form-control select2" style="width: 100%;" name="vetical_id" id="vetical_id">
                      <option value="">-- Select Vertical --</option>
                      @foreach($vertical as $vertical)
                      <option value="{{$vertical->id}}" <?php  if(isset($_GET['id'])){ if($_GET['id'] == $vertical->id) echo "selected"; } ?>>{{$vertical->vertical_name}}</option>
                      @endforeach
                  </select>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="pull-right">
            <?php //$id = ""; if(isset($_GET['id']))   $id = "?id=".$_GET['id']; ?>
            <a class="btn btn-success" id="add_cat" >Add Category</a>
            </div>
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
                        <!--<th>Vertical Name</th>-->
                        <th>Category Name</th>
                        <th>Short Desc.</th> 
                        <th>Long Desc.</th> 
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x = 1; ?>
                    @foreach($category as $cat)
                   <tr>
                        <td>{{$x++}}</td>
                        <td>{{$cat->category_name}}</td>
                        <td>{{$cat->short_desc}}</td> 
                        <td>{{$cat->long_desc}}</td> 
                        <td><img src="{{asset('category_img/'.$cat->upload_img)}}" style="width: 80px;height: 80px;"></td> 
                        <th width="280px">
                            <a class="btn btn-primary" href="{{url('edit_category?id='.$cat->id)}}">Edit</a>
                            <a class="btn btn-primary" href="{{url('services?id='.$cat->id)}}">Subscription</a>
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
    $('select').select2();
//    alert();
    $(".delete").on("click", function () {
        return confirm('Are you sure to delete user');
    });
    
    $("#vetical_id").on("change",function(){
        var id = $(this).val();
        location.href = 'category?id='+id;
    })
    
    $("#add_cat").on("click",function(){
        var vertical_id = $("#vetical_id").val();
        location.href = 'add_category?id='+vertical_id;
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
        
