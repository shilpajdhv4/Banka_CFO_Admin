<?php


namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class UserSubscribedfield extends Controller
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
   
    public function showSubfield(){
        $detail = DB::table('tbl_services_subscribed')
                ->select('tbl_employees.name','tbl_services_subscribed.user_id')
                ->leftjoin('tbl_employees','tbl_employees.id','tbl_services_subscribed.user_id')
                ->distinct()
                ->get();
        return view('user_subscription_data.subscription_field',['detail'=>$detail]);
    }
    
    public function addSubscription(){
        return view('subscription.add_subscription');
    }
    public function showServices()
    {
        $id=$_GET['id'];
          $detail = DB::table('tbl_services_subscribed')
                ->select('tbl_subscription.*','tbl_services_subscribed.user_id')
                ->leftjoin('tbl_subscription','tbl_subscription.id','tbl_services_subscribed.subscription_id')
//                ->distinct()
                ->get();
          return view('user_subscription_data.services_list',['detail'=>$detail]);
    }
    public function showClientForm()
    {
        $data=explode("!",$_GET['id']);
        $user_id=$data[1];
        $sub_id=$data[0];
          $form_data = DB::table('tbl_sub_client_fields')
            ->select('tbl_sub_client_fields.*', 'tbl_subscription_fields.field_title', 'tbl_subscription_fields.field_type', 'tbl_subscription_fields.field_extras')
            ->leftjoin('tbl_subscription_fields', 'tbl_subscription_fields.id', '=', 'tbl_sub_client_fields.field_id')
            ->where(['tbl_sub_client_fields.subscription_id' => $data[0]])
            ->where(['tbl_subscription_fields.is_office_only' => 0])
            ->where(['tbl_sub_client_fields.subscription_id' => $sub_id, 'client_id' => $user_id])
            ->get();
          
                    $office_data = DB::table('tbl_sub_client_fields')
            ->select('tbl_sub_client_fields.*', 'tbl_subscription_fields.field_title', 'tbl_subscription_fields.field_type', 'tbl_subscription_fields.field_extras')
            ->leftjoin('tbl_subscription_fields', 'tbl_subscription_fields.id', '=', 'tbl_sub_client_fields.field_id')
            ->where(['tbl_sub_client_fields.subscription_id' => $data[0]])
            ->where(['tbl_subscription_fields.is_office_only' => 1])
            ->where(['tbl_sub_client_fields.subscription_id' => $sub_id])
            ->get();
//       echo "<pre/>"; print_r($form_data);
//        return view('user_subscription_data.show_client_form',['form_data'=>$form_data]);
        return view('user_subscription_data.create',['form_data'=>$form_data,'office_data'=>$office_data]);
    }
    public function updateOfficefield(Request $request)
    {
          $requestData = $request->all();
        $ndata = '';
//         echo "<pre>";
//         print_r($requestData);
//         exit;
        foreach ($requestData as $key => $row) {
            $field_data = $field_data_val = $arr_k = array();
            if (is_numeric($key)) {
                $data = \App\SubscriptionsubclientField::where(['id' => $key])->first();
                $client_id=$data->client_id;
                $sub_id=$data->subscription_id;
                // echo $key;
                $field_data = json_decode($data->field_input, true);
                $arr_k = array_keys($field_data);
                $id = $key;
                $type_data = \App\SubscriptionField::select('*')->where(['id' => $id])->first();
//                 echo $type_data->field_type;
//                 exit;
                if ($type_data->field_type == "singlefile") {
//                     print_r($row);
//                     exit;
                    $uniqueid = uniqid();
                    $original_name = $row->getClientOriginalName();
                    $size = $row->getSize();
                    $extension = $row->getClientOriginalExtension();
                    $name = $uniqueid . '.' . $extension;
                    $path = $row->move(public_path('office'), $name);
                    if ($path) {
                        $row = $name;
                    }
                }
                if ($type_data->field_type == "multiplefile") {

                    $files = $row;

                    //var_dump($files);
                    // print_r($files);
                    //exit;
                    foreach ($files as $file) {
                        $uniqueid = uniqid();
                        $original_name = $file->getClientOriginalName();
                        $size = $file->getSize();
                        $extension = $file->getClientOriginalExtension();
                        $name = $uniqueid . '.' . $extension;
                        $path = $file->move(public_path('office'), $name);
                        if ($path) {
                            $ndata .= $name . ",";
                        }
                    }
                    $row = $ndata;
                }
                // echo $row;
                $field_data_val[$arr_k[0]] = $row;
                $update_data['field_input'] = json_encode($field_data_val);
                $update_data['is_complete'] = 'Yes';
                $update_data['is_approved'] = 1;
                $data->update($update_data);
            }
        }
        $id=$sub_id."!".$client_id;
         Session::flash('alert-success','Form Updated successfully.');
         return redirect('client_form?id='.$id);
    }
}