@extends('layouts.app')
@section('title', 'Create New User')
@section('content')
<style>
@media only screen and (max-width: 600px) {
    .mobile_date {
        width: 160px;
    }
}
</style>
<section class="content-header">
    <h1>Service Details
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ url('subscription?id='.$_GET['id']) }}"> Back</a>
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
            <div class="box" >
                <div class="box box-info"></div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" id="form" method="post" action="{{ url('save_subscription') }}" autocomplete="on" enctype="multipart/form-data">
                    {{ csrf_field() }}
                  <div class="box-body">
<!--                      <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Type Of Service</label>
                      <div class="col-sm-10">
                          <select class="form-control select2" style="width: 100%;" name="loc_id[]" id="type_of_service" disabled="">
                            <option value="">-- Select Service --</option>
                            <option value="Packaged" selected="">Packaged</option>
                            <option value="Flat">Flat</option>
                            <option value="Quotation">Quotation</option>
                        </select>
                      </div>
                    </div>-->
                    <input type="hidden" name="service_id" value="{{$_GET['id']}}" />
                      <!--Package Start-->
                      <div id="service_package" >
                    <div class="form-group"  >
                        <label for="userName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  placeholder="Name" value="" id="subscription_name" name="subscription_name"  >
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Image</label>
                      <div class="col-sm-10">
                        <input type="file" name="subscription_image" id="exampleInputFile">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label"> Price</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control"  placeholder="Price" value="" id="subscription_price" name="subscription_price"   >
                      </div>
                    </div>
                          <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Add Text To Be Displayed</label>

                      <div class="col-sm-10">
                        <textarea id="editor1"  name="text_to_be_display" rows="10" cols="80">
                                    This is my textarea to be replaced with CKEditor.
                        </textarea>
                      </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">                        
                                <h3 class="box-title" style="text-align: center;">Conditions Package Wise</h3>
                                <table class="table table-striped table-bordered" border="0">
                                    <thead>
                                        <tr>
                                            <th style="width:5px;"><b>Action</b></th>
                                            <th><b>Label Name</b></th>
                                            <th><b>To be displayed</b></th>
                                            <th><b></b></th>
                                        </tr>
                                    </thead>
                                    <tbody id="h_lost">
                                        <tr class="input_fields_wrap">
                                            <td style="width:0.5%;"><i class="fa fa-plus-circle append" style="color: #0c8a54;font-size: x-large;"></i></td>
                                            <td class="parameter"><input type="text" name="parameter_detail[0][]" id="remark" class="form-control parameter checkblank serach_val" rows="1"  aria-="true"></td>
                                            <!--<td class="parameter"><input type="text" name="parameter_detail[0][cat_description]" id="remark" class="form-control parameter checkblank" rows="1" aria-="true"></td>-->
                                            <td class="parameter">
                                                <label class="">
                                                <div class="iradio_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                                                    <input type="radio" name="parameter_detail[0][]" value="yes" class="minimal" style="position: absolute; opacity: 0;">
                                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                </div>
                                                 Yes
                                              </label>
                                              <label class="">
                                                <div class="iradio_minimal-blue " aria-checked="false" aria-disabled="false" style="position: relative;">
                                                    <input type="radio" name="parameter_detail[0][]" value="no" class="minimal" style="position: absolute; opacity: 0;">
                                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                </div>
                                                 No
                                              </label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div> 
                    
                    
                     </div>
                      <!--Package End-->
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Recurring</label>
                      <div class="col-sm-10">
                            <label class="">
                              <div class="iradio_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                                  <input type="radio" name="is_recurring" value="1" class="minimal" style="position: absolute; opacity: 0;">
                                  <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                              </div>
                               Yes
                            </label>
                            <label class="">
                              <div class="iradio_minimal-blue " aria-checked="false" aria-disabled="false" style="position: relative;">
                                  <input type="radio" name="is_recurring" value="0" class="minimal" style="position: absolute; opacity: 0;">
                                  <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                              </div>
                               No
                            </label>
                      </div>
                    </div>
                  
                    <div class="form-group" id="recuring_yes" style="display:none">
                          <label for="userName" class="col-sm-2 control-label">Duration</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control"  placeholder="Duration" value="" id="duration" name="duration"   >
                            </div>
                            <label for="userName" class="col-sm-2 control-label">Reminder Before Days</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control"  placeholder="Days" value="" id="remindar_before_days" name="remindar_before_days"   >
                            </div>
                    </div>
                    </div>
                    <div class="form-group">
                      <label for="userName" class="col-sm-2 control-label">Is Active</label>
                      <div class="col-sm-10">
                        <div class="checkbox">
                          <label>
                              <input type="checkbox" name="is_active" id="is_active" class="minimal" checked=""> 
                          </label>
                        </div>
                      </div>
                    </div>
                  
                    
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                  </div>
                  </form>
                  <!-- /.box-footer -->
                
            </div>
                
              </div>
        

    </div>
</section>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">  
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="js/jquery.steps.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {
    $('select').select2();
    
    $('input').on('ifChecked', function(event){
        var inputValue = $(this).val(); // alert value
        if(inputValue == "yes"){
            $("#recuring_yes").css("display","block");
        }else{
            $("#recuring_yes").css("display","none");
        }
    });
 
    var k = 1;
     $(".append").click( function(e) {
          e.preventDefault();
        $("#h_lost").append('<tr class="input_fields_wrap">\n\
                                <td style="width:0.5%;"><i class="fa fa-minus-circle remove_this" style="font-size: x-large;color: red;"></i></td>\n\
                                <td class="parameter"><input type="text" name="parameter_detail['+k+'][]" id="remark" class="form-control parameter checkblank serach_val" rows="1"  aria-="true"></td>\n\
                                <td class="parameter"><label class=""><div class="iradio_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;">\n\
                                    <input type="radio" name="parameter_detail['+k+'][]" value="yes" class="minimal" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Yes</label>\n\
                                    <label class=""><div class="iradio_minimal-blue " aria-checked="false" aria-disabled="false" style="position: relative;"><input type="radio" name="parameter_detail['+k+'][]" value="no" class="minimal" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>\n\
                                    </div> No</label></td></tr>');
                              $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                                checkboxClass: 'icheckbox_minimal-blue',
                                radioClass   : 'iradio_minimal-blue'
                              })
                    k++;
        return false;
        });
        
        var l = 1;
        $(".append1").click( function(e) {
          e.preventDefault();
        $("#h_lost1").append('<tr class="input_fields_wrap">\n\
                                <td style="width:0.5%;"><i class="fa fa-minus-circle remove_this" style="font-size: x-large;color: red;"></i></td>\n\
                                <td class="parameter"><input type="text" name="parameter_detail['+l+'][cat_name]" id="remark" class="form-control parameter checkblank serach_val" rows="1"  aria-="true"></td>\n\
                                </tr>');
                            
                    l++;
        return false;
        });
        
        $("#type_of_service").on("change",function(){
            var service = $(this).val();
//            alert(service);
            if(service == "Packaged"){
                $("#service_package").css("display","block");
            }else{
                $("#service_package").css("display","none");
            }
                
        })
});

$(function () {
  CKEDITOR.replace('editor1')
//  CKEDITOR.replace('editor2')
  //bootstrap WYSIHTML5 - text editor
  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
  })
})
</script>
@endsection