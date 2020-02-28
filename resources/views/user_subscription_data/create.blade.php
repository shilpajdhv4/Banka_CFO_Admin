@extends('layouts.app')
@section('title', 'Client Form')
@section('content')
<style>
@media only screen and (max-width: 600px) {
    .mobile_date {
        width: 160px;
    }
}
</style>

<section class="content-header">
    <h1>Client Form
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
    </div></h1>
</section>
@if (Session::has('alert-success'))
<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">Success!</h4>
    {{ Session::get('alert-success') }}
</div>
@endif


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box" style="border-top: 3px solid #ffffff;">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>

<form method="POST" action="http://localhost/banka_cfo/public/users/1" accept-charset="UTF-8" class="form-horizontal">
<div class="box-body">
<?php 
          foreach($form_data as $data)
          {
              $type=$data->field_type;
              $value_data=json_decode($data->field_input,true);
             // print_r();
              switch ($type) {
                  ?><?php
                case "text":
                ?>
            <div class="form-group">
            <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
            <div class="col-sm-4">
            <input placeholder="Name" class="form-control" name="name" type="text" value="{{$value_data[$data->field_title]}}">
        </div>
                <?php
                 break;
                case "singlefile":
                    ?>
              <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
            <div class="col-sm-4">
            <!--<input class="form-control" name="name" type="file">-->
               @if(!empty($value_data[$data->field_title]))
               <a href="http://localhost/Bankacfo_final/public/help/{{$value_data[$data->field_title]}}" target="_blank" class="label label-success"><i class="fa fa-fw fa-eye"></i>{{$value_data[$data->field_title]}}</a>
               @endif
            </div>
              </div>
                    <?php
                    break;
                case "logtext":
                  ?>
            <div class="form-group">
              <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
            <div class="col-sm-4">
          <textarea class="form-control" rows="3" placeholder="Enter Address..." name="sup_address" id="sup_address" style="resize: vertical; max-width: 400px; min-width: 200px;" spellcheck="false">{{$value_data[$data->field_title]}}</textarea> 
        </div> 

                                <?php
                    break;
                  case "multiplefile":
                  ?>
              <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
            <div class="col-sm-4">
                <?php 
                $file_data=explode(",",$value_data[$data->field_title]);
                foreach($file_data as $f)
                {
                    if($f!=""){
                    ?>
                <a href="http://localhost/Bankacfo_final/public/help/{{$f}}" target="_blank" class="label label-success"><i class="fa fa-fw fa-eye"></i>{{$f}}</a>
                <br/>
                <br/>
                <?php
                    } }
                ?>
          <!--<input class="form-control" name="name" type="file[]">-->
        </div>
            </div>
                    <?php
                    break;
}
          }
          ?>
    
</div>
</form>
            </div>
        </div>
    </div>
@if(count($office_data)>0)
<!--<section class="content-header">-->
    <h3>Office Form
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
    </div></h3>
<!--</section>-->
    <div class="row">
        <div class="col-md-12">
            <div class="box" style="border-top: 3px solid #ffffff;">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>

                <form method="POST" action="{{ url('update_office_data') }}" accept-charset="UTF-8" class="form-horizontal" enctype="Multipart/form-data">
      {{ csrf_field() }}
<div class="box-body">
<?php 
          foreach($office_data as $data)
          {
              $type=$data->field_type;
              $value_data=json_decode($data->field_input,true);
             // print_r();
              switch ($type) {
                  ?><?php
                case "text":
                ?>
            <!--<div class="form-group">-->
            <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
            <div class="col-sm-4">
            <input placeholder="Name" class="form-control" name="{{$data->id}}" type="text" value="{{$value_data[$data->field_title]}}">
        </div>
                <?php
                 break;
                case "singlefile":
                    ?>
              <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
            <div class="col-sm-4">
            <input class="form-control" name="{{$data->id}}" type="file">
                <!--<a href="http://localhost/Bankacfo_final/public/help/{{$value_data[$data->field_title]}}" target="_blank">{{$value_data[$data->field_title]}}</a>-->
        </div>
              <!--</div>-->
                    <?php
                    break;
                case "logtext":
                  ?>
            <!--<div class="form-group">-->
              <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
            <div class="col-sm-4">
          <textarea class="form-control" rows="3" placeholder="Enter Address..." name="{{$data->id}}" id="sup_address" style="resize: vertical; max-width: 400px; min-width: 200px;" spellcheck="false">{{$value_data[$data->field_title]}}</textarea> 
        </div> 

                                <?php
                    break;
                  case "multiplefile":
                  ?>
              <label for="userName" class="col-sm-2 control-label">{{$data->field_title}}</label>
            <div class="col-sm-4">
          <input class="form-control" name="{{$data->id}}[]" type="file[]">
        </div>
            <!--</div>-->
                    <?php
                    break;
}
          }
          ?>
    
</div>
<div class="box-footer">
    <button type="submit"  id="btnsubmit" class="btn btn-success">Submit</button>
    <a href="{{route('users.index')}}" class="btn btn-danger" >Cancel</a>
</div>
</form>
            </div>
        </div>
    </div>
@endif
</section>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->
<script src="../js/jquery.min.js"></script>
<script type='text/javascript' src='../js/jquery.validate.js'></script>
<script>
    $(document).ready(function () {
        $('.select2').select2();
        
        $("#mobile_no").focusout(function () {
            var mobile = $(this).val();
//            alert(mobile);
            $.ajax({
                url: 'mobile-validate/' + mobile,
                type: "GET",
                success: function (data) {
                    console.log(data);
                    $("#email_validate").html(data);
                    if (data != "") {
                        $("#mobile_no").val("");
                    }
                }
            });
        });
   });
    
    var jvalidate = $("#orderForm").validate({
        rules: {
            name: {required: true},
            email: {required: true},
            password: {required: true},
            dept_id: {required: true},
            role: {required: true},
        }
    });
    
    $('#btnsubmit').on('click', function () {
        $("#orderForm").valid();
    });
 
    
</script>
@endsection
