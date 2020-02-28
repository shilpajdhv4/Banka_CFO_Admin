@extends('layouts.app')
@section('title', 'Edit Enquiry Template')
@section('content')
<style>
@media only screen and (max-width: 600px) {
    .mobile_date {
        width: 160px;
    }
}
</style>

<section class="content-header">
    <h1>
        <div class="col-md-4">
        Client Form Field  
        </div>
        <div class="col-md-6">
            <h4>Subscription Name : {{$subscription->subscription_name}}</h4>
        </div>
        <div class="col-md-1">
            <a class="btn btn-danger" href="{{ url('subscription?id='.$_GET['id']) }}"> Back</a>
        </div>
        <div class="col-md-1">
            <a class="btn btn-primary" href="{{ url('services') }}"> Edit</a>
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
    <div class="row">
        <div class="col-md-12">
            <div class="box" style="border-top: 3px solid #ffffff;">
                <div class="box-header">
                    <h3 class="box-title"><b>Existing Fields</b></h3>
                </div>
                <div>
                    <table class="table table-striped table-bordered" id="tbl_client" border="0">
                        <tr>
                            <th>#</th>
                            <th>Label Name</th>
                            <th>Data Type</th>
                            <th>Requeired</th>
                            <th>Recurring</th>
                            <th>Frequency</th>
                            <th>Reminder Day</th>
                        </tr>
                        <?php $x=1; ?>
                        @foreach($client_form as $client)
                        <tr>
                            <td>{{$x++}}</td>
                            <td>{{$client->field_title}}</td>
                            <td>{{$client->field_type}}</td>
                            <td><?php echo ($client->is_mandatory) == "1" ? "Yes" : "No"; ?></td>
                            <td><?php echo ($client->is_recurring) == "1" ? "Yes" : "No"; ?></td>
                            <td>{{$client->recurring_frequency}}</td>
                            <td>{{$client->recurring_reminder_day}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-header">
                    <h3 class="box-title"><b>Add New Fields</b></h3>
                </div>
                <form class="form-horizontal" id="userForm" method="post" action="{{ url('save_client_field') }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <input type="hidden" name="subscription_id" value="{{$_GET['id']}}" />
                            <table class="table table-striped table-bordered" id="tbl_client" border="0">
                                        <thead>
                                            <tr>
                                                <th style="width:5px;"><b>Action</b></th>
                                                <th><b>Label Name</b></th>
                                                <th><b>Data Type</b></th>  
                                                <th><b>Required</b></th>
                                                <th><b>Recurring</b></th>
                                                <th><b>Frequency</b></th>
                                                <th><b>Reminder Date</b></th>
                                            </tr>
                                        </thead>
                                        <tbody id="h_lost1">
                                            <tr class="input_fields_wrap">
                                                <td style="width:0.5%;"><i class="fa fa-plus-circle add_field_button" style="color: #0c8a54;font-size: x-large;"></i></td>
                                                <td>
                                                    <input type="text" class="form-control" placeholder="Label Name" value="" name="parameter_field[1][]" id="parameter_textbox[1][]"   >
                                                </td>
                                                <td>
                                                    <select class="form-control select2 prod_drop" style="width: 100%;" name="parameter_field[1][]" id="parameter_field[1]">
                                                        <option value="text">Text</option>
                                                        <option value="number">Number</option>
                                                        <option value="logtext">LongText</option>
                                                        <option value="dropdown">Dropdown</option>
                                                        <option value="singlefile">Single File</option>
                                                        <option value="multiplefile">Multiple File</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <label>
                                                        <input type="checkbox" class="minimal" name="parameter_field[1][]" >
                                                    </label>
                                                </td>
                                                <td>
                                                    <input type="radio" name="parameter_field[1][]" value="yes" /> Yes
                                                    <input type="radio" name="parameter_field[1][]" value="no" /> No
                                                </td>
<!--                                                <td>
                                                        <label class="">
                                                          <div class="iradio_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                                                              <input type="radio" name="r1" value="yes" class="minimal" style="position: absolute; opacity: 0;">
                                                              <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                          </div>
                                                           Yes
                                                        </label>
                                                        <label class="">
                                                          <div class="iradio_minimal-blue " aria-checked="false" aria-disabled="false" style="position: relative;">
                                                              <input type="radio" name="r1" value="no" class="minimal" style="position: absolute; opacity: 0;">
                                                              <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                          </div>
                                                           No
                                                        </label>
                                                </td>-->
                                                <td>
                                                    <select class="form-control select2" style="width: 100%;" name="parameter_field[1][]" id="parameter_textbox[1]">
                                                        <option value="Monthly">Monthly</option>
                                                        <option value="Quarterly">Quarterly</option>
                                                        <option value="Yearly">Yearly</option>
                                                    </select>
                                                    <!--<input type="text" class="form-control recuring_yes" placeholder="Frequency" value="" name="parameter_field[1][]" id="parameter_textbox[1][]"   >-->
                                                </td>
                                                <td >
                                                    <div class="input-group date recuring_yes" >
                                                           <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                          </div>
                                                        <input type="text" name="upload_date" id="upload_date" class="form-control datepicker" placeholder="YYYY-MM-DD" required  >
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table> 
                    </div>
                    <div class="box-footer">
                        <button type="button"  id="btnsubmit" class="btn btn-success">Update</button>
                        <a href="{{url('subscription')}}" class="btn btn-danger" >Cancel</a>
                    </div>
                </form>
            </div>
        </div>   
    </div>
</section>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="js/jquery.steps.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<script type='text/javascript' src='js/jquery.validate.js'></script>
<script type="text/javascript">
$(document).ready(function () {
    $('.select2').select2();
    var k = 1;
    
    $("#btnsubmit").on("click",function(){
        swal({
                    title: "Please Conform",
                    text: "You want to update ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#e74c3c",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: false,
                }, function(isConfirm){
                    if (isConfirm) {
                        $("#userForm").submit();
                    }
                    else {
//                        $("#Modal2").modal({backdrop: 'static', keyboard: false});
                        swal("Cancelled", "", "error");
                    }
                });
    })
    
    $('#tbl_client tr input').on('ifChecked', function(event){
        var inputValue = $(this).val(); // alert value
        if(inputValue == "yes"){
            $(".recuring_yes").css("display","block");
        }else{
            $(".recuring_yes").css("display","none");
        }
    });
    
     $(".append").click( function(e) {
          e.preventDefault();
        $("#h_lost").append('<tr class="input_fields_wrap">\n\
                                <td style="width:0.5%;"><i class="fa fa-minus-circle remove_this" style="font-size: x-large;color: red;"></i></td>\n\
                                <td class="parameter"><select class="form-control select2" style="width: 100%;" name="parameter_textbox[]" id="product_id"><option value="">-- Select Category--</option></select></td>\n\
                                </tr>');
                    k++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
        jQuery(this).parent().parent().remove();
        return false;
        });   
        
        
        //Product/Text Filed Or Drop Down
        var i = $(".add_field_button").length;
        var l=$(".input_fields_wrap").length;//1;
       $(document).on('click','.add_field_button',function(){
//           alert();
        var v = $(this).parents("td").prevAll(".parameter").eq(1).val();
        i++; 
        l++;
       // alert(i);
        $("#h_lost1").append('<tr class="input_fields_wrap delparam_'+l+'">\n\
            <td style="width:2%;"><i class="fa fa-plus-circle add_field_button" style="color: #0c8a54;font-size: x-large;"></i> <i class="fa fa-minus-circle remove_field" style="color: red;font-size: x-large;"></i></td><td><input type="text" class="form-control" placeholder="Label Name" value="" name="parameter_field['+i+'][]"  required ></td>\n\
            <td><select class="form-control select2 prod_drop" style="width: 100%;" name="parameter_field['+i+'][]" id="parameter_field['+i+']">\n\
                <option value="text">Text</option>\n\
                <option value="number">Number</option>\n\
                <option value="logtext">Log Text</option>\n\
                <option value="dropdown">Dropdown</option>\n\
                <option value="singlefile">Single File</option>\n\
                <option value="multiplefile">Multiple File</option></select></td>\n\
            <td><label><input type="checkbox" class="minimal" name="parameter_field['+i+'][]" ></label></td>\n\
            <td><input type="radio" name="parameter_field['+i+'][]" value="yes" /> Yes<input type="radio" name="parameter_field['+i+'][]" value="no" /> No</td>\n\
            <td><select class="form-control select2" style="width: 100%;" name="parameter_field['+i+'][]" id="parameter_textbox['+i+']"><option value="Monthly">Monthly</option> <option value="Quarterly">Quarterly</option><option value="Yearly">Yearly</option></select></td>\n\
            <td><div class="input-group date" ><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" name="parameter_field['+i+'][]" id="parameter_field['+i+'][]" class="form-control datepicker" placeholder="YYYY-MM-DD" required  ></div></td></tr>')
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass   : 'iradio_minimal-blue'
                  })
            $('select').select2();
            $('.datepicker').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true
            })
        });
        j=2;
        $(document).on("change",".prod_drop",function(){
                  var trid = $(this).attr('id');
                  var id = $(this).val();
                  if(id == "dropdown"){
                  var $this     = $(this);
                  $parentTR = $this.closest('tr');
                  $($parentTR).after('<tr class="subprocess_row delparam_'+l+'" >\n\
                        <td style="width:2%;"></td>\n\
                        <td><i class="fa fa-plus-circle add_field_button1" style="color: blue;font-size: x-large;" id="'+trid+'"></i> <i class="fa fa-minus-circle remove_field1" style="color: red;font-size: x-large;"></i></td>\n\
                        <td><input type="text" name="'+trid+'[product][]" id="'+trid+'[product][]" class="form-control checkblank" rows="1"  aria-required="true"></textarea></td></tr>');
                    }
        });
        
        $(document).on('click','.add_field_button1',function(){
             var trid = $(this).attr('id');
//                  alert(trid);
            $(this).closest('tr').after('<tr class="subprocess_row delparam_'+l+'">\n\
                        <td style="width:2%;"></td>\n\
                        <td><i class="fa fa-plus-circle add_field_button1" style="color: blue;font-size: x-large;" id="'+trid+'"></i> <i class="fa fa-minus-circle remove_field1" style="color: red;font-size: x-large;"></i></td>\n\
                        <td><input type="text" name="'+trid+'[product][]" id="'+trid+'[product][]" class="form-control checkblank" rows="1"  aria-required="true"></textarea></td></tr>');
        }); 
        
        $(document).on('click','.add_field_button12',function(){
             var trid = $(this).attr('id');
//                  alert(trid);
            $(this).closest('tr').after('<tr class="subprocess_row delparam_'+l+'">\n\
                        <td style="width:2%;"></td>\n\
                        <td><i class="fa fa-plus-circle add_field_button1" style="color: blue;font-size: x-large;" id="'+trid+'"></i> <i class="fa fa-minus-circle remove_field1" style="color: red;font-size: x-large;"></i></td>\n\
                        <td><input type="text" name="'+trid+'" id="'+trid+'" class="form-control checkblank" rows="1"  aria-required="true"></textarea></td></tr>');
        }); 
    


//        $(document).on('click','.remove_field',function(){
        $("#h_lost1").on('click','.remove_field',function(){
           var classname = $(this). closest('tr').attr('class');
//           alert(classname);
           var ret = classname.split(" ");
//           alert(ret);
           var ret1 = ret[1].split("_");
//           alert(ret1);
            $('.delparam_'+ret1[1]).remove();
        });
        $("#h_lost1").on('click','.remove_field1',function(){
            $(this).parent().parent().remove();
        });
 
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
