<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ServiceRequest extends Model
{

    use SoftDeletes;
    protected $table = 'requests';
    protected $fillable = [
        'company_id',
        'user_id',
        'date_opened',
        'date_closed',
        'description',
        'status',
        'feedback',
        'feedback_comment'
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function request()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function RequestDetails()
    {
        return $this->hasMany(RequestDetail::class);
    }
}
