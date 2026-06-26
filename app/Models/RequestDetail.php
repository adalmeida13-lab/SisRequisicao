<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RequestDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'request_id',
        'date_actioned',
        'department_orig_id',
        'department_dest_id',
        'user_action_id',
        'description_action',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function request()
    {
        return $this->belongsTo(ServiceRequest::class);
    }

public function userAction()
    {
        return $this->belongsTo(User::class, 'user_action_id');
    }

        public function departmentOrig()
    {
        return $this->belongsTo(Department::class, 'department_orig_id');
    }

    public function departmentDest()
    {
        return $this->belongsTo(Department::class, 'department_dest_id');
    }
}
