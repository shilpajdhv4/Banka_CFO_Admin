<?php


namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class SubscriptionController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    function __construct()
//    {
//         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
//         $this->middleware('permission:product-create', ['only' => ['create','store']]);
//         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
//         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function listSubscription(){
        $id = $_GET['id'];
        $detail = DB::table('tbl_service')
                ->select('tbl_service.service_name','tbl_vertical.vertical_name','tbl_category.category_name')
                ->leftjoin('tbl_vertical','tbl_vertical.id','tbl_service.vertical_id')
                ->leftjoin('tbl_category','tbl_category.id','tbl_service.category_id')
                ->where(['tbl_service.id'=>$id])
                ->first();
        $subscript_list = \App\Subscription::where(['is_active'=>1,'service_id'=>$id])->get();
        return view('subscription.subscription',['detail'=>$detail,'id'=>$id,'subscript_list'=>$subscript_list]);
    }
    
    public function addSubscription(){
        return view('subscription.add_subscription');
    }

    public function saveSubscription(Request $request){
        $requestData = $request->all();
        request()->validate([
        //    'vertical_id' => 'required',
          //  'category_id' => 'required',
            'service_id' => 'required',
            'subscription_name' => 'required',
         //   'subscription_image' => 'required',
            'subscription_price' => 'required',
           // 'text_to_be_display' => 'required',
            'is_recurring' => 'required'
        ]);
        
        if(isset($requestData['subscription_image'])){
            $design = $requestData['subscription_image'];
            $filename = $design->getClientOriginalName();
            $destination= "subscription_img/";
            $design->move($destination,$filename);
            $requestData['subscription_image'] = $filename;
        }
        
        if(isset($requestData['is_active'])){
            if($requestData['is_active'] == "on"){
                $requestData['is_active'] = 1;
            }
        }
        
        $servic = \App\Service::select('vertical_id','category_id')->where(['id'=>$requestData['service_id']])->first();
        $requestData['vertical_id'] = $servic->vertical_id;
        $requestData['category_id'] = $servic->category_id;
        $requestData['condition_package_wise'] = json_encode($requestData['parameter_detail']);
     //   echo "<pre>";print_r($requestData);exit;
      \App\Subscription::create($requestData);


        return redirect('subscription?id='.$requestData['service_id'])->with('success','Services created successfully.');
    }

    public function editSubscription(){
        $id = $_GET['id'];
        $subscription = \App\Subscription::where(['id'=>$id])->first();
//        echo "<pre/>";print_r($subscription);exit;
        return view('subscription.edit_subscription',['subscription'=>$subscription]);
    }

    public function update($id, Request $request){
        $requestData = $request->all();
//        echo "<pre>";print_r($requestData);exit;
        request()->validate([
        //    'vertical_id' => 'required',
          //  'category_id' => 'required',
            'service_id' => 'required',
            'subscription_name' => 'required',
         //   'subscription_image' => 'required',
            'subscription_price' => 'required',
           // 'text_to_be_display' => 'required',
            'is_recurring' => 'required'
        ]);
        
        $service_det = \App\Subscription::findorfail($id);
        $oldFileName = $service_det->subscription_image;
        if(empty($requestData['subscription_image'])) {
                $requestData['subscription_image'] = $oldFileName;
        }else{
            $design = $requestData['subscription_image'];
            $filename = $design->getClientOriginalName();
            $destination = "subscription_img/";
            if($oldFileName != ""){
                unlink($destination.'/'.$oldFileName);
            }
            $design->move($destination,$filename);
            $requestData['subscription_image'] = $filename;
        }
               
        if(isset($requestData['is_active'])){
            if($requestData['is_active'] == "on"){
                $requestData['is_active'] = 1;
            }
        }
        
   //     $servic = \App\Service::select('vertical_id','category_id')->where(['id'=>$requestData['service_id']])->first();
   //     $requestData['vertical_id'] = $servic->vertical_id;
   //     $requestData['category_id'] = $servic->category_id;
        $requestData['condition_package_wise'] = json_encode($requestData['parameter_detail']);
      //  echo "<pre>";print_r($requestData);exit;
        $service_det->update($requestData);


        return redirect('subscription?id='.$requestData['service_id'])
                        ->with('success','Service updated successfully.');
    }
    
    public function clientForm(){
        $id = $_GET['id'];
        $subscription = \App\Subscription::select('subscription_name','id')->where(['is_active'=>1,'id'=>$id])->first();
        $client_form = \App\SubscriptionField::where(['subscription_id'=>$id,'is_office_only'=>0])->get();
        return view('subscription.client_form',['client_form'=>$client_form,'subscription'=>$subscription]);
    }
    
    public function saveClientField(Request $request){
        $requestData = $request->all();
     //   echo "<pre>";print_r($requestData);exit;
        $id = $requestData['subscription_id'];
        foreach($requestData['parameter_field'] as $param){
            $field_arr = $arr = array();
            $field_arr['subscription_id'] = $id;
            $field_arr['field_title'] = @$param[0];
            $field_arr['field_type'] = @$param[1];
            if(@$param[2] == 'on') { 
                $field_arr['is_mandatory'] = 1;
            }
            if(@$param[3] == 'yes'){
                $field_arr['is_recurring'] = 1;
            }else{
                $field_arr['is_recurring'] = 0;
            }
            $field_arr['recurring_frequency'] = @$param[4];
            $field_arr['recurring_reminder_day'] = @$param[5];
            if(isset($param['product'])){
               $field_arr['field_extras'] = json_encode($param['product']);
            }
            $field_arr['created_by'] = Auth::user()->id;
          //  echo "<pre>";print_r($field_arr);exit;
            $sub_data = \App\SubscriptionField::create($field_arr);
            
            $sub_client_field['subscription_id'] = $id;
            $sub_client_field['field_id'] = $sub_data->id;
            $sub_client_field['rec_month'] = 2;
            $sub_client_field['rec_year'] = 2020;
            $arr = array(@$param[0] => '');
            $sub_client_field['field_input'] = json_encode($arr);
            $sub_client_field['is_complete'] = 'No';
            $sub_client_field['client_id'] = 1;
            $sub_client_field['is_office_only'] = 0;
            \App\SubscriptionsubclientField::create($sub_client_field);
        }
        return redirect('subscription?id='.$id);
      //  echo "<pre>";print_r($field_arr);exit;
    }

    public function officeForm(){
        $id = $_GET['id'];
        $subscription = \App\Subscription::select('subscription_name','id')->where(['is_active'=>1,'id'=>$id])->first();
        $client_form = \App\SubscriptionField::where(['subscription_id'=>$id,'is_office_only'=>1])->get();
        return view('subscription.office_form',['client_form'=>$client_form,'subscription'=>$subscription]);
    }
    
    
    public function saveOfficeField(Request $request){
        $requestData = $request->all();
        $id = $requestData['subscription_id'];
        foreach($requestData['parameter_field'] as $param){
            $field_arr = array();
            $field_arr['subscription_id'] = $id;
            $field_arr['field_title'] = @$param[0];
            $field_arr['field_type'] = @$param[1];
            if(@$param[2] == 'on') { 
                $field_arr['is_mandatory'] = 1;
            }
            if(@$param[3] == 'yes'){
                $field_arr['is_recurring'] = 1;
            }else{
                $field_arr['is_recurring'] = 0;
            }
            $field_arr['recurring_frequency'] = @$param[4];
            $field_arr['recurring_reminder_day'] = @$param[5];
            if(isset($param['product'])){
               $field_arr['field_extras'] = json_encode($param['product']);
            }
            $field_arr['created_by'] = Auth::user()->id;
            $field_arr['is_office_only'] = 1;
            
            $sub_data = \App\SubscriptionField::create($field_arr);
            
            $sub_client_field['subscription_id'] = $id;
            $sub_client_field['field_id'] = $sub_data->id;
            $sub_client_field['rec_month'] = 2;
            $sub_client_field['rec_year'] = 2020;
            $arr = array(@$param[0] => '');
            $sub_client_field['field_input'] = json_encode($arr);
            $sub_client_field['is_complete'] = 'No';
            $sub_client_field['client_id'] = 1;
            $sub_client_field['is_office_only'] = 1;
            \App\SubscriptionsubclientField::create($sub_client_field);
        }
        return redirect('subscription?id='.$id);
      //  echo "<pre>";print_r($field_arr);exit;
    }
}