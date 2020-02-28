<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionsubclientField extends Model
{
    protected $primaryKey = "id";
    public $table = "tbl_sub_client_fields";
    public $timestamps=true;
    protected $fillable = [
        'subscription_id','field_id','rec_month','rec_year','field_input','is_complete','is_approved','is_deleted'
        ,'client_id','client_note','admin_note','is_office_only','is_office_only'
    ];
}
